<?
	//CHECK IF THE USER IS ALLOWED TO ACCESS THE WEBSITE
	if($user_ok) {
		if(mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Users_permissions` WHERE `UID`=%s LIMIT 1", $userdata['ID'])))['Access_www'] != 1) {
			header('Location: /Error/401/');
		}
	}
	require_once('./Classes/analytics.php');
	// Determine the required row from the page requested
	$domainID = domainID();
	if(QS_SUBPAGE != NULL) {
		$query = sprintf("SELECT * FROM `page_layouts`  WHERE `page_url`='%s' AND `subpage_url`='%s' AND `domain_id`='%s' LIMIT 1", QS_PAGE, QS_SUBPAGE, $domainID);
		try {
			if(mysqli_num_rows($layout_results = DB_Query($query)) == 0) {
				throw new Exception();
			}
		} catch (Exception $er) {
			$query = sprintf("SELECT * FROM `page_layouts`  WHERE `page_url`='%s' AND `domain_id`='%s' LIMIT 1", QS_PAGE, $domainID);
		}
	} else {
		$query = sprintf("SELECT * FROM `page_layouts`  WHERE `page_url`='%s' AND `domain_id`='%s' LIMIT 1", QS_PAGE, $domainID);
	}
	// get the page information
	if(QS_PAGE!=null && mysqli_num_rows($layout_results = DB_Query($query)) > 0) {
		while($layout_row = mysqli_fetch_assoc($layout_results)) {
			$info = array();
			$info_results = DB_Query("SELECT * FROM `shop_info`");
			while($info_row = mysqli_fetch_row($info_results)) {
				$info[$info_row[1]] = $info_row[2]; 
			}
?>
<!DOCTYPE html>
	<html lang="en">
		<head runat="server">
			<meta charset="utf-8">
			<meta content="ie=edge" http-eqiv="X-UA-Compatible">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="title" content="<?print($info['meta_title'])?>">
			<meta name="description" content="<?print($info['meta_description'])?>">
			<meta name="keywords" content="<?print($info['meta_keywords'])?>">
			<meta name="theme-color" content="<?print($info['meta_colour'])?>">
			<title>
				<?
					print(
						(($layout_row['page_title']=="")?"":$layout_row['page_title']." | "). $info['name']." - ".$info['slogan']
					)
				?>
			</title>
			<link rel="shortcut icon" href="<?print(__API__.'/Images/Fetch/candlestickLogo-transparent_20220530162542/')?>" type="image/x-icon" />
			<!-- Progresive Web App -->
				<link rel="manifest" href="/manifest.json" />
		  		<script>
					if ('serviceWorker' in navigator) {
						navigator.serviceWorker
							.register('/sw.js')
							.then(function(registration) {
								console.log('Registration successful, scope:', registration.scope);
							})
							.catch(function(error) {
								console.log('Service worker registration failed, error:', error);
							});
					} else {
						console.log('Service Workers are not supported');
					}
				</script>
			<!-- APPLE-->
				<link rel="apple-touch-icon" sizes="57x57" href="/Themes/<?print(__THEME__)?>/Assets/images/logos/apple-touch-icon/57x57.png">
				<link rel="apple-touch-icon" sizes="60x60" href="/Themes/<?print(__THEME__)?>/Assets/images/logos/apple-touch-icon/60x60.png">
				<link rel="apple-touch-icon" sizes="72x72" href="/Themes/<?print(__THEME__)?>/Assets/images/logos/apple-touch-icon/72x72.png">
				<link rel="apple-touch-icon" sizes="76x76" href="/Themes/<?print(__THEME__)?>/Assets/images/logos/apple-touch-icon/76x76.png">
				<link rel="apple-touch-icon" sizes="114x114" href="/Themes/<?print(__THEME__)?>/Assets/images/logos/apple-touch-icon/114x114.png">
				<link rel="apple-touch-icon" sizes="120x120" href="/Themes/<?print(__THEME__)?>/Assets/images/logos/apple-touch-icon/120x120.png">
				<link rel="apple-touch-icon" sizes="144x144" href="/Themes/<?print(__THEME__)?>/Assets/images/logos/apple-touch-icon/144x144.png">
				<link rel="apple-touch-icon" sizes="152x152" href="/Themes/<?print(__THEME__)?>/Assets/images/logos/apple-touch-icon/152x152.png">
				<link rel="apple-touch-icon" sizes="180x180" href="/Themes/<?print(__THEME__)?>/Assets/images/logos/apple-touch-icon/180x180.png">
				<link rel="apple-touch-startup-image" href="/Themes/<?print(__THEME__)?>/app/images/splash/splash-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
				<link rel="apple-touch-startup-image" href="/Themes/<?print(__THEME__)?>/app/images/splash/splash-750x1294.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
				<link rel="apple-touch-startup-image" href="/Themes/<?print(__THEME__)?>/app/images/splash/splash-1242x2148.png" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
				<link rel="apple-touch-startup-image" href="/Themes/<?print(__THEME__)?>/app/images/splash/splash-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
				<link rel="apple-touch-startup-image" href="/Themes/<?print(__THEME__)?>/app/images/splash/splash-1536x2048.png" media="(min-device-width: 768px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
				<link rel="apple-touch-startup-image" href="/Themes/<?print(__THEME__)?>/app/images/splash/splash-1668x2224.png" media="(min-device-width: 834px) and (max-device-width: 834px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
				<link rel="apple-touch-startup-image" href="/Themes/<?print(__THEME__)?>/app/images/splash/splash-2048x2732.png" media="(min-device-width: 1024px) and (max-device-width: 1024px) and (-webkit-min-device-pixel-ratio: 2) and (orientation: portrait)">
			<!-- CSS -->
				<?
					if($layout_row['style_ids'] != NULL) {
						print(printStyles($layout_row['style_ids']));
					}
				?>
				<link rel="stylesheet" href="/Themes/<?print(__THEME__)?>/Assets/css/style.css">
			<!-- -->
		</head>
		<body class="online" onLoad="cookie.acceptanceCheck();">
			<!-- ======= Javascript ======= -->
				<?
					if($layout_row['script_ids'] != NULL) {
						printScripts($layout_row['script_ids']);
					}
				?>
				<script src="/Themes/<?print(__THEME__)?>/Assets/js/script.js" type="text/javascript"></script>
			<!-- ======= Preloader ======= -->
				<div class="preloader-container">
					<div class="preloader">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			<!-- ======= Top Bar ======= -->
				<section id="topbar" class="d-flex p-0 align-items-center">
					<?
						if($result = DB_Query("SELECT * FROM `section_topbar_ticker` WHERE `locale`='all'")) {
							while($ticks = mysqli_fetch_array($result)) {
								echo '<div>'. $ticks['TextEncoded'] .'</div>';
							}
						}
					?>
				</section>
			<!-- ======= Header ======= -->
				<header id="header" class="d-flex align-items-center">
					<div class="container d-flex align-items-center">
						<div class="logo me-auto d-flex">
							<a class="me-3" href="/">
								<img src="<?print(__API__.'/Images/Fetch/'.$info['Logo'].'/')?>" alt="logo" width="60px" height="60px" class="img-fluid" title="The Candlestick Logo">
							</a>
						  <h1 class="d-none d-md-block"><a href="/"><?print($info['name'])?></a></h1>
					  </div>
						<nav id="navbar" class="navbar">
							<ul>
								<li><a class="nav-link<?(strtolower(QS_PAGE)=='index')?print(' active'):null; ?>" href="/">Home</a></li>
								<li><a class="nav-link<?(strtolower(QS_PAGE)=='about')?print(' active'):null; ?>" href="/About">About us</a></li>
								<li><a class="nav-link<?(strtolower(QS_PAGE)=='boutique' && strtolower(QS_SUBPAGE)=='partners')?print(' active'):null; ?>" href="/Boutique/Partners">Our partners</a></li>
								<li class="dropdown">
									<a class="nav-link<?(strtolower(QS_PAGE)=='boutique' && strtolower(QS_SUBPAGE)!='partners')?print(' active'):null; ?>"><span>Boutique</span> <i class="fad fa-chevron-down"></i></a>
									<ul>
										<li><a href="/Boutique">All</a></li>
										<?
											if($query = DB_Query("SELECT `Category_ID`, COUNT(`Category_ID`) AS Frequency FROM `products` WHERE `Active`=1 GROUP BY `Category_ID` ORDER BY COUNT(`Category_ID`) DESC")) {
												if(mysqli_num_rows($query) > 0) {
													while($row = mysqli_fetch_assoc($query)) {
														$category_id = $row['Category_ID'];
														if($range_query = DB_Query("SELECT `Name` FROM `products_categories` WHERE `ID`=$category_id")) {
															$title = mysqli_fetch_array($range_query);
															print("
																<li>
																	<a href=\"/Boutique/#$title[0]\">$title[0]</a>
																</li>
															");
														}
													}
												}
											}
										?>
									</ul>
								</li>
								<?
									if(!$user_ok) { ?>
										<li><a class="nav-link<?(strtolower(QS_PAGE)=='login')?print(' active'):null; ?>" href="/Login">Login</a></li>
								<?} else { ?>
										<li><a class="nav-link<?(strtolower(QS_PAGE)=='my')?print(' active'):null; ?>" href="/My">My Account</a></li>
										<li><a class="nav-link<?(strtolower(QS_PAGE)=='cart')?print(' active'):null; ?>" href="/Cart">
											<i class="d-none d-md-block fad fa-2x fa-shopping-bag"></i>
											<p class="d-block d-md-none">My Cart</p>
										</a></li>
								<?} ?>
							</ul>
							<i class="fad fa-bars mobile-nav-toggle"></i>
						</nav>
					</div>
				</header>
			<!-- ======= Content ======= -->
				<?
					if($layout_row['display_type'] == 1) {
						if($layout_row['section_ids'] != null) {
							printSections($layout_row['section_ids']);
						} else {
							Redirect('/Error/404/');
						}
					} else {
						include('./Pages/'.$layout_row['page_file'].'.php');
					}
				?>
			<!-- ======= Footer ======= -->
				<footer id="footer">
					<div class="pt-3 footer-top">
						<div class="container">
							<div class="footer-cols">
								<div class="text-center footer-col-1 footer-links">
									<h4>Account</h4>
									<ul class="d-inline-block">
									<?
										if($user_ok) {
									?>
										<li>
											<i class="fad fa-user pe-1"></i>
											<a href="/My/">My Account</a>
										</li>
										<?
											if(mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Users_permissions` WHERE `UID`=%s LIMIT 1", $userdata['ID'])))['Access_admin'] == 1) {
												$admin_url = (($_SERVER['HTTPS'])?'https://':'http://').'admin.'.removeSubdomain($_SERVER['HTTP_HOST']);
										?>
											<li>
												<i class="fad fa-cogs pe-1"></i>
												<a href="<?print($admin_url)?>?force_back=1">Open admin dashboard</a>
											</li>
											<li>
												<i class="fad fa-pencil pe-1"></i>
												<a href="<?print($admin_url.'/Website/Page/'.$layout_row['ID'].'/?force_back=1')?>">Edit this page</a>
											</li>
											<?
												if(isset($product)) {
											?>
												<li>
													<i class="fad fa-pencil pe-1"></i>
													<a href="<?print($admin_url.'/Product/Edit/'.$product['SKU'].'/?force_back=1')?>">Edit this product</a>
												</li>
											<?
												}
												if(isset($partner)) {
											?>
												<li>
													<i class="fad fa-pencil pe-1"></i>
													<a href="<?print($admin_url.'/Partner/Edit/'.$partner['ID'].'/?force_back=1')?>">Edit this partner</a>
												</li>
											<?
												}
											}
										?>
										<li>
											<i class="fad fa-shopping-bag pe-1"></i>
											<a href="/Cart/">My Cart</a>
										</li>
										<li>
											<i class="fad fa-house pe-1"></i>
											<a href="/My/Addresses/">My Addresses</a>
										</li>
										<li>
											<i class="fad fa-id-card pe-1"></i>
											<a href="/My/Cards/">My Cards</a>
										</li>
										<li>
											<i class="fad fa-sign-out pe-1"></i>
											<a href="/Logout/">Logout</a>
										</li>
									<?
										} else {
									?>
										<li>
											<i class="fad fa-sign-in pe-1"></i>
											<a href="/Login/">Login</a>
										</li>
										<li>
											<i class="fad fa-user-plus pe-1"></i>
											<a href="/Register/">Register</a>
										</li>
									<?
										}
									?>
									</ul>
								</div>
								<div class="text-center footer-col-2 footer-links">
									<h4>Policies</h4>
									<ul class="d-inline-block">
										<li><i class="fad fa-link pe-1"></i> <a href="/Pages/privacy-policy">Privacy policy</a></li>
										<li><i class="fad fa-link pe-1"></i> <a href="/Pages/returns-and-refunds">Returns and refunds</a></li>
										<li><i class="fad fa-link pe-1"></i> <a href="/Pages/terms-and-conditions">Terms and conditions</a></li>
										<li><i class="fad fa-link pe-1"></i> <a href="/Pages/terms-of-service">Terms of service</a></li>
									</ul>
								</div>
								<div class="text-center footer-col-3 footer-info">
									<img src="<?print(__API__.'/Images/Fetch/'.$info['Logo'].'/')?>" alt="logo" width="145px" height="145px" class="img-fluid mw-40">
									<h3 class="text-center"><?print($info['name'])?></h3>
									<p class="text-center">
										<strong>Phone:</strong> <a href="tel:<?print($info['phone'])?>"><?print($info['phone'])?></a><br>
										<strong>Email:</strong> <a href="mailto:<?print($info['email'])?>"><?print($info['email'])?></a><br>
									</p>
									<div class="social-links mt-3 text-center">
										<a href="https://www.pinterest.co.uk/bythecandlestick/" class="pintrest"><i class="fab fa-pinterest"></i></a>
										<a href="https://www.facebook.com/bythecandlestick/#" class="facebook"><i class="fab fa-facebook"></i></a>
										<a href="https://www.instagram.com/bythecandlestick/" class="instagram"><i class="fab fa-instagram"></i></a>
									</div>
								</div>
								<div class="text-center footer-col-4 footer-links">
									<h4>Useful Links</h4>
									<ul class="d-inline-block">
										<li><i class="fad fa-link pe-1"></i> <a href="/About">About</a></li>
										<li><i class="fad fa-link pe-1"></i> <a href="https://blog.thecandlestick.co.uk/">Blog</a></li>
										<li><i class="fad fa-link pe-1"></i> <a href="/Team">The team</a></li>
										<li><i class="fad fa-link pe-1"></i> <a href="/Contact">Contact us</a></li>
									</ul>
								</div>
								<div class="text-center footer-col-5 footer-links">
									<h4></h4>
									<ul class="d-inline-block">
										<a href="https://tree-nation.com/profile/impact/the-candlestick#co2" target="_blank" style="display:block;">
											<img src="https://tree-nation.com/images/tracking/label-co2-website-white-en.png" width="157px" height="51px">
										</a>
										<script src="https://tree-nation.com/js/track.js"></script>
										<script>treenation_track("625dea1f1305c");</script>

										</br>

										<a href="https://climate.stripe.com/FwXsu0">
											<div class="Card-root Card--radius--all Card--shadow--extraLarge Box-root Box-hideIfEmpty Box-background--white" style="border-radius: 8px;">
												<div class="SVGInline SVG Box-root Flex-flex">
													<svg class="SVGInline-svg SVG-svg" style="width: 66px;height: 66px;" width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect width="66" height="66" rx="12" fill="#fff"></rect>
														<path d="M46.237 33.087c-4.275 0-9.087-2.962-13.237-5.812-4.4-3.038-9.238-7.05-13.238-7.05-4.087 0-6.762 3.737-6.762 7.05v.287c0 11.046 8.954 20 20 20s20-8.954 20-20c-.134 2.681-2.031 5.525-6.763 5.525z" fill="url(#paint0_linear)"></path>
														<path d="M46.237 20.237c-4 0-8.837 4-13.237 7.038-4.15 2.85-8.962 5.812-13.238 5.812-4.73 0-6.628-2.843-6.762-5.525 0 11.046 8.954 20 20 20s20-8.954 20-20v-.287c0-3.313-2.675-7.05-6.763-7.038z" fill="url(#paint1_linear)"></path><path d="M33 27.274c4.15 2.85 8.962 5.813 13.237 5.813 4.732 0 6.629-2.844 6.763-5.525 0 11.046-8.954 20-20 20s-20-8.954-20-20c.134 2.681 2.031 5.525 6.762 5.525 4.276 0 9.088-2.963 13.238-5.813z" fill="url(#paint2_linear)"></path>
														<defs>
															<linearGradient id="paint0_linear" x1="32.997" y1="32.627" x2="32.997" y2="21.573" gradientUnits="userSpaceOnUse">
																<stop stop-color="#FFD748"></stop>
																<stop offset=".21" stop-color="#FFD644"></stop>
																<stop offset=".33" stop-color="#FFD438"></stop>
																<stop offset=".45" stop-color="#FFD024"></stop>
																<stop offset=".57" stop-color="#FFCB09"></stop>
																<stop offset="1" stop-color="#FFC900"></stop>
															</linearGradient>
															<linearGradient id="paint1_linear" x1="33" y1="21.561" x2="33" y2="33.9" gradientUnits="userSpaceOnUse">
																<stop stop-color="#009C00"></stop>
																<stop offset="1" stop-color="#00BA18"></stop>
															</linearGradient>
															<linearGradient id="paint2_linear" x1="33" y1="47.274" x2="33" y2="27.274" gradientUnits="userSpaceOnUse">
																<stop offset=".13" stop-color="#00CB1B"></stop>
																<stop offset="1" stop-color="#00D924"></stop>
															</linearGradient>
														</defs>
													</svg>
												</div>
											</div>
										</a>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="copyright">
							&copy; Copyright <strong><span>TheCandlestick</span></strong>. All Rights Reserved
						</div>
						<!--
							<div class="credits">
								Designed by <a href="https://design.smithsn.co.uk/" target="_blank" rel="noopener noreferrer">Smith SN Design</a>
							</div>
						-->
					</div>
				</footer>
			<!-- ======= Modals ======= -->
				<modals></modals>
			<!-- ======= Alerts ======= -->
				<alerts class="position-fixed bottom-0 mb-5 start-0 ms-3 mw-100"></alerts>
			<!-- ======= Back to top ======= -->
				<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
					<i class="fad fa-chevron-up"></i>
				</a>
			<!-- ======= Cookies ======= -->
				<div id="gdpr-cookie-message">
					<h4>Cookies &amp; Privacy</h4>
					<p>
						This website uses cookies and similar technologies to improve your experience.
						Please see our Cookie Policy for more information.
					</p>
					<p>
						<a href="/Pages/privacy-policy/#6">More information</a>
						<button id="gdpr-cookie-accept" type="button">Accept</button>
					</p>
				</div>
			<!-- ======= PWA ======= -->
				<script type="module">
					import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

					const el = document.createElement('pwa-update');
					document.body.appendChild(el);
				</script>
			<!-- ======= EOF ======= -->
		</body>
	</html>
<?
		}
		if(isset($analytics_startTime)) {
			$analytics_endTime = microtime(true);
			loadTime($analytics_ID, $timestamp, $uri_full, round(($analytics_endTime - $analytics_startTime) * 1000, 5));
		}
	} else {
		 header('location: /Error/404');
	}
?>