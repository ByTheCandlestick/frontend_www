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
		<body class="online">
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
			<!-- ======= Content ======= -->
				<div id="content">
					<div class="inner">
						<?
							// TODO: List all blog posts
							print('
								<article class="box post post-excerpt">
									<header>
										<h2><a href="#">Welcome to Striped</a></h2>
										<p>A free, fully responsive HTML5 site template by HTML5 UP</p>
									</header>
									<div class="info">
										<span class="date"><span class="month">Jul<span>y</span></span> <span class="day">14</span><span class="year">, 2014</span></span>
										<ul class="stats">
											<li><a href="#" class="fa fa-comment">16</a></li>
											<li><a href="#" class="fa fa-heart">32</a></li>
											<li><a href="#" class="fab fa-twitter">64</a></li>
											<li><a href="#" class="fab fa-facebook-f">128</a></li>
										</ul>
									</div>
									<a href="#" class="image featured"><img src="/Themes/'.__THEME__.'/Assets/images/pic01.jpg" alt="" /></a>
									<p>
										<strong>Hello!</strong> You\'re looking at <strong>Striped</strong>, a fully responsive HTML5 site template designed by <a href="http://twitter.com/ajlkn">AJ</a>
										for <a href="http://html5up.net">HTML5 UP</a> It features a clean, minimalistic design, styling for all basic page elements (including blockquotes, tables and lists), a
										repositionable sidebar (left or right), and HTML5/CSS3 code designed for quick and easy customization (see code comments for details).
									</p>
									<p>
										Striped is released for free under the <a href="http://html5up.net/license">Creative Commons Attribution license</a> so feel free to use it for personal projects
										or even commercial ones &ndash; just be sure to credit <a href="http://html5up.net">HTML5 UP</a> for the design. If you like what you see here, be sure to check out
										<a href="http://html5up.net">HTML5 UP</a> for more cool designs or follow me on <a href="http://twitter.com/ajlkn">Twitter</a> for new releases and updates.
									</p>
								</article>
							');
						?>
						<!-- Pagination -->
						<?
							// TODO: Display pagination if necessary
							print('
								<div class="pagination">
									<a href="#" class="button previous">Previous Page</a>
									<div class="pages">
										<a href="#" class="active">1</a>
										<a href="#">2</a>
										<a href="#">3</a>
										<a href="#">4</a>
										<span>&hellip;</span>
										<a href="#">20</a>
									</div>
									<a href="#" class="button next">Next Page</a>
								</div>
							');
						?>
						<!--  -->
					</div>
				</div>
			<!-- ======= Sidebar ======= -->
				<div class="sidebar">
					<!-- Logo -->
						<div class="close d-block d-lg-none">
							<i class="fa fa-times"></i>
						</div>
					<!-- Logo -->
						<h1 id="logo">
							<a href="#">
								<img class="w-50" src="<?print(__API__.'/Images/Fetch/candlestickLogo_20220530162542/')?>"></img>
							</a>
						</h1>
					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li class="current"><a href="#">Latest Post</a></li>
								<li><a href="#">Archives</a></li>
								<li><a href="#">About Me</a></li>
								<li><a href="#">Contact Me</a></li>
							</ul>
						</nav>
					<!-- Search -->
						<section class="box search">
							<div class="search-wrapper" rel="/search.json">
								<div class="search-area">
									<input type="text" onkeyup="search.process(event)" placeholder="Search">
								</div>
								<div class="search-suggestions"> </div>
							</div>
						</section>
					<!-- Text -->
						<section class="box text-style1">
							<div class="inner">
								<p>
									<strong>Striped:</strong> A free and fully responsive HTML5 site
									template designed by <a href="http://twitter.com/ajlkn">AJ</a> for <a href="http://html5up.net/">HTML5 UP</a>
								</p>
							</div>
						</section>
					<!-- Recent Posts -->
						<section class="box recent-posts">
							<header>
								<h2>Recent Posts</h2>
							</header>
							<ul>
								<li><a href="#">Lorem ipsum dolor</a></li>
								<li><a href="#">Feugiat nisl aliquam</a></li>
								<li><a href="#">Sed dolore magna</a></li>
								<li><a href="#">Malesuada commodo</a></li>
								<li><a href="#">Ipsum metus nullam</a></li>
							</ul>
						</section>
					<!-- Recent Comments -->
						<section class="box recent-comments">
							<header>
								<h2>Recent Comments</h2>
							</header>
							<ul>
								<li>case on <a href="#">Lorem ipsum dolor</a></li>
								<li>molly on <a href="#">Sed dolore magna</a></li>
								<li>case on <a href="#">Sed dolore magna</a></li>
							</ul>
						</section>
					<!-- Calendar -->
						<section class="box calendar">
							<div class="inner">
								<table>
									<caption>July 2014</caption>
									<thead>
										<tr>
											<th scope="col" title="Monday">M</th>
											<th scope="col" title="Tuesday">T</th>
											<th scope="col" title="Wednesday">W</th>
											<th scope="col" title="Thursday">T</th>
											<th scope="col" title="Friday">F</th>
											<th scope="col" title="Saturday">S</th>
											<th scope="col" title="Sunday">S</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan="4" class="pad"><span>&nbsp;</span></td>
											<td><span>1</span></td>
											<td><span>2</span></td>
											<td><span>3</span></td>
										</tr>
										<tr>
											<td><span>4</span></td>
											<td><span>5</span></td>
											<td><a href="#">6</a></td>
											<td><span>7</span></td>
											<td><span>8</span></td>
											<td><span>9</span></td>
											<td><a href="#">10</a></td>
										</tr>
										<tr>
											<td><span>11</span></td>
											<td><span>12</span></td>
											<td><span>13</span></td>
											<td class="today"><a href="#">14</a></td>
											<td><span>15</span></td>
											<td><span>16</span></td>
											<td><span>17</span></td>
										</tr>
										<tr>
											<td><span>18</span></td>
											<td><span>19</span></td>
											<td><span>20</span></td>
											<td><span>21</span></td>
											<td><span>22</span></td>
											<td><a href="#">23</a></td>
											<td><span>24</span></td>
										</tr>
										<tr>
											<td><a href="#">25</a></td>
											<td><span>26</span></td>
											<td><span>27</span></td>
											<td><span>28</span></td>
											<td class="pad" colspan="3"><span>&nbsp;</span></td>
										</tr>
									</tbody>
								</table>
							</div>
						</section>
					<!-- Copyright -->
						<ul class="copyright">
							<li>&copy; Copyright <strong><span>TheCandlestick</span></strong>. All Rights Reserved</li>
						</ul>
					<!---->
				</div>
			<!-- ======= Titlebar ======= -->
				<div class="titleBar d-block d-lg-none">
					<a class="toggle"></a>
					<span class="title"></span>
				</div>
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