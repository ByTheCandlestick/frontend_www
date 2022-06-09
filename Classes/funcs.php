<?
	/**
	 * domainID
	 *
	 * @return int
	 *
	 */
	function domainID() {
		print_r($_SERVER);
		return '1'; // (DB_Query())
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
		global $userdata, $info, $user_ok, $conn;
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
							include('./sections/'.$row['section_type'].'/'.$row['section_url'].'.php');
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
			global $userdata, $info, $user_ok, $conn;
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
?>