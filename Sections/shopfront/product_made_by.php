<?
	$partner_image = 'http://candlestick-indev.co.uk/assets/images/logos/logo.svg';
	$partner_title = 'By The Candlestick';
	$partner_shop_link = 'https://www.thecandlestick.co.uk/';
	if($product['made_by_ID'] != 1) {
		$partner_image = '';
		$partner_title = 'TODO';
		$partner_shop_link = '';
	}

	print_r("
		<div class=\"row\">
			<div class=\"offset-2 col-2 / offset-md-0 col-md-3\">
				<img class=\"mw-100 rounded-circle\" src=\"$partner_image\">
			</div>
			<div class=\"offset-0 col-6 / offset-md-0 col-md-9\">
				<p class=\"mb-0 text-muted\">
					Made by: 
				</p>
				<p class=\"fs-6\">
					<a href=\"$partner_shop_link\">
						$partner_title
					</a>
				</p>
			</div>
		</div>
	");
?>