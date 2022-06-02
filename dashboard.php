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
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0-beta1/css/bootstrap.min.css" integrity="sha512-o/MhoRPVLExxZjCFVBsm17Pkztkzmh7Dp8k7/3JrtNCHh0AQ489kwpfA3dPSHzKDe8YCuEhxXq3Y71eb/o6amg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link href="/Assets/css/style.css" rel="stylesheet" >
			<script src="/Assets/js/theme.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
		</head>
		<body>
			<div class="app-container">
				<div class="app-header">
					<div class="app-header-left">
						<span class="app-icon"></span>
						<p class="app-name">The Candlestick</p>
						<div class="search-wrapper">
							<input class="search-input" type="text" placeholder="Search">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-search" viewBox="0 0 24 24">
									<circle cx="11" cy="11" r="8"></circle>
									<path d="M21 21l-4.35-4.35"></path>
								</svg>
							</div>
						</div>
						<div class="app-header-right">
							<button class="mode-switch" title="Switch Theme">
								<svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
									<path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
								</svg>
							</button>
							<button class="add-btn" title="Add New Project">
								<svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
									<line x1="12" y1="5" x2="12" y2="19" />
									<line x1="5" y1="12" x2="19" y2="12" />
								</svg>
							</button>
							<button class="notification-btn">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
									<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
									<path d="M13.73 21a2 2 0 0 1-3.46 0" />
								</svg>
							</button>
							<button class="profile-btn">
								<img src="https://assets.codepen.io/3306515/IMG_2025.jpg" />
								<span>Aybüke C.</span>
							</button>
						</div>
					</div>
					<div class="app-content">
						<div class="app-sidebar">
							<?
								$items = DB_Query("SELECT * FROM `admin_pages` WHERE `Active`=1");
								foreach($items as $item) {
									print(sprintf('
										<a href="%s" class="app-sidebar-link">
											<i class="fa fa-%s"></i>
										</a>
										',
										$item['URL'],
										$item['Icon']
									));
								}
							?>
						</div>
						<section>
							<?
								include('./Pages/'.$layout_row['Name'].'.php');
							?>
						</section>
					</div>
				</div>
			</div>
		</body>
	</html>
<?
		}
	}
?>