<?
	$uriStr = getUri();
	$pos = $extention[0];
	$rdir = $extention[1];
	 if(!isset($uriStr[$pos])) {
		$sql = "SELECT `url` FROM `candlestick_admin`.`redirects` WHERE `title`='$rdir'";
		if($query = mysqli_query($conn, $sql)) {
			$row = mysqli_fetch_row($query);
			if(!isset($uriStr[$pos])) {
				echo "<script> window.location.replace(\"$row[0]\") </script>";
			}
		}
	}
?>