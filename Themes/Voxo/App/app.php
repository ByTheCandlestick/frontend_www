<!DOCTYPE html>
	<html>
		<head>
			<title> By The Candlestick </title>
			<link rel="icon" type="image/x-icon" href="/images/logos/192.png">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1, shrink-to-fit=no">
			<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
			<link rel="stylesheet" href="assets/style.css" />
		</head>
		<body>
			<!-- remove FOUC -->
			<style>
				.js body {
					display: none;
				}
			</style>
			<script>
				document.getElementsByTagName("html")[0].classList.add('js');
			</script>
			
			<!-- the good stuff -->
			<div class="tab-container">
				<!-- nav -->
				<nav class="tab-controller">
					<ul>
						<li><i class="icon ion-android-list"></i><span class="title">Home</span></li>
						<li><i class="icon ion-paintbrush"></i><span class="title">Design</span></li>
						<li><i class="icon ion-code"></i><span class="title">Development</span></li>
						<li><i class="icon ion-filing"></i><span class="title">Resources</span></li>
						<li><i class="icon ion-android-menu"></i><span class="title">More</span></li>
					</ul>
				</nav>
			
				<!-- content -->
				<div class="tab-content-container">
			
					<div class="tab-content">
						<div class="tab-top-bar">
							<i class="align-left icon ion-android-add"></i>
							<img src="https://curabites.com/wp-content/themes/curabites-2016/assets/images/curabites-logo.svg" class="logo">
			
							<i class="align-right icon ion-android-search"></i>
						</div>
			
						<div class="tab-post">
							<div class="tab-post-media">
								<!-- responsive youtube embed-->
								<div class='embed-container'>
									<iframe src='https://www.youtube.com/embed/QILiHiTD3uc' frameborder='0' allowfullscreen></iframe>
								</div>
							</div>
			
							<div class="tab-post-content">
								<h1>Title</h1>
								<p>Lorem ipsum</p>
							</div>
						</div>
					</div>
			
					<div class="tab-content">
						<div class="tab-top-bar">
							<h1 class="title">Design</h1>
						</div>
						<div class="tab-placeholder">Tab 1 content</div>
					</div>
			
					<div class="tab-content">
						<div class="tab-top-bar">
							<h1 class="title">Development</h1>
						</div>
						<div class="tab-placeholder">Tab 2 content</div>
					</div>
			
					<div class="tab-content">
						<div class="tab-top-bar">
							<h1 class="title">Resources</h1>
						</div>
						<div class="tab-placeholder">Tab 3 content</div>
					</div>
			
					<div class="tab-content">
						<div class="tab-top-bar">
							<i class="align-left icon ion-android-add"></i>
							<i class="align-left icon ion-android-search"></i>
							<h1 class="title">More</h1>
							<i class="align-right icon ion-share"></i>
							<i class="align-right icon ion-gear-a"></i>
						</div>
						<ul>
							<li><img src="https://via.placeholder.com/50"> Subscribe <i class="icon ion-chevron-right"></i></li>
							<li><img src="https://via.placeholder.com/50"> About <i class="icon ion-chevron-right"></i></li>
							<li><img src="https://via.placeholder.com/50"> Privacy Policy <i class="icon ion-chevron-right"></i></li>
							<li><img src="https://via.placeholder.com/50"> Term &amp; Conditions <i class="icon ion-chevron-right"></i></li>
						</ul>
						<ul>
							<li><img src="https://via.placeholder.com/50"> List item <i class="icon ion-chevron-right"></i></li>
							<li><img src="https://via.placeholder.com/50"> List item <i class="icon ion-chevron-right"></i></li>
							<li><img src="https://via.placeholder.com/50"> List item <i class="icon ion-chevron-right"></i></li>
							<li><img src="https://via.placeholder.com/50"> List item <i class="icon ion-chevron-right"></i></li>
							<li><img src="https://via.placeholder.com/50"> List item <i class="icon ion-chevron-right"></i></li>
						</ul>
					</div>
				</div>
			</div>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
			<script src="assets/script.js"></script>
		</body>
	</html>