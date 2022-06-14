<?
	//CHECK IF THE USER IS ALLOWED TO ACCESS THE WEBSITE
	if($user_ok) {
		if(mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Users_permissions` WHERE `UID`=%s LIMIT 1", $userdata['ID'])))['Access_admin'] != 1) {
			$user_ok = false;
		}
	}
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
		<body>
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
			<!-- ======= Topbar ======= -->
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
				<footer class="py-5 bg-dark">
					<div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
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
	} else {
		header('location: /Error/404');
   }
?>