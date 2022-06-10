<?
	print_r($secext);
	if(isset($product)) {
		print_r(sprintf("<div class=\"col-12\"><h1>%s</h1></div>", $product['Title']));
	} elseif(isset($partner)) {
		print_r(sprintf("<div class=\"col-12\"><h1>%s</h1></div>", $partner['name']));
	}
?>