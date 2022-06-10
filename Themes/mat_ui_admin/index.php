<?
	//CHECK IF THE USER IS ALLOWED TO ACCESS THE WEBSITE
	if($user_ok) {
		if(mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Users_permissions` WHERE `UID`=%s LIMIT 1", $userdata['ID'])))['Access_admin'] != 1) {
			$user_ok = false;
		}
	}
	require_user_ok();
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
			<link rel="shortcut icon" href="/assets/images/logos/logo - transparent.svg" type="image/x-icon" />
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
			<!-- ======= App ======= -->
				<div class="app-container">
					<div class="app-preloader">
						<svg class="pl" viewBox="0 0 128 256" width="128px" height="256px" xmlns="http://www.w3.org/2000/svg">
							<defs>
								<linearGradient id="pl-grad1" x1="0" y1="0" x2="0" y2="1">
									<stop offset="0%" stop-color="rgb(37 95 244)" />
									<stop offset="100%" stop-color="rgb(82 37 244)" />
								</linearGradient>
								<linearGradient id="pl-grad2" x1="0" y1="0" x2="0" y2="1">
									<stop offset="0%" stop-color="rgb(37 199 244)" />
									<stop offset="50%" stop-color="rgb(37 95 244)" />
									<stop offset="100%" stop-color="rgb(82 37 244)" />
								</linearGradient>
							</defs>
							<circle class="pl_ring" r="56" cx="64" cy="192" fill="none" stroke="#ddd" stroke-width="16" stroke-linecap="round" />
							<circle class="pl_worm1" r="56" cx="64" cy="192" fill="none" stroke="url(#pl-grad1)" stroke-width="16" stroke-linecap="round" stroke-dasharray="87.96 263.89" />
							<path class="pl_worm2" d="M120,192A56,56,0,0,1,8,192C8,161.07,16,8,64,8S120,161.07,120,192Z" fill="none" stroke="url(#pl-grad2)" stroke-width="16" stroke-linecap="round" stroke-dasharray="87.96 494" />
						</svg>
					</div>
					<div class="app-header">
						<!-- Brand Info -->
						<div class="app-header-left">
							<span class="app-icon">
								<img src="http://api.candlestick-indev.co.uk/v1/Images/Fetch/candlestickLogo_20220530162542/" alt="logo" width="60px" height="60px" class="img-fluid" title="The Candlestick Logo">
							</span>
							<p class="app-name">The Candlestick</p>
						</div>
						<!-- Search -->
						<div class="search-wrapper" rel="/Themes/<?print(__THEME__)?>/Assets/search.json">
							<div class="search-area">
								<input type="text" onkeyup="search.process(event)" placeholder="Search">
							</div>
							<div class="search-suggestions"> </div>
						</div>
						<!-- Profile, Notifications and Dark mode -->
						<div class="app-header-right">
							<button class="mode-switch" title="Switch Theme">
								<i class="fa-moon fa-lg"></i>
							</button>
							<button class="profile-btn">
								<span><?print($userdata['First_name'].' '.$userdata['Last_name'])?></span>
							</button>
						</div>
					</div>
					<div class="app-content">
						<!-- Sidebar -->
						<div class="app-sidebar">
							<a class="app-sidebar-link app-back-btn">
								<i class="fa fa-arrow-left"></i>
							</a>
							<?
								$items = DB_Query("SELECT * FROM `page_layouts` WHERE `Active`=1 AND `menu_item`=1 ORDER BY `menu_order` ASC");
								foreach($items as $item) {
									if($item['page_url'] == QS_PAGE) {
										$link = '#';
										$active = ' active';
									} else {
										$link = $item['menu_url'];
										$active = '';
									}
									print(sprintf('
										<a href="%s" class="app-sidebar-link%s">
											<i class="fa fa-%s"></i>
										</a>
										',
										$link,
										$active,
										$item['menu_icon']
									));
								}
							?>
						</div>
						<!-- Page Content -->
						<?
							if($layout_row['display_type'] == 1) {
								if($layout_row['section_ids'] != NULL) {
									printSections($layout_row['section_ids']);
								} else {
									Redirect('/Error/404/');
								}
							} else {
								include('./Pages/'.$layout_row['page_file'].'.php');
							}
						?>
						<!-- Alerts -->
						<div class="alerts"> </div>
						<!-- Modals -->
						<div class="modals"> </div>
					</div>
				</div>
			<!-- ======= EOF ======= -->
		</body>
	</html>
<?
		}
	} else {
		header('location: /Error/404');
   }
?>