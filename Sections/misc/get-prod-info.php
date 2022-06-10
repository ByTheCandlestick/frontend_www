<?
	$query = DB_Query(sprintf("SELECT * FROM `products` WHERE `Slug`='%s' AND `Active`='1' LIMIT 1", QS));
	global $product;
	if(mysqli_num_rows($query) > 0) {
		$product = mysqli_fetch_assoc($query);
	} else {
		print('<script> window.location.replace("/Boutique/") </script>');
	}
?>