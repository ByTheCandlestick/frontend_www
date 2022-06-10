<?
	$supplier_image = 'http://candlestick-indev.co.uk/assets/images/logos/logo.svg';
	$supplier_title = 'By The Candlestick';
	$supplier_shop_link = 'https://www.thecandlestick.co.uk/';
	if($product['made_by'] != 'candlestick') {
		$supplier_image = '';
		$supplier_title = 'TODO';
		$supplier_shop_link = '';
	}

	print_r("
		<div class=\"row\">
			<div class=\"offset-2 col-2 / offset-md-0 col-md-3\">
				<img class=\"mw-100 rounded-circle\" src=\"$supplier_image\">
			</div>
			<div class=\"offset-0 col-6 / offset-md-0 col-md-9\">
				<p class=\"mb-0 text-muted\">
					Made by: 
				</p>
				<p class=\"fs-6\">
					<a href=\"$supplier_shop_link\">
						$supplier_title
					</a>
				</p>
			</div>
		</div>
	");
?>