<?
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	/*
	 *	if(!$user_ok) {}
	 */
?>
<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
								include('./Sections/'.$row['Name'].'.php');
							?>
						</section>
					</div>
				</div>
			</div>
		</body>
	</html>