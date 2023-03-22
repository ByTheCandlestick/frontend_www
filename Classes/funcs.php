<?
	function removeSubdomain($domain) {
		return preg_replace("/^(.*?)\.(.*)$/", "$2", $domain);
	}

	function startsWith($string, $startString) {
		$len = strlen($startString);
		return (substr($string, 0, $len) === $startString);
	}

	function Redirect($url, $code = 301) {
		print("<script> window.location.assign(\"$url\"); </script>'");
		exit();
	}
	/**	domainID
	 *	Gets the domain ID for the current domain
	 *	@return int
	 *
	 */
		function domainID() {
			return mysqli_fetch_array(DB_Query(sprintf("SELECT `ID` FROM `Website domains` WHERE `Domain`='%s'", $_SERVER['HTTP_HOST'])))[0];
		}
	/**	getThemepage
	 *	Returns the name of the theme and optionally requires the theme index page.
	 *	@param bool $require
	 *	@return string
	 */
		function getThemepage(bool $require) {
			global $userdata, $userperm, $website_info, $user_ok, $product, $partner, $users, $config;
			$page_type = mysqli_fetch_array(DB_Query(sprintf("SELECT `page_type` FROM `Website domains` WHERE `Domain`='%s'", $_SERVER['HTTP_HOST'])))[0];
			$theme_location = mysqli_fetch_array(DB_Query(sprintf("SELECT `Location` FROM `Website themes` WHERE `ID`='%s'", $page_type)))[0];
			if($theme_location != "") {
				if($require){
					if(file_exists('./Themes/'.$theme_location.'/index.php')) {
						return require_once('./Themes/'.$theme_location.'/index.php');
					} else {
						return print('The page you are looking for does not exist');;
					}
				} else {
					return $theme_location;
				}
			} else {
				return false;
			}
		}
	/**	DB_QUERY
	 *	The script thay connects to the DB
	 *	@param string $sql The SQL script required to execute, replacing the table with %s
	 *	@param array $DBinfo A predefined list including all DB info for the required DB
	 *	@return mysqli_result
	 */
		function DB_Query($sql, $DBinfo = ADMIN) {
			if(!$conn = mysqli_connect($DBinfo[0], $DBinfo[1], $DBinfo[2], $DBinfo[3])) {
				die('Unable to connect to the DB, Please try again later');
			}
			return mysqli_query($conn, $sql);
		}

	/**	printStyles
	 *	Prints the link for all stylesheets
	 *	@param string $stylesheets
	 */
		function printStyles(string $stylesheets) {
			$stylesheets = explode(",", $stylesheets);
			foreach($stylesheets as $style) {
				if($result = DB_Query("SELECT * FROM `Website styles` WHERE `ID`='$style'")) {
					$res = mysqli_fetch_array($result);
					$styleLocation = $res['Location'];
					$preload = $res['Preload'];

					if($preload == 1) {
						echo sprintf(
							'
							<link rel="preload" href="%s" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">
							<noscript>
								<link rel="stylesheet" href="%s">
							</noscript>',
							$styleLocation,
							$styleLocation
						);
					} else {
						echo sprintf(
							'<link	rel="stylesheet"
									href="%s"
									type="text/css"
									media="all" />',
							$styleLocation
						);
					}
				}
			}
		}

	/**	printScripts
	 *	Prints the script tags for all scripts
	 *	@param string $scripts
	 */
		function printScripts(string $scriptsheets) {
			$scriptsheets = explode(",", $scriptsheets);
			foreach($scriptsheets as $script) {
				if($result = DB_Query("SELECT `Location` FROM `Website scripts` WHERE `ID`='$script'")) {
					$res = mysqli_fetch_array($result);

					if($res['Preload'] == 1) {
						echo sprintf(
							'<script src="%s" type="text/javascript"></script>',
							$res['Location']
						);
					} else {
						echo sprintf(
							'<script src="%s" type="text/javascript"></script>',
							$res['Location']
						);
					}
				}
			}
		}

	/**	printSections
	 *	Prints all sections specified within a section string
	 * 
	 *	@param string $sections
	 * 
	 *	The sections string is a string of text that specifies the order, sizing and contents of sections.
	 * 
	 *	The sections are seperated by a comma ',' to allow multiple sections per page E.g. `0000,0000`
	 * 
	 *	The sections can be split into bootstrap columns within a row.
	 *	To set a section to have a a row width you would have to initiate the row with a hashtag '#'
	 *	then type in the row width you would like (1-12) and end it with a semi-colon ';'
	 *	Once you have specified the column width, you can put the section code in and the section will
	 *	be at the width specified. E.g. `#9;0000`
	 *	You may use a comma to add multiple sections with varied widths. E.g. `#9;0000,#3;0000,0000`
	 * 
	 *	Some sections may require a string so change the view of the section, for example to change
	 *	the products shown in a product grid. To do this you have to insert a colon ':' and the name
	 *	of the text you are wanting to use after the section code. E.g. `#3;0000:Example`
	 *	In some instances you can specify the text directly by putting an exclamation point before
	 *	where the name of the text would be. E.g. `0000:!My Awesome Example Text`
	 * 
	 *	All of the above can be used in conjunction to make more complex section strings for a more
	 *	customizable approach. E.g. `#9;0000,#3;0000:Example,0000,#12;0000:!My Awesome Example Text`
	 **/
		function printSections(string $string) {
			global $userdata, $userperm, $website_info, $user_ok, $product, $partner, $users, $config;
			$columns = explode("#", $string);
			$seccode = $secext = NULL;
			print('<main><div class="row">');
			array_shift($columns);
			foreach($columns as $column) {
				[$width, $section_string] = explode(';', $column);
				print("<div class=\"col-md-$width\">");
					$sections = explode(',', $section_string);
					foreach($sections as $section) {
						[$seccode, $secext] = explode(':', $section);
						if($result = DB_Query("SELECT * FROM `Website sections` WHERE `id`='$seccode'")) {
							if(mysqli_num_rows($result) == 1) {
								$row = mysqli_fetch_array($result);
								include('./Sections/'.$row['section_type'].'/'.$row['section_url'].'.php');
								unset($secext);
							}
						}
					}
				print("</div>");
			}
			print('</div></main>');
		}
	/** require_user_ok
	 *	If you require The user to be logged in - this checks if they are logged in and Redirects them if they are not.
	 *	@return Redirect
	 */
		function require_user_ok() {
			global $user_ok;
			if(!$user_ok) {
				ob_end_clean();
				header("Connection: close\r\n");
				header("Content-Encoding: none\r\n");
				ignore_user_abort(true); // optional
				ob_start();
		
				print('ERROR: User not authorised.');
				header('Location: '.URL_WWW.'/Login?rw='.domainID());
				
				$size = ob_get_length();
				header("Content-Length: $size");
				ob_end_flush();     // Strange behaviour, will not work
				flush();            // Unless both are called !
				ob_end_clean();
			}
		}
	/**	getDirContents
	 * 	Gets the content of a specified directory and subdirectories.
	 *	@param	string	$directory - The base directory to search.
	 *	@param	bool	$recursive - Whether of not you would like to look in subdirectories.
	 *	@param	string	$contains -	Only show results where the file includes a specified string.
	 *	@param	array	$results - This is for internal use only when recursive.
	 *	@return	array
	 */
		function getDirContents(string $directory, string $contains="", bool $recursive = true, array &$results = array()) {
			foreach (scandir($directory) as $key => $value) {
				$path = realpath($directory . DIRECTORY_SEPARATOR . $value);
				if (!is_dir($path) && strpos($value, $contains)) {
					$results[]= array('File' => $value,'Path' => str_replace("homepages/36/d908228976/htdocs/Live/frontend_www/", "", $path));
				} else if ($value != "." && $value != "..") {
					if($recursive) getDirContents($path, $contains, $recursive, $results);
				}
			}
			return $results;
		}
?>