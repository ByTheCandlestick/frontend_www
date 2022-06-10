<?
	$cart_total = 0;
	$userid = $userdata['ID'];
	if($query = mysqli_query($conn, "SELECT * FROM `candlestick_users`.`Users_cart` WHERE `UID`=$userid AND `active`=1")) {
		$cart_items = array();
		while($row = mysqli_fetch_row($query)) {
			array_push($cart_items, $row);
		}
	} else {
		$cart_items = null;
	}
?>
<div class="col-12 pb-4">
	<?
		if($cart_items != null) {
			$cart_items_count = count($cart_items);
			for($i=0;$i<$cart_items_count;$i++) {
				$cart_item = explode(',', $cart_items[$i][4]);
				$cart_item_id = $cart_item[0];
				if($q = mysqli_query($conn, "SELECT * FROM `candlestick_admin`.`products` WHERE `id`=$cart_item_id AND `active`=1 LIMIT 1")) {
					while($res = mysqli_fetch_array($q)) {
						$currency = $res['currency'];
						$cart_item_image = explode(',', $res['images'])[0];
						$cart_item_title = $res['title'];
						$fmt = new NumberFormatter( locale_get_default()."@currency=$currency", NumberFormatter::CURRENCY );
						$cart_item_curr = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
						$cart_item_price = $res['price'];
						$cart_item_quantity = $cart_item[1];
						$cart_item_total = $cart_item_price * $cart_item_quantity;
						$cart_total = $cart_total + $cart_item_total;


						$titles=$options=array();
						$x = explode(';', $res['variants']);
						foreach($x as $y) {
							$z = explode(':', $y);
							if(isset($z[0]) && isset($z[1])) {
								$ttl = $z[0];
								$opt = explode(',', $z[1]);
								if(isset($z[0]) && isset($z[1])) {
									array_push($titles,$ttl);
									array_push($options,$opt);
								}
							}
						}

					}
					print("
						<cart-item raw=\"".$cart_items[$i][4]."\" prod-id=\"".$cart_item_id."\" prod-qty=\"".$cart_item_quantity."\" prod-opt=\"".$cart_item[2]."\">
							<div class=\"row border-bottom m-3 p-3 / m-md-0 p-md-2 mx-md-5 px-md-5\">
								<div class=\"row col-12 col-md-8 pb-2 pb-md-0\">
									<div class=\"col-3 pe-3 / col-md-3 pe-md-3\">
										<picture>
											<source srcset=\"https://cdn.thecandlestick.co.uk/_assets/_websites/thecandlestick/images/$cart_item_image.webp\" type=\"image/webp\">
											<source srcset=\"https://cdn.thecandlestick.co.uk/_assets/_websites/thecandlestick/images/$cart_item_image.jpg\" type=\"image/jpeg\"> 
											<img src=\"https://cdn.thecandlestick.co.uk/_assets/_websites/thecandlestick/images/$cart_item_image.jpg\" class=\"mw-100\" alt=\"$cart_item_title\">
										</picture>
									</div>
									<div class=\"col-9 col-md-8 align-items-center\">
										<div class=\"top-50 position-relative\" style=\"transform:translatey(-50%);\">
											<p><a class=\"link-dark\" href=\"https://www.thecandlestick.co.uk/Boutique::product::$cart_item_id\">
												$cart_item_title
											</a></p>
											<p class=\"font-monospace text-muted\">
					");
					for($n=0; $n<count($titles);$n++) {
						$item_options = explode(':', $cart_item[2]);
						print($titles[$n].': '.$options[$n][$item_options[$n]-1].'&nbsp;&nbsp;&nbsp;');
					}
					print("					</p>
											<button type=\"button\" class=\"btn btn-outline-dark\" onClick=\"cart.remove(". $userdata['ID'].", '".$cart_items[$i][4] ."')\">Remove</button>
										</div>
									</div>
								</div>
								<div class=\"row align-items-center col-12 col-md-4\">
									<div class=\"col-3\">
										<div class=\"form-floating\">
											<input class=\"text-center form-control border-0 bg-transparent\" placeholder=\"Leave a comment here\" id=\"floatingTextarea\" value=\"$cart_item_curr$cart_item_price\" disabled>
											<label for=\"floatingTextarea\">Price</label>
										</div>
									</div>
									<div class=\"col-6\">
										<div class=\"form-floating\">
											<input class=\"text-center form-control\" placeholder=\"Leave a comment here\" id=\"floatingTextarea\" value=\"$cart_item_quantity\">
											<label for=\"floatingTextarea\">Quantity</label>
										</div>
									</div>
									<div class=\"col-3\">
										<div class=\"form-floating\">
											<input class=\"text-center form-control border-0 bg-transparent\" placeholder=\"Leave a comment here\" id=\"floatingTextarea\" value=\"$cart_item_curr$cart_item_total\" disabled>
											<label for=\"floatingTextarea\">Total</label>
										</div>
									</div>
								</div>
							</div>
						</cart-item>
					");
				}
			}
		} else {
			print("
				<div class=\"border-bottom row p-3\">
					<div class=\"col-12 p-3 text-center\">
						<span> Your cart is empty </span>
					</div>
				</div>
			");
		}
	?>
</div>