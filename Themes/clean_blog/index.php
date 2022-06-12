<?
	//CHECK IF THE USER IS ALLOWED TO ACCESS THE WEBSITE
	if($user_ok) {
		if(mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Users_permissions` WHERE `UID`=%s LIMIT 1", $userdata['ID'])))['Access_blog'] != 1) {
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
        <head>
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
			<!-- ======= Header ======= -->
                <section class="header-top">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-6 col-lg-4">
                                <div class="float-left">
                                    <ul class="header_social">
                                        <li><a href="#"><i class="ti-facebook"></i></a></li>
                                        <li><a href="#"><i class="ti-twitter"></i></a></li>
                                        <li><a href="#"><i class="ti-instagram"></i></a></li>
                                        <li><a href="#"><i class="ti-skype"></i></a></li>
                                        <li><a href="#"><i class="ti-vimeo"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6 col-sm-6 logo-wrapper">
                                <a href="index.html" class="logo">
                                    <img src="data:image/webp;base64,UklGRsQBAABXRUJQVlA4TLcBAAAvcEAJEPdAkG1TntPcX2gKAoEknv1V9hEIpDiefRYIEBb8R0qQYDWKPzAgS7KttoEuwZKtBIpOiP3vU+89wuT5iuj/BKByT+IX+o6k/91q7C2v+3k5lft/pXFKxc/Pocp/On5eltlnc9M0uWzTNLl8XS93En+ESIYDr7TOKtJ0AjdeHTBYddVdrtROcETpGVLuSjxQTpE9rOKNq6Hn3jErY1TiXXY3SmpqOmIJo5I7UWpfzxxLNCqjy9fU8+G+27p/EwbFPsbOMLcUbTlTQUf4yO64LjJDWVxbSjlZBzhL6Sxt4kiszA56lUyKBjkwnagHgKGEQ86dCuBPQU89AEytVmwjsbi62t7UK0tL9VOrlVRL+h9qy9JQibfeSdwP9a6jGUAyGj/GQYUsD5luR/A/2EbFJ7NGQS/Q7QhxGe9FOtkA8Ew8iDVKHNcDgGuHGpYzxuAF6RoAAhPPYztCFMEy6tZ1N6VUBT5ez1Irl3oZObYt9yLiVgjfAmhT1FTsXYkvAZtiir2otRT8KQoJaBK0K+WJE8WAgwsbQgKmRmAH0AUwhxg/HlUux+v13GbkHbt7e38MDhUDAA==" alt="" >
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 search-trigger">
                                <div class="right-button">
                                    <ul>
                                        <li><a id="search" href="javascript:void(0)"><i class="fas fa-search"></i></a></li>
                                        <li><a href="">About</a></li>
                                        <li><a href="">Subscribe</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="search_input" id="search_input_box" style="display: none;">
                        <div class="container ">
                            <form class="d-flex justify-content-between search-inner">
                                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                                <button type="submit" class="btn"></button>
                                <span class="ti-close" id="close_search" title="Close Search"></span>
                            </form>
                        </div>
                    </div>
                </section>
                <header id="header" class="header_area">
                    <div class="main_menu">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="container">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
                                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                                        <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                                        <li class="nav-item"><a class="nav-link" href="category.html">Categories</a></li>
                                        <li class="nav-item"><a class="nav-link" href="archive.html">Archive</a></li>
                                        <li class="nav-item submenu dropdown">
                                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                            <ul class="dropdown-menu">
                                                <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                                <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="blog.html">Latest news</a></li>
                                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </header>
                <section class="fullwidth-block area-padding-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-5">
                                <div class="single-blog">
                                    <div class="thumb">
                                        <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x1.jpg.pagespeed.ic.kI3tjlgQ4u.webp" alt="" >
                                    </div>
                                    <div class="short_details">
                                        <div class="meta-top d-flex">
                                            <a href="#">Tours &amp; Travel</a>
                                        </div>
                                        <a class="d-block" href="single-blog.html">
                                            <h4>Created face stars sixth forth fow
                                                Earth firmament meat
                                            </h4>
                                        </a>
                                        <div class="meta-bottom d-flex">
                                            <a href="#">March 12 , 2019 . </a>
                                            <a class="dark_font" href="#">By Alen Mark</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="single-blog style_two">
                                    <div class="thumb">
                                        <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x2.jpg.pagespeed.ic.ZtLfecZbHD.webp" alt="" >
                                    </div>
                                    <div class="short_details text-center ">
                                        <div class="meta-top d-flex justify-content-center">
                                            <a href="#">Tours &amp; Travel</a>
                                        </div>
                                        <a class="d-block" href="single-blog.html">
                                            <h4>Created face stars sixth forth fow
                                                Earth firmament meat
                                            </h4>
                                        </a>
                                        <div class="meta-bottom d-flex justify-content-center">
                                            <a href="#">March 12 , 2019 . </a>
                                            <a href="#">By Alen Mark</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-3">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-12">
                                        <div class="single-blog style-three m_b_30">
                                            <div class="thumb">
                                                <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x3.jpg.pagespeed.ic.OnOuKbnkfm.webp" alt="" >
                                            </div>
                                            <div class="short_details">
                                                <div class="meta-top d-flex justify-content-center">
                                                    <a href="#">Lifestyle</a>
                                                </div>
                                                <a class="d-block" href="single-blog.html">
                                                    <h4>The abundantly brought after day fish there image</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-12">
                                        <div class="single-blog style-three">
                                            <div class="thumb">
                                                <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x4.jpg.pagespeed.ic.F7K5DqzTqo.webp" alt="" >
                                            </div>
                                            <div class="short_details">
                                                <div class="meta-top d-flex justify-content-center">
                                                    <a href="#">Lifestyle</a>
                                                </div>
                                                <a class="d-block" href="single-blog.html">
                                                    <h4>The abundantly brought after day fish there image</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="first_block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-xl-6">
                                <div class="single-blog row no-gutters style-four border_one">
                                    <div class="col-12 col-sm-5">
                                        <div class="thumb">
                                            <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x5.jpg.pagespeed.ic.qaPElY7E5w.webp" alt="" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <div class="short_details">
                                            <div class="meta-top d-flex">
                                                <a href="#">Tours &amp; Travel</a>
                                            </div>
                                            <a class="d-block" href="single-blog.html">
                                                <h4>Brought all day domi
                                                    nion appear from
                                                    subdue dominion
                                                    firmament over face
                                                </h4>
                                            </a>
                                            <div class="meta-bottom d-flex">
                                                <a href="#">March 12 , 2019 . </a>
                                                <a class="dark_font" href="#">By Alen Mark</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-3">
                                <div class="single-blog style_five">
                                    <div class="thumb">
                                        <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x6.jpg.pagespeed.ic.CT49rK76fu.webp" alt="" >
                                    </div>
                                    <div class="short_details ">
                                        <div class="meta-top d-flex">
                                            <a href="#">Tours &amp; Travel</a>
                                        </div>
                                        <a class="d-block" href="single-blog.html">
                                            <h4>Abundantly forth late
                                                appear fourth us.
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-3">
                                <div class="single-blog style_five">
                                    <div class="thumb">
                                        <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x7.jpg.pagespeed.ic.xmbRcn6rqj.webp" alt="" >
                                    </div>
                                    <div class="short_details ">
                                        <div class="meta-top d-flex">
                                            <a href="#">Tours &amp; Travel</a>
                                        </div>
                                        <a class="d-block" href="single-blog.html">
                                            <h4>Abundantly forth late
                                                appear fourth us.
                                            </h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="editors_pick area-padding">
                    <div class="container">
                        <div class="row">
                            <div class="area-heading">
                                <h3>Editor Picks</h3>
                                <p>Abundantly creeping saw forth spirit can made appear fourth us.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-xl-6">
                                <div class="single-blog">
                                    <div class="thumb">
                                        <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x8.jpg.pagespeed.ic.R3ITIvvjei.webp" alt="" >
                                    </div>
                                    <div class="short_details pad_25 ">
                                        <div class="meta-top d-flex">
                                            <a href="#">Tours &amp; Travel</a>
                                        </div>
                                        <a class="d-block" href="single-blog.html">
                                            <h4>Created face stars sixth forth
                                                Earth firmament
                                            </h4>
                                        </a>
                                        <div class="meta-bottom d-flex">
                                            <a href="#">March 12 , 2019 . </a>
                                            <a class="dark_font" href="#">By Alen Mark</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-xl-6">
                                <div class="single-blog row no-gutters style-four m_b_30">
                                    <div class="col-12 col-sm-7">
                                        <div class="short_details padd_left_0">
                                            <div class="meta-top d-flex">
                                                <a href="#">Tours &amp; Travel</a>
                                            </div>
                                            <a class="d-block" href="single-blog.html">
                                                <h4 class="font-20">Light that hath itself god
                                                    grass herb dark sea on
                                                    the hath dowe 
                                                </h4>
                                            </a>
                                            <p>Said spirit evening above good twes at god midst deep a wherein very made he seas male very broug sad forth saying right.</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <div class="thumb">
                                            <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x9.jpg.pagespeed.ic.biirPkeP-T.webp" alt="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="single-blog row no-gutters style-four">
                                    <div class="col-12 col-sm-5">
                                        <div class="thumb">
                                            <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x10.jpg.pagespeed.ic.PB8s2Zys3I.webp" alt="" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <div class="short_details padd_right_0">
                                            <div class="meta-top d-flex">
                                                <a href="#">Tours &amp; Travel</a>
                                            </div>
                                            <a class="d-block" href="single-blog.html">
                                                <h4 class="font-20">Light that hath itself god
                                                    grass herb dark sea on
                                                    the hath dowe 
                                                </h4>
                                            </a>
                                            <p>Said spirit evening above good twes at god midst deep a wherein very made he seas male very broug sad forth saying right.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="addvertise">
                                    <a href=""><img src="/Themes/<?print(__THEME__)?>/Assets/img/banner/xadd.jpg.pagespeed.ic.98ufQ7G3mM.webp" alt="" ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="three-block  area-padding">
                    <div class="container">
                        <div class="row">
                            <div class="area-heading">
                                <h3>Fashion News</h3>
                                <p>Abundantly creeping saw forth spirit can made appear fourth us.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="single-blog style-five">
                                    <div class="thumb">
                                        <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x15.jpg.pagespeed.ic.zCBKjKaw3I.webp" alt="" >
                                    </div>
                                    <div class="short_details">
                                        <div class="meta-top d-flex">
                                            <a href="#">shoes</a>/
                                            <a href="#">March 15, 2019</a>
                                        </div>
                                        <a class="d-block" href="single-blog.html">
                                            <h4>Shall for rule whose toge one
                                                may heaven to dat
                                            </h4>
                                        </a>
                                        <div class="meta-bottom d-flex">
                                            <a href="#"><i class="ti-comment"></i>05 comment</a>
                                            <a href="#"><i class="ti-heart"></i> 0 like</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-blog style-five">
                                    <div class="thumb">
                                        <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x16.jpg.pagespeed.ic.u_Qi5kjgWv.webp" alt="" >
                                    </div>
                                    <div class="short_details">
                                        <div class="meta-top d-flex">
                                            <a href="#">shoes</a>/
                                            <a href="#">March 15, 2019</a>
                                        </div>
                                        <a class="d-block" href="single-blog.html">
                                            <h4>Shall for rule whose toge one
                                                may heaven to dat
                                            </h4>
                                        </a>
                                        <div class="meta-bottom d-flex">
                                            <a href="#"><i class="ti-comment"></i>05 comment</a>
                                            <a href="#"><i class="ti-heart"></i> 0 like</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-blog style-five">
                                    <div class="thumb">
                                        <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x17.jpg.pagespeed.ic.2u_YFVeGcb.webp" alt="" >
                                    </div>
                                    <div class="short_details">
                                        <div class="meta-top d-flex">
                                            <a href="#">shoes</a>/
                                            <a href="#">March 15, 2019</a>
                                        </div>
                                        <a class="d-block" href="single-blog.html">
                                            <h4>Shall for rule whose toge one
                                                may heaven to dat
                                            </h4>
                                        </a>
                                        <div class="meta-bottom d-flex">
                                            <a href="#"><i class="ti-comment"></i>05 comment</a>
                                            <a href="#"><i class="ti-heart"></i> 0 like</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="latest-news  area-padding-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="area-heading">
                                <h3>Fashion News</h3>
                                <p>Abundantly creeping saw forth spirit can made appear fourth us.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single-blog style-five">
                                    <div class="thumb">
                                        <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x18.jpg.pagespeed.ic.qa2Fr5AB3t.webp" alt="" >
                                    </div>
                                    <div class="short_details">
                                        <div class="meta-top d-flex">
                                            <a href="#">shoes</a>/
                                            <a href="#">March 15, 2019</a>
                                        </div>
                                        <a class="d-block" href="single-blog.html">
                                            <h4>Brought dreepeth youll blessed
                                                from whose signs over
                                            </h4>
                                        </a>
                                        <div class="meta-bottom d-flex">
                                            <a href="#"><i class="ti-comment"></i>05 comment</a>
                                            <a href="#"><i class="ti-heart"></i> 0 like</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-blog style-five small">
                                            <div class="thumb">
                                                <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x19.jpg.pagespeed.ic.KqmgX_vd7R.webp" alt="" >
                                            </div>
                                            <div class="short_details">
                                                <div class="meta-top d-flex">
                                                    <a href="#">shoes</a>/
                                                    <a href="#">March 15, 2019</a>
                                                </div>
                                                <a class="d-block" href="single-blog.html">
                                                    <h4>Shall for rule whoses
                                                        may heaven to
                                                    </h4>
                                                </a>
                                                <div class="meta-bottom d-flex">
                                                    <a href="#">March 15, 2019</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-blog style-five small">
                                            <div class="thumb">
                                                <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x20.jpg.pagespeed.ic.J9mYg8WMqQ.webp" alt="" >
                                            </div>
                                            <div class="short_details">
                                                <div class="meta-top d-flex">
                                                    <a href="#">shoes</a>/
                                                    <a href="#">March 15, 2019</a>
                                                </div>
                                                <a class="d-block" href="single-blog.html">
                                                    <h4>Shall for rule whoses
                                                        may heaven to
                                                    </h4>
                                                </a>
                                                <div class="meta-bottom d-flex">
                                                    <a href="#">March 15, 2019</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-blog style-five small">
                                            <div class="thumb">
                                                <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x21.jpg.pagespeed.ic.WyVqQeP8d-.webp" alt="" >
                                            </div>
                                            <div class="short_details">
                                                <div class="meta-top d-flex">
                                                    <a href="#">shoes</a>/
                                                    <a href="#">March 15, 2019</a>
                                                </div>
                                                <a class="d-block" href="single-blog.html">
                                                    <h4>Shall for rule whoses
                                                        may heaven to
                                                    </h4>
                                                </a>
                                                <div class="meta-bottom d-flex">
                                                    <a href="#">March 15, 2019</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-blog style-five small">
                                            <div class="thumb">
                                                <img class="img-fluid" src="/Themes/<?print(__THEME__)?>/Assets/img/magazine/x22.jpg.pagespeed.ic.Pl_jvmNF5_.webp" alt="" >
                                            </div>
                                            <div class="short_details">
                                                <div class="meta-top d-flex">
                                                    <a href="#">shoes</a>/
                                                    <a href="#">March 15, 2019</a>
                                                </div>
                                                <a class="d-block" href="single-blog.html">
                                                    <h4>Shall for rule whoses
                                                        may heaven to
                                                    </h4>
                                                </a>
                                                <div class="meta-bottom d-flex">
                                                    <a href="#">March 15, 2019</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="instagram">
                    <div class="row no-gutters">
                        <div class="col-2">
                            <a href=""><img src="/Themes/<?print(__THEME__)?>/Assets/img/instagram/x1.jpg.pagespeed.ic.3_eOt8F4XH.webp" alt="" ></a>
                        </div>
                        <div class="col-2">
                            <a href=""><img src="/Themes/<?print(__THEME__)?>/Assets/img/instagram/x2.jpg.pagespeed.ic.gPg6abEm-g.webp" alt="" ></a>
                        </div>
                        <div class="col-2">
                            <a href=""><img src="/Themes/<?print(__THEME__)?>/Assets/img/instagram/x3.jpg.pagespeed.ic.5WsMxMN_0v.webp" alt="" ></a>
                        </div>
                        <div class="col-2">
                            <a href=""><img src="/Themes/<?print(__THEME__)?>/Assets/img/instagram/x4.jpg.pagespeed.ic.GkjdfAYrlv.webp" alt="" ></a>
                        </div>
                        <div class="col-2">
                            <a href=""><img src="/Themes/<?print(__THEME__)?>/Assets/img/instagram/x5.jpg.pagespeed.ic.fwnMPKrUbk.webp" alt="" ></a>
                        </div>
                        <div class="col-2">
                            <a href=""><img src="/Themes/<?print(__THEME__)?>/Assets/img/instagram/x5.jpg.pagespeed.ic.fwnMPKrUbk.webp" alt="" ></a>
                        </div>
                    </div>
                </section>

                <footer class="footer-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
                                <h4>About Us</h4>
                                <p>Heaven fruitful doesn't over lesser days appear creeping seasons so behold bearing days open</p>
                                <div class="footer-logo">
                                    <img src="data:image/webp;base64,UklGRsQBAABXRUJQVlA4TLcBAAAvcEAJEPdAkG1TntPcX2gKAoEknv1V9hEIpDiefRYIEBb8R0qQYDWKPzAgS7KttoEuwZKtBIpOiP3vU+89wuT5iuj/BKByT+IX+o6k/91q7C2v+3k5lft/pXFKxc/Pocp/On5eltlnc9M0uWzTNLl8XS93En+ESIYDr7TOKtJ0AjdeHTBYddVdrtROcETpGVLuSjxQTpE9rOKNq6Hn3jErY1TiXXY3SmpqOmIJo5I7UWpfzxxLNCqjy9fU8+G+27p/EwbFPsbOMLcUbTlTQUf4yO64LjJDWVxbSjlZBzhL6Sxt4kiszA56lUyKBjkwnagHgKGEQ86dCuBPQU89AEytVmwjsbi62t7UK0tL9VOrlVRL+h9qy9JQibfeSdwP9a6jGUAyGj/GQYUsD5luR/A/2EbFJ7NGQS/Q7QhxGe9FOtkA8Ew8iDVKHNcDgGuHGpYzxuAF6RoAAhPPYztCFMEy6tZ1N6VUBT5ez1Irl3oZObYt9yLiVgjfAmhT1FTsXYkvAZtiir2otRT8KQoJaBK0K+WJE8WAgwsbQgKmRmAH0AUwhxg/HlUux+v13GbkHbt7e38MDhUDAA==" alt="" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
                                <h4>Contact Info</h4>
                                <div class="footer-address">
                                    <p>Address : Your address goes here, your demo address.</p>
                                    <span>Phone : +8880 44338899</span>
                                    <span>Email : info@colorlib.com</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
                                <h4>Important Link</h4>
                                <ul>
                                    <li><a href="#">WHMCS-bridge</a></li>
                                    <li><a href="#">Search Domain</a></li>
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Shopping Cart</a></li>
                                    <li><a href="#">Our Shop</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6 mb-4 mb-xl-0 single-footer-widget">
                                <h4>Newsletter</h4>
                                <p>Heaven fruitful doesn't over lesser in days. Appear creeping seasons deve behold bearing days open</p>
                                <div class="form-wrap" id="mc_embed_signup">
                                    <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" novalidate="true">
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '">
                                            <div class="input-group-append">
                                                <button class="btn click-btn" type="submit">
                                                    <i class="fab fa-telegram-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div style="position: absolute; left: -5000px;">
                                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                        </div>
                                        <div class="info"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="footer-bottom row align-items-center text-center text-lg-left no-gutters">
                            <p class="footer-text m-0 col-lg-8 col-md-12">
                                Copyright ©<script>document.write(new Date().getFullYear());</script>2022 All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            </p>
                            <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                                <a href="#"><i class="ti-facebook"></i></a>
                                <a href="#"><i class="ti-twitter-alt"></i></a>
                                <a href="#"><i class="ti-dribbble"></i></a>
                                <a href="#"><i class="ti-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </footer>
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