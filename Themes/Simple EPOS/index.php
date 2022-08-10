<?
	//CHECK IF THE USER IS ALLOWED TO ACCESS THE WEBSITE
		if($user_ok) {
			if(mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Users_permissions` WHERE `UID`=%s LIMIT 1", $userdata['ID'])))['Access_admin'] != 1) {
				$user_ok = false;
			}
		}
		//require_user_ok();
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
?>
<!DOCTYPE html>
	<html lang="en">
		<head runat="server">
			<!-- ===== Meta ===== -->
				<meta charset="utf-8">
				<meta content="ie=edge" http-eqiv="X-UA-Compatible">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<meta name="title" content="<?print($website_info['Meta_title'])?>">
				<meta name="description" content="<?print($website_info['Meta_description'])?>">
				<meta name="keywords" content="<?print($website_info['Meta_keywords'])?>">
				<meta name="theme-color" content="<?print($website_info['Meta_colour'])?>">
			<!-- ===== Title ===== -->
				<title>
					<?
						print(
							(($layout_row['page_title']=="")?"":$layout_row['page_title']." | "). $website_info['Title']." - ".$website_info['Slogan']
						)
					?>
				</title>
			<!-- ===== Favicon ===== -->
				<link rel="shortcut icon" href="<?print(__API__.'/Images/Fetch/'.$website_info['Favicon'].'/')?>" type="image/x-icon" />
			<!-- ===== PWA ===== -->
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
			<!-- ===== Apple =====-->
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
			<!-- ===== CSS ===== -->
				<?
					if($layout_row['style_ids'] != NULL) {
						print(printStyles($layout_row['style_ids']));
					}
				?>
				<link rel="stylesheet" href="/style.css">
			<!-- ===== EOS =====-->
		</head>
		<body>
			<!-- ===== Javascript ===== -->
				<?
					if($layout_row['script_ids'] != NULL) {
						printScripts($layout_row['script_ids']);
					}
				?>
				<script src="/script.js" type="text/javascript"></script>
			<!-- ===== Preloader ===== -->
			<!-- ===== Content ===== -->
				<style>
					main > .row > div {
						padding: unset;
						margin: unset;
					}
					.row {
						margin: unset;
					}
					.header {
						color: #f6f6f6;
						background: #3d4c53;
						height: 50px;
					}
					.header .left {
						text-align: left;
					}
					.header .middle {
						text-align: center;
					}
					.header .right {
						text-align: right;
					}
					.header .right .date {

					}
					.header .right .time {

					}
					.content {
						color: #3d4c53;
						background: #f6f6f6;
						height: calc(100vh - 50px);
					}
					.keypad {
						color: #f6f6f6;
						background: #3d4c53;
						height: calc(100vh - 50px);
						padding: 10px;
					}
					.content > div,
					.keypad > div {
						padding: 5px;
						--height: calc(100vw / 12);
						min-height: calc(var(--height) * 0.5);
					}
					.productSearch,
					.sidebarButton {
						font-size: 1rem;
						color: #f6f6f6;
						text-align: center;
						height: 100%;
						width: 100%;
					}
					.sidebarButton.numpad {
						font-size: 2rem;
						background: #45585f;
						border: solid 1px #55656b;
					}
					.sidebarButton.numpad:hover {
						background: #3E5259;
						transition: 0.25s background;
					}
					.sidebarButton.numpad:active {
						background: #374d54;
						transition: background 0.25s;
					}
					.sidebarButton.checkout {
						background: #68a2ff;
					}
					.sidebarButton.shortcut {
						background: #f7f7f7;
						color: #3d4c53;
					}
					.sidebarButton.void {
						background: #f85448;
						color: #f7f7f7;
					}
					.sidebarButton.enter {
						background: #38526d;
						border: solid 1px #55656b;
					}
					.productSearch.bar {
						color: black;
						background: white;
						border: solid 1px #dbdee1;
						border-radius: 5px;
					}
					.productSearch.submit {
						background: #f9bd4e;
						border: solid 1px #e8bb6a;
						border-radius: 5px;
					}
				</style>
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
				<script>
					$('document').ready(function(){
						var interval = setInterval(function(){
							var date = new Date();
							var d = date.getDate();
							var day = (d < 10) ? "0" + d : d;
							var m = date.getMonth() + 1;
							var month = (m < 10) ? "0" + m : m;
							var year = date.getFullYear();
							$('span.date').html(day + '/' + month + '/' + year);
							var h = date.getHours();
							var hour = (h < 10) ? "0" + h : h;
							var m = date.getMinutes();
							var minute = (m < 10) ? "0" + m : m;
							$('span.time').html(hour + ':' + minute);
						},100);
					});
				</script>
			<!-- ===== Alerts ===== -->
				<div class="alerts"> </div>
			<!-- ===== Modals ===== -->
				<div class="modals"> </div>
			<!-- ===== PWA ===== -->
				<script type="module">
					import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

					const el = document.createElement('pwa-update');
					document.body.appendChild(el);
				</script>
			<!-- ===== EOF ===== -->
		</body>
	</html>
<?
		}
	} else {
		header('location: /Error/404');
   }
?>