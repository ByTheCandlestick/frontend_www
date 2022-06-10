<div class="row boutique">
	<?
		if(isset($secext) && $secext == 'products') {
			//
				if(isset($_GET['p'])){
					$page = $_GET['p'];
				} else {
					$page = 1;
				}
				$start = ($page - 1) * 16;
				$prd_viewed = $page * 16;
				$count = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `products` WHERE `made_by_ID`=1 AND `Active`=1"))[0];
			//
			$query = DB_Query("SELECT * FROM `products` WHERE `made_by_ID`=1 AND `Active`=1 LIMIT $start, 16");
			if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)) {
					$prod_price = $row['RetailPrice'];
					$prod_sku = $row['SKU'];
					$prod_slug = $row['Slug'];
					$prod_title = $row['Title'];
					$prod_rating = $row['Rating'];
					$prod_image = explode(',',$row['Images'])[0];
					$prod_price = $row['RetailPrice'];
					$fmt = new NumberFormatter( locale_get_default()."@currency=".$row['Currency'], NumberFormatter::CURRENCY );
					$prod_currency = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
					echo '
						<li class="product-list-item col-6 col-md-4 col-xl-3">
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
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
									</div>
									<div class="product-info row">
										<span class="product-price col-12 col-lg-6">' . $prod_currency . $prod_price .'</span>
										<div class="product-btn-group col-12 col-lg-6">
											<a href="/Boutique/Product/'. $prod_slug .'/" class="product-btn">
												<i class="fad fa-info-circle"></i>
											</a>
											<button class="product-btn product-btn--add">
												<i class="fad fa-cart-plus"></i>
											</button>
										</div>
									</div>
								</div>
							</article>
						</li>
					';
				}
				($page > 1)? $prev_status = '': $prev_status = ' disabled';
				($prev_status == '')? $prev_page = "/Boutique/?p=".($page - 1) : $prev_page = "";
				($prd_viewed < $count)? $next_status = '': $next_status = ' disabled';
				($next_status == '')? $next_page = "/Boutique/?p=".($page + 1) : $next_page = "";
				// Previous/Next page button
				print("
					<div class=\"row\">
						<div class=\"col-12 col-md-4 offset-md-4 d-flex\">
							<a class=\"col-4 offset-1 col-md-5 offset-md-0 mt-2 mb-3 d-block btn btn-secondary$prev_status\" href=\"$prev_page\" role=\"button\">Previous</a>
							<a class=\"col-4 offset-2 col-md-5 offset-md-2 mt-2 mb-3 d-block btn btn-secondary$next_status\" href=\"$next_page\" role=\"button\">Next</a>
						</div>
					</div>
				");
			} else {
				echo '
					<li class="product-list-item col-6 col-md-4 col-xl-3">
						<article class="product">
							<div class="product-image">
								<picture>
									<source srcset="'.__API__.'/Images/fetch/not_found/jpeg/" type="image/jpeg"/>
									<source srcset="'.__API__.'/Images/fetch/not_found/jpg/" type="image/jpg"/>
									<source srcset="'.__API__.'/Images/fetch/not_found/png/" type="image/png"/>
									<source srcset="'.__API__.'/Images/fetch/not_found/jpx/" type="image/jpx"/>
									<img src="'.__API__.'/Images/fetch/not_found/webp/" type="image/webp" width="100%" height="auto">
								</picture>
							</div>
							<div class="product-content">
								<h3 class="product-title">No products yet</h3>
							</div>
						</article>
					</li>
				';
			}
		} else if(isset($secext) && $secext == 'partners') {
			$result = DB_Query("SELECT * FROM `partners` WHERE `public`=1 AND `active`=1");
			while($row = mysqli_fetch_array($result)){
				$part_image = $row['logo_url'];
				$part_slug = $row['slug'];
				$part_name = $row['name'];
				$part_rating = $row['rating'];
				print('
					<li class="partner-list-item col-6 col-md-4 col-xl-3">
						<article class="partner">
							<div class="partner-image">
								<picture>
									<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/jpeg/" type="image/jpeg"/>
									<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/jpg/" type="image/jpg"/>
									<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/png/" type="image/png"/>
									<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/jpx/" type="image/jpx"/>
									<img src="'.__API__.'/Images/fetch/'. $part_image .'/webp/" type="image/webp" width="100%" height="auto">
								</picture>
							</div>
							<div class="partner-content">
								<h3 class="partner-title">'. $part_name .'</h3>
								<div class="partner-rating">
									<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 0)?'currentColor' : null).'" viewBox="0 0 256 256">
										<rect width="256" height="256" fill="none"></rect>
										<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
									</svg>
									<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 1)?'currentColor' : null).'" viewBox="0 0 256 256">
										<rect width="256" height="256" fill="none"></rect>
										<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
									</svg>
									<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 2)?'currentColor' : null).'" viewBox="0 0 256 256">
										<rect width="256" height="256" fill="none"></rect>
										<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
									</svg>
									<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 3)?'currentColor' : null).'" viewBox="0 0 256 256">
										<rect width="256" height="256" fill="none"></rect>
										<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
									</svg>
									<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 4)?'currentColor' : null).'" viewBox="0 0 256 256">
										<rect width="256" height="256" fill="none"></rect>
										<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
									</svg>
								</div>
								<div class="partner-info row">
									<div class="partner-btn-group col-12 col-lg-6">
										<a href="/Boutique/Partner/'.$part_slug.'/" class="partner-btn" tabindex="-1">
											<i class="fad fa-info-circle"></i>
										</a>
									</div>
								</div>
							</div>
						</article>
					</li>
				');
			}
		} else if(isset($secext) && $secext == 'partner'){
			$part_ID = mysqli_fetch_row(DB_Query(sprintf("SELECT `ID` FROM `partners` WHERE `name`='%s' AND `public`=1 AND `active`=1", QS)))[0];
			$query = DB_Query("SELECT * FROM `products` WHERE `made_by_ID`='$part_ID' AND `active`=1");
			if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)) {
					$prod_price = $row['RetailPrice'];
					$prod_slug = $row['Slug'];
					$prod_title = $row['Title'];
					$prod_image = explode(',',$row['images'])[0];
					$fmt = new NumberFormatter( locale_get_default()."@currency=".$row['Currency'], NumberFormatter::CURRENCY );
					$prod_currency = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
					echo '
						<li class="product-list-item col-6 col-md-4 col-xl-3">
							<article class="product">
								<div class="product-image">
									<picture>
										<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/jpeg/" type="image/jpeg"/>
										<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/jpg/" type="image/jpg"/>
										<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/png/" type="image/png"/>
										<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/jpx/" type="image/jpx"/>
										<img src="'.__API__.'/Images/fetch/'. $part_image .'/webp/" type="image/webp" width="100%" height="auto">
									</picture>
								</div>
								<div class="product-content">
									<h3 class="product-title">'. $prod_title .'</h3>
									<div class="product-rating">
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
										<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
											<rect width="256" height="256" fill="none"></rect>
											<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
										</svg>
									</div>
									<div class="product-info row">
										<span class="product-price col-12 col-lg-6">' . $prod_currency . $prod_price .'</span>
										<div class="product-btn-group col-12 col-lg-6">
											<a href="/Boutique/Product/'. $prod_slug .'/" class="product-btn">
												<i class="fad fa-plus"></i>
											</a>
											<button class="product-btn product-btn--add">
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
				echo '
					<li class="product-list-item col-6 col-md-4 col-xl-3">
						<article class="product">
							<div class="product-image">
								<picture>
									<source srcset="'.__API__.'/Images/fetch/not_found/jpeg/" type="image/jpeg"/>
									<source srcset="'.__API__.'/Images/fetch/not_found/jpg/" type="image/jpg"/>
									<source srcset="'.__API__.'/Images/fetch/not_found/png/" type="image/png"/>
									<source srcset="'.__API__.'/Images/fetch/not_found/jpx/" type="image/jpx"/>
									<img src="'.__API__.'/Images/fetch/not_found/webp/" type="image/webp" width="100%" height="auto">
								</picture>
							</div>
							<div class="product-content">
								<h3 class="product-title">No products yet</h3>
							</div>
						</article>
					</li>
				';
			}
		} else {
			echo 'unset';
		}
	?>
</div>