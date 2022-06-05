<?
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');

	// Determine the required row from the page requested
	if(QS_SUBPAGE != NULL) {
		$query = sprintf("SELECT * FROM `admin_pages`  WHERE `Page_url`='%s' AND `Sub-page_url`='%s' LIMIT 1", QS_PAGE, QS_SUBPAGE);
		try {
			if(mysqli_num_rows($layout_results = DB_Query($query)) == 0) {
				throw new Exception();
			}
		} catch (Exception $er) {
			$query = sprintf("SELECT * FROM `admin_pages`  WHERE `Page_url`='%s' LIMIT 1", QS_PAGE);
		}
	} else {
		$query = sprintf("SELECT * FROM `admin_pages`  WHERE `Page_url`='%s' LIMIT 1", QS_PAGE);
	}
	// get the page information
	if(QS_PAGE!=null && mysqli_num_rows($layout_results = DB_Query($query)) > 0) {
		while($layout_row = mysqli_fetch_array($layout_results)) {
			$info = array();
			$info_results = DB_Query("SELECT * FROM `shop_info`");
			while($info_row = mysqli_fetch_row($info_results)) {
				$info[$info_row[1]] = $info_row[2]; 
			}
?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta content="ie=edge" http-eqiv="X-UA-Compatible">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0-beta1/css/bootstrap.min.css" integrity="sha512-o/MhoRPVLExxZjCFVBsm17Pkztkzmh7Dp8k7/3JrtNCHh0AQ489kwpfA3dPSHzKDe8YCuEhxXq3Y71eb/o6amg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.css" integrity="sha512-V0+DPzYyLzIiMiWCg3nNdY+NyIiK9bED/T1xNBj08CaIUyK3sXRpB26OUCIzujMevxY9TRJFHQIxTwgzb0jVLg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link href="/Assets/css/style.css" rel="stylesheet" >

			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.js" integrity="sha512-9rxMbTkN9JcgG5euudGbdIbhFZ7KGyAuVomdQDI9qXfPply9BJh0iqA7E/moLCatH2JD4xBGHwV6ezBkCpnjRQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			<script src="/Assets/js/theme.js"></script>
		</head>
		<body>
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
					<div class="search-wrapper">
						<div class="search">
							<input type="text" onkeyup="search(event)" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
						</div>
						<div class="search-suggestions"> </div>
					</div>
					<!-- Profile, Notifications and Dark mode -->
					<div class="app-header-right">
						<button class="mode-switch" title="Switch Theme">
							<svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
								<path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
							</svg>
						</button>
						<button class="profile-btn">
							<img src="https://assets.codepen.io/3306515/IMG_2025.jpg" />
							<span><?print($userdata['First_name'].' '.$userdata['Last_name'])?></span>
						</button>
					</div>
				</div>
				<div class="app-content">
					<!-- Sidebar -->
					<div class="app-sidebar">
						<?
							$items = DB_Query("SELECT * FROM `admin_pages` WHERE `Active`=1 AND `Menu_item`=1 ORDER BY `menu_order` ASC");
							foreach($items as $item) {
								($item['Page_url'] == QS_PAGE)? $active = ' active' : $active = '';
								print(sprintf('
									<a href="%s" class="app-sidebar-link%s">
										<i class="fa fa-%s"></i>
									</a>
									',
									$item['URL'],
									$active,
									$item['Icon']
								));
							}
						?>
					</div>
					<!-- Page Content -->
					<? include('./Pages/'.$layout_row['Name'].'.php'); ?>
				</div>
			</div>
		</body>
	</html>
<?
		}
	}
?>