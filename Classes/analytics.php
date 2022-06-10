<?
	if($user_ok && !$userdata['Disable_analytics'] || !$user_ok) {
		$analytics_startTime = microtime(true);
		$user_ip = getenv('REMOTE_ADDR');
		$ts = time();
		// Get the users location
			$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
			$country = $geo["geoplugin_countryName"];
			$city = $geo["geoplugin_city"];
		// Get the URI
			(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')?$protocol = "https://":$protocol = "http://";
			$uri_full = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$uri = $_SERVER['REQUEST_URI'];
		// Get referrer
			if(!isset($_SERVER['HTTP_REFERER'])) {
				$referrer = 'New tab';
			} else if($_SERVER['HTTP_REFERER']=='https://thecandlestick.co.uk/' || startsWith($_SERVER['HTTP_REFERER'], 'https://thecandlestick.co.uk/')) {
				$referrer = null;
			} else {
				$referrer = $_SERVER['HTTP_REFERER'];
			}
		// Upload the data
			if(!DB_Query("INSERT INTO `page_views`(`timestamp`, `uri`, `uri_full`, `country`, `city`, `ip`) VALUES($timestamp, '$uri', '$uri_full', '$country', '$city', '$user_ip')", ANALYTICS)) {
				echo "<script>console.log('Unable to submit analytics -0')</script>";
			}
			if(DB_Query($q = "SELECT * FROM `page_views` WHERE `timestamp`='$timestamp'", ANALYTICS)) {
				$analytics_ID = mysqli_fetch_assoc($q)[0];
			}

			if(isset($referrer)) {
				if(!DB_Query("INSERT INTO `referrers`(`ID`, `timestamp`, `referrer`, `uri`) VALUES($analytics_ID,  $timestamp, '$referrer', '$uri_full')", ANALYTICS)) {
					echo "<script>console.log('Unable to submit analytics -1')</script>";
				}
			}
		// submit load time
			function loadTime($loadTime) {
				if(!DB_Query("INSERT INTO `load_time`(`ID`, `timestamp`, `uri`, `time`) VALUES($analytics_ID, $timestamp, '$uri_full', '$loadTime')", ANALYTICS)) {
					echo "<script>console.log('Unable to submit analytics -2')</script>";
				}
			}
		// submit session time
			function sessionTime($sessionTime) {
				if(!DB_Query("INSERT INTO `session_time`(ID`, `timestamp`, `uri`, `time`) VALUES($analytics_ID, $timestamp, '$uri_full', '$sessionTime')", ANALYTICS)) {
					echo "<script>console.log('Unable to submit analytics -3')</script>";
				}
			}
		//
	}
?>