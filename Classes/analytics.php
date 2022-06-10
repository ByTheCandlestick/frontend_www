<?
//	if($user_ok && !$userdata['Disable_analytics'] || !$user_ok) {
	if($user_ok || !$user_ok) {
		$analytics_startTime = microtime(true);
		$user_ip = getenv('REMOTE_ADDR');
		$timestamp = date('Y-m-d H:i:s');
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
			if(!DB_Query("INSERT INTO `page_views`(`timestamp`, `uri`, `uri_full`, `country`, `city`, `ip`) VALUES('$timestamp', '$uri', '$uri_full', '$country', '$city', '$user_ip')", ANALYTICS)) {
				echo "<script>console.log('Unable to submit analytics -0')</script>";
			}
			if($q = DB_Query("SELECT * FROM `page_views` WHERE `timestamp`='$timestamp' LIMIT 1", ANALYTICS)) {
				print_r($analytics_ID = mysqli_fetch_row($q)[0]);
			}

			if(isset($referrer)) {
				if(!DB_Query("INSERT INTO `referrers`(`ID`, `timestamp`, `referrer`, `uri`) VALUES($analytics_ID,  '$timestamp', '$referrer', '$uri_full')", ANALYTICS)) {
					echo "<script>console.log('Unable to submit analytics -1')</script>";
				}
			}
		// submit load time
			function loadTime($loadTime) {
				global $analytics_ID, $timestamp, $uri_full;
				if(!DB_Query($q = "INSERT INTO `load_time` (`ID`, `timestamp`, `uri`, `time`) VALUES($analytics_ID, '$timestamp', '$uri_full', '$loadTime')", ANALYTICS)) {
					echo "<script>console.log('Unable to submit analytics -2')</script>";
				}
				print_r($q);
			}
		// submit session time
			function sessionTime($sessionTime) {
				global $analytics_ID, $timestamp, $uri_full;
				if(!DB_Query("INSERT INTO `session_time` (`ID`, `timestamp`, `uri`, `time`) VALUES($analytics_ID, '$timestamp', '$uri_full', '$sessionTime')", ANALYTICS)) {
					echo "<script>console.log('Unable to submit analytics -3')</script>";
				}
			}
		//
	}
?>