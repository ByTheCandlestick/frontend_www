<?
	$cart_total = 0;
	$userid = $userdata['ID'];
	if($query = DB_Query("SELECT * FROM `Users_cart` WHERE `UID`=$userid AND `Active`=1")) {
		$cart_items = array();
		while($row = mysqli_fetch_row($query)) {
			array_push($cart_items, $row);
		}
	} else {
		$cart_items = null;
	}
?>
<div class="cart col-12 pb-4">
	<?
		if($cart_items != null) {
			$cart_items_count = count($cart_items);
			for($i=0;$i<$cart_items_count;$i++) {
				$cart_item = $cart_items[$i];
				$cart_item_id = $cart_item[2];
				if($q = DB_Query("SELECT * FROM `products` WHERE `SKU`=$cart_item_id AND `Active`=1 LIMIT 1")) {
					while($res = mysqli_fetch_array($q)) {
						$currency = $res['Currency'];
						$fmt = new NumberFormatter( locale_get_default()."@currency=$currency", NumberFormatter::CURRENCY );
						$cart_item_curr = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
						$cart_item_image = explode(',', $res['Images'])[0];
						$cart_item_title = $res['Title'];
						$cart_item_price = $res['RetailPrice'];
						$cart_item_slug = $res['Slug'];
						$cart_item_quantity = $cart_item[3];
						$cart_item_total = $cart_item_price * $cart_item_quantity;
						$cart_total = $cart_total + $cart_item_total;


						$titles=$options=array();
						$x = explode(';', $res['Variants']);
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
					print('
						<cart-item raw="'.$cart_item_id.','.$cart_item_quantity.','.$cart_items[$i][4].'" prod-id="'.$cart_item_id.'" prod-qty="'.$cart_item_quantity.'" prod-opt="'.$cart_item[2].'">
							<div class="row border-bottom m-3 p-3 / m-md-0 p-md-2 mx-md-5 px-md-5">
								<div class="row col-12 col-lg-8 pb-2 pb-lg-0">
									<div class="mw-25 mw-md-10 col-3 pe-3 / col-md-3 pe-md-3">
										<picture>
											<source srcset="'.__API__.'/Images/fetch/'. $cart_item_image .'/jpeg/" type="image/jpeg"/>
											<source srcset="'.__API__.'/Images/fetch/'. $cart_item_image .'/jpg/" type="image/jpg"/>
											<source srcset="'.__API__.'/Images/fetch/'. $cart_item_image .'/png/" type="image/png"/>
											<source srcset="'.__API__.'/Images/fetch/'. $cart_item_image .'/jpx/" type="image/jpx"/>
											<img src="'.__API__.'/Images/fetch/'. $cart_item_image .'/webp/" type="image/webp" width="100%" height="auto">
										</picture>
									</div>
									<div class="col-9 col-md-8 align-items-center">
										<div class="top-50 position-relative" style="transform:translatey(-50%);">
											<p>
												<a class="link-dark" href="'.URL_WWW.'/Boutique/product/'.$cart_item_slug.'">
													'.$cart_item_title.'
												</a>
											</p>
											<p class="font-monospace text-muted">
					');
					for($n=0; $n<count($titles);$n++) {
						$item_options = explode(':', $cart_item[2]);
						print($titles[$n].': '.$options[$n][$item_options[$n]-1].'&nbsp;&nbsp;&nbsp;');
					}
					print('
											</p>
										</div>
									</div>
								</div>
								<div class="row align-items-center col-12 col-lg-4">
									<div class="col-3">
										<div class="form-floating">
											<input class="text-center form-control border-0 bg-transparent" placeholder="Leave a comment here" id="floatingTextarea" value="'.$cart_item_curr.$cart_item_price.'" disabled>
											<label for="floatingTextarea">Price</label>
										</div>
									</div>
									<div class="col-12 col-lg-6">
										<div class="form-floating">
											<input class="text-center form-control border-0 bg-transparent" placeholder="Leave a comment here" id="floatingTextarea" value="'.$cart_item_quantity.'" disabled>
											<label for="floatingTextarea">Quantity</label>
										</div>
									</div>
									<div class="col-3">
										<div class="form-floating">
											<input class="text-center form-control border-0 bg-transparent" placeholder="Leave a comment here" id="floatingTextarea" value="'.$cart_item_curr.$cart_item_total.'" disabled>
											<label for="floatingTextarea">Total</label>
										</div>
									</div>
								</div>
							</div>
						</cart-item>
					');
				}
			}
		} else {
			print('
				<div class="border-bottom row p-3">
					<div class="col-12 p-3 text-center">
						<span> Your cart is empty </span>
					</div>
				</div>
			');
		}
	?>
</div>