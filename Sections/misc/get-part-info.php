<?
	$query = DB_Query(sprintf("SELECT * FROM `Partner accounts` WHERE `public`=1 AND `Slug`='%s' AND `Active`='1' LIMIT 1", QS));
	if(mysqli_num_rows($query) > 0) {
		$partner = mysqli_fetch_assoc($query);
	} else {
		print('<script> window.location.replace("/Boutique/Partners/") </script>');
	}
?>