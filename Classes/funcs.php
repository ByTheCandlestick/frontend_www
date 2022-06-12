<?
	function removeSubdomain($domain) {
		return $only_my_domain = preg_replace("/^(.*?)\.(.*)$/","$2",$domain);
	}

	function startsWith($string, $startString) {
		$len = strlen($startString);
		return (substr($string, 0, $len) === $startString);
	}

	function Redirect($url, $code = 301) {
		print("<script> window.location.assign(\"$url\"); </script>'");
		exit();
	}
	/**
	 * domainID
	 *
	 * @return int
	 *
	 */
		function domainID() {
			return mysqli_fetch_array(DB_Query(sprintf("SELECT `ID` FROM `misc_websites` WHERE `Domain`='%s'", $_SERVER['HTTP_HOST'])))[0];
		}
	/**
	 * getThemepage
	 * Returns the name of the theme and optionally requires the theme index page.
	 *
	 * @param bool $require
	 * @return string
	 *
	 */
		function getThemepage($require) {
			global $userdata, $info, $user_ok, $product, $partner;
			$page_type = mysqli_fetch_array(DB_Query(sprintf("SELECT `page_type` FROM `misc_websites` WHERE `Domain`='%s'", $_SERVER['HTTP_HOST'])))[0];
			$theme_location = mysqli_fetch_array(DB_Query(sprintf("SELECT `Location` FROM `page_types` WHERE `ID`='%s'", $page_type)))[0];
			if($teme_location != "") {
				if($require){
					return require_once('./Themes/'.$theme_location.'/index.php');
				} else {
					return $theme_location;
				}
			} else {
				return 'The website you are looking for does not exist';
			}
		}
	/**
	 * DB_QUERY
	 *
	 * @param array $DBinfo A predefined list including all DB info for the required DB
	 * @param string $sql The SQL script required to execute, replacing the table with %s
	 * @return mysqli_query
	 *
	 */
		function DB_Query($sql, $DBinfo = ADMIN) {
			if(!$conn = mysqli_connect($DBinfo[0], $DBinfo[1], $DBinfo[2], $DBinfo[3])) {
				die('Unable to connect to the DB, Please try again later');
			}
			return mysqli_query($conn, $sql);
		}

	/**
	 * Prints the link for all stylesheets
	 * 
	 * @param string $stylesheets
	 * 
	 */
		function printStyles(string $stylesheets) {
			$stylesheets = explode(",", $stylesheets);
			foreach($stylesheets as $style) {
				if($result = DB_Query("SELECT * FROM `page_styles` WHERE `id`='$style'")) {
					$res = mysqli_fetch_array($result);
					$styleLocation = $res['location'];
					$preload = $res['preload'];

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

	/**
	 * Prints the link for all scripts
	 * 
	 * @param string $scripts
	 * 
	 */
		function printScripts(string $scriptsheets) {
			$scriptsheets = explode(",", $scriptsheets);
			foreach($scriptsheets as $script) {
				if($result = DB_Query("SELECT `location` FROM `page_scripts` WHERE `id`='$script'")) {
					$res = mysqli_fetch_array($result);
					$scriptLocation = $res['location'];
					$preload = $res['preload'];

					if($preload == 1) {
						echo sprintf(
							'<script	src="%s" type="text/javascript"></script>',
							$scriptLocation
						);
					} else {
						echo sprintf(
							'<script	src="%s" type="text/javascript"></script>',
							$scriptLocation
						);
					}
				}
			}
		}

	/**
	 * Prints all sections specified within a section string
	 * 
	 * @param string $sections
	 * 
	 * The sections string is a string of text that specifies the order, sizing and contents of sections.
	 * 
	 * The sections are seperated by a comma ',' to allow multiple sections per page E.g. `0000,0000`
	 * 
	 * The sections can be split into bootstrap columns within a row.
	 * To set a section to have a a row width you would have to initiate the row with a hashtag '#'
	 * then type in the row width you would like (1-12) and end it with a semi-colon ';'
	 * Once you have specified the column width, you can put the section code in and the section will
	 * be at the width specified. E.g. `#9;0000`
	 * You may use a comma to add multiple sections with varied widths. E.g. `#9;0000,#3;0000,0000`
	 * 
	 * Some sections may require a string so change the view of the section, for example to change
	 * the products shown in a product grid. To do this you have to insert a colon ':' and the name
	 * of the text you are wanting to use after the section code. E.g. `#3;0000:Example`
	 * In some instances you can specify the text directly by putting an exclamation point before
	 * where the name of the text would be. E.g. `0000:!My Awesome Example Text`
	 * 
	 * All of the above can be used in conjunction to make more complex section strings for a more
	 * customizable approach. E.g. `#9;0000,#3;0000:Example,0000,#12;0000:!My Awesome Example Text`
	 * 
	**/
		function printSections(string $string) {
			global $userdata, $info, $user_ok, $product, $partner;
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
						if($result = DB_Query("SELECT * FROM `page_sections` WHERE `id`='$seccode'")) {
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
	/** printSectionTemplates */
		function printSectionTemplates(string $string) {
			$columns = explode("#", $string);
			$seccode = $secext = NULL;
			print('<div class="row">');
			array_shift($columns);
			foreach($columns as $column) {
				[$width, $section_string] = explode(';', $column);
				print("<div class=\"col-md-$width container\">");
					$sections = explode(',', $section_string);
					foreach($sections as $section) {
						[$seccode, $secext] = explode(':', $section);
						if($result = DB_Query("SELECT * FROM `page_sections` WHERE `id`='$seccode'")) {
							if(mysqli_num_rows($result) == 1) {
								$row = mysqli_fetch_array($result);
								print('
									<div class="element">
										<h4>$width - '.$width.'</h4>
										$seccode - '.$seccode.'
										<br>
										$secext  - '.$secext.'
									</div>
								');
								unset($secext);
							}
						}
					}
				print("</div>");
			}
			print('</div>');
		}
	/** require_user_ok
	 * 
	 */
		function require_user_ok() {
			global $user_ok;
			if(!$user_ok) {
				ob_end_clean();
				header("Connection: close\r\n");
				header("Content-Encoding: none\r\n");
				ignore_user_abort(true); // optional
				ob_start();
		
				print('ERROR');
				
				$size = ob_get_length();
				header("Content-Length: $size");
				ob_end_flush();     // Strange behaviour, will not work
				flush();            // Unless both are called !
				ob_end_clean();
			}
		}
?>