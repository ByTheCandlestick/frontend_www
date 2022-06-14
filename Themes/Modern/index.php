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
			<!-- ======= Navbar ======= -->
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
					<div class="container">
						<a class="navbar-brand" href="#!">Start Bootstrap</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
								<li class="nav-item"><a class="nav-link" href="#">Home</a></li>
								<li class="nav-item"><a class="nav-link" href="#!">About</a></li>
								<li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
								<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
							</ul>
						</div>
					</div>
				</nav>
			<!-- ======= Header ======= -->
				<header class="py-5 bg-light border-bottom mb-4">
					<div class="container">
						<div class="text-center my-5">
							<h1 class="fw-bolder">Welcome to Blog Home!</h1>
							<p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
						</div>
					</div>
				</header>
			<!-- ======= Content ======= -->
				<div class="container">
					<div class="row">
						<!-- Blog entries-->
						<div class="col-lg-8">
							<!-- Featured blog post-->
							<div class="card mb-4">
								<a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
								<div class="card-body">
									<div class="small text-muted">January 1, 2022</div>
									<h2 class="card-title">Featured Post Title</h2>
									<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
									<a class="btn btn-primary" href="#!">Read more →</a>
								</div>
							</div>
							<!-- Nested row for non-featured blog posts-->
							<div class="row">
								<div class="col-lg-6">
									<!-- Blog post-->
									<div class="card mb-4">
										<a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
										<div class="card-body">
											<div class="small text-muted">January 1, 2022</div>
											<h2 class="card-title h4">Post Title</h2>
											<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
											<a class="btn btn-primary" href="#!">Read more →</a>
										</div>
									</div>
									<!-- Blog post-->
									<div class="card mb-4">
										<a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
										<div class="card-body">
											<div class="small text-muted">January 1, 2022</div>
											<h2 class="card-title h4">Post Title</h2>
											<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
											<a class="btn btn-primary" href="#!">Read more →</a>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<!-- Blog post-->
									<div class="card mb-4">
										<a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
										<div class="card-body">
											<div class="small text-muted">January 1, 2022</div>
											<h2 class="card-title h4">Post Title</h2>
											<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
											<a class="btn btn-primary" href="#!">Read more →</a>
										</div>
									</div>
									<!-- Blog post-->
									<div class="card mb-4">
										<a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
										<div class="card-body">
											<div class="small text-muted">January 1, 2022</div>
											<h2 class="card-title h4">Post Title</h2>
											<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam.</p>
											<a class="btn btn-primary" href="#!">Read more →</a>
										</div>
									</div>
								</div>
							</div>
							<!-- Pagination-->
							<nav aria-label="Pagination">
								<hr class="my-0" />
								<ul class="pagination justify-content-center my-4">
									<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
									<li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
									<li class="page-item"><a class="page-link" href="#!">2</a></li>
									<li class="page-item"><a class="page-link" href="#!">3</a></li>
									<li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
									<li class="page-item"><a class="page-link" href="#!">15</a></li>
									<li class="page-item"><a class="page-link" href="#!">Older</a></li>
								</ul>
							</nav>
						</div>
						<!-- Side widgets-->
						<div class="col-lg-4">
							<!-- Search widget-->
							<div class="card mb-4">
								<div class="card-header">Search</div>
								<div class="card-body">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
										<button class="btn btn-primary" id="button-search" type="button">Go!</button>
									</div>
								</div>
							</div>
							<!-- Categories widget-->
							<div class="card mb-4">
								<div class="card-header">Categories</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-6">
											<ul class="list-unstyled mb-0">
												<li><a href="#!">Web Design</a></li>
												<li><a href="#!">HTML</a></li>
												<li><a href="#!">Freebies</a></li>
											</ul>
										</div>
										<div class="col-sm-6">
											<ul class="list-unstyled mb-0">
												<li><a href="#!">JavaScript</a></li>
												<li><a href="#!">CSS</a></li>
												<li><a href="#!">Tutorials</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- Side widget-->
							<div class="card mb-4">
								<div class="card-header">Side Widget</div>
								<div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
							</div>
						</div>
					</div>
				</div>
			<!-- ======= Footer ======= -->
				<footer class="py-5 bg-dark">
					<div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
				</footer>
			<!-- ======= Modals ======= -->
				<modals></modals>
			<!-- ======= Alerts ======= -->
				<alerts class="position-fixed bottom-0 mb-5 start-0 ms-3 mw-100"></alerts>
			<!-- ======= FAB ======= -->
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