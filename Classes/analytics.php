<?
	if($user_ok && !$userdata['Disable_analytics'] || !$user_ok) {
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
			} else if($_SERVER['HTTP_REFERER']==URL_WWW || startsWith($_SERVER['HTTP_REFERER'], URL_WWW)) {
				$referrer = null;
			} else {
				$referrer = $_SERVER['HTTP_REFERER'];
			}
		// Upload the data
			if(!DB_Query("INSERT INTO `page_views`(`timestamp`, `uri`, `uri_full`, `country`, `city`, `ip`) VALUES('$timestamp', '$uri', '$uri_full', '$country', '$city', '$user_ip')", ANALYTICS)) {
				echo "<script>console.log('Unable to submit analytics -0')</script>";
			} else {
				if($q = DB_Query("SELECT * FROM `page_views` WHERE `timestamp`='$timestamp' LIMIT 1", ANALYTICS)) {
					$analytics_ID = mysqli_fetch_row($q)[0];
				}

				if(isset($referrer)) {
					if(!DB_Query("INSERT INTO `referrers`(`ID`, `timestamp`, `referrer`, `uri`) VALUES($analytics_ID,  '$timestamp', '$referrer', '$uri_full')", ANALYTICS)) {
						echo "<script>console.log('Unable to submit analytics -1')</script>";
					}
				}
			}
		// submit load time
			function loadTime($ID, $ts, $uri, $loadTime) {
				if(!DB_Query($q = "INSERT INTO `load_time` (`ID`, `timestamp`, `uri`, `time`) VALUES($ID, '$ts', '$uri', '$loadTime')", ANALYTICS)) {
					echo "<script>console.log('Unable to submit analytics -2')</script>";
				}
			}
		// submit session time
			function sessionTime($ID, $ts, $uri, $sessionTime) {
				if(!DB_Query("INSERT INTO `session_time` (`ID`, `timestamp`, `uri`, `time`) VALUES($ID, '$ts', '$uri', '$sessionTime')", ANALYTICS)) {
					echo "<script>console.log('Unable to submit analytics -3')</script>";
				}
			}
		//
	}
?>