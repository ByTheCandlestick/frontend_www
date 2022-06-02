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
?>