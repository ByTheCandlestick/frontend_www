<?
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
	 * 
	 */
	function printSectionTemplates(string $string) {
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
							print('<div>'.$secext.'</div>');
							unset($secext);
						}
					}
				}
			print("</div>");
		}
		print('</div></main>');
	}
?>