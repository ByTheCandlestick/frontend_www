<div class="px-4 py-2 / px-md-2 py-md-2">
	<options>
		<?
			$prod_sku = $product['SKU'];
			$fmt = new NumberFormatter( locale_get_default()."@currency=".$product['Currency'], NumberFormatter::CURRENCY );
			$prod_currency = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
			$variants = explode(';', $product['Variants']);
			foreach($variants as $variant) {
				[$var_title, $var_options] = explode(':', $variant);
				if(isset($var_title) && isset($var)) {
					$title = ucfirst($var_title);
					$options = explode(',', $var_options);
					if($title != '') {
						print("
							<div class=\"form-floating py-1\">
								<select id=\"select-$title\" class=\"form-select py-2\" onClick=\"$(this).removeClass('is-invalid')\">
									<option value=\"0\" selected>--</option>");
										for($i=0;$i < count($options);$i++) {
											if($options[$i] != '') {
												$option = $options[$i];
												$option_id = $i + 1;
												print("
													<option value=\"$option_id\">$option</option>
												");
											}
										}
						print("
								</select>
								<label for=\"select-$title\">$title</label>
							</div>
						");
					}
				}
			}
		?>
		<div class="form-floating py-1">
			<input id="quantity" type="number" class="text-center form-control" value="1">
			<label for="quantity">Quantity</label>
		</div>
	</options>
	<!-- Price -->
	<span class="d-flex py-2 text-center">
		<?
			$price = $product['RetailPrice'];
			if($product['Discount']) {
				if($product['DiscountType'] = 'percentage') {
					$saleprice = round($price * (1-($product['discount_ammount'] / 100)), 2);
				} elseif($product['discount_type'] = 'ammount') {
					$saleprice = ($price - $product['DiscountAmmount']);
				}
				$savings = $price - $saleprice;
				print("
					<h5 class=\"original-price\"><del>$prod_currency$price</del></h5>
					&nbsp;&nbsp;
					<h5 class=\"sale-price\"> $prod_currency<price>$saleprice</price> </h5>
					<!--
						</br><h5 class=\"saving-price\"> Saving $prod_currency$savings </h5>
					-->
				");
			} else {
				print("
					<h5 class=\"original-price w-100\">
						$prod_currency<price>$price</price>
					</h5>
				");
			}
		?>
	</span>
	<!-- Add to cart -->
	<a class="w-100 btn btn-outline-primary" onClick="
		<?
			if($user_ok){
				print('cart.add('.$userdata['ID'].', '.$prod_sku.')');
			} else {
				print('modal.create(\'login-cart\', true)');
			}
		?>"> Add to cart </a>
</div>