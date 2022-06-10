<?
	if(strtolower($secext)=='all'){
		$title='ALL PRODUCTS.';
		$sql = 'SELECT * FROM `products` WHERE `active`=1';
	} else {
		$title = strtoupper($secext).' COLLECTION.';
		$sql = "SELECT * FROM `pADMINroduct_collections` where `title`='$secext' AND `active`=1 LIMIT 1";
		if($result = DB_Query($sql)){
			$collection = mysqli_fetch_row($result);
			$sql = "SELECT * FROM `products` WHERE `collection_id`='$secext' AND `active`=1";
		}
	}
?>
<div class="container-fluid py-5">
	<div class="row justify-content-center">
		<h5 class="text-center"><?echo $title ?></h5>
		<!-- :: PRODUCTS SLIDER SLIM :: -->
		<div class="row boutique products-slider-slim">
			<?
				if($result = DB_Query($sql)) {
					while($row = mysqli_fetch_array($result)){
						$prod_sku = $row['SKU'];
						$prod_price = $row['RetailPrice'];
						$prod_slug = $row['Slug'];
						$prod_title = $row['Title'];
						$prod_rating = $row['Rating'];
						$prod_image = explode(',',$row['Images'])[0];
						$fmt = new NumberFormatter( locale_get_default()."@currency=".$row['Currency'], NumberFormatter::CURRENCY );
						$prod_currency = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
						echo '
							<li class="product-list-item">
								<article class="product">
									<div class="product-image">
										<picture>
											<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/jpeg/" type="image/jpeg"/>
											<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/jpg/" type="image/jpg"/>
											<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/png/" type="image/png"/>
											<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/jpx/" type="image/jpx"/>
											<img src="'.__API__.'/Images/fetch/'. $prod_image .'/webp/" type="image/webp" width="100%" height="auto">
										</picture>
									</div>
									<div class="product-content">
										<h3 class="product-title">'. $prod_title .'</h3>
										<div class="product-rating">
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($prod_rating > 0)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($prod_rating > 1)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($prod_rating > 2)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($prod_rating > 3)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($prod_rating > 4)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
										</div>
										<div class="product-info">
											<span class="product-price">' . $prod_currency . $prod_price .'</span>
											<div class="product-btn-group">
												<a href="/Boutique/Product/'. $prod_slug .'/" class="product-btn">
													<i class="fad fa-info-circle"></i>
												</a>
												<button class="product-btn product-btn--add" onClick="';
												if($user_ok){
													print('cart.add('.$userdata['ID'].', '.$prod_sku.')');
												} else {
													print('modal.create(\'login-cart\', true)');
												}
												echo '">
													<i class="fad fa-cart-plus"></i>
												</button>
											</div>
										</div>
									</div>
								</article>
							</li>
						';
					}
				} else {
					echo 'ERROR: UNABLE TO COLLECT PRODUCT DATA';
				}
			?>
		</div>
	</div>
</div>

<?
	$row=$sql=null;
?>