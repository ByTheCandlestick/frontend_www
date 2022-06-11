<?
	// SET USERS IP
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	// GET PAGE INFORMATION
		$website_info = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `misc_websites` WHERE `Domain`='%s' LIMIT 1", $_SERVER['HTTP_HOST'])));
	// CHECK IF THE USER IS LOGGED IN
		// SET THE VARIABLES
			$user_ok = false;
			$log_session = "";
			$cookies_exist = false;
			$session_exists = false;
		// CHECK IF THE COOKIES EXIST, SESSION EXISTS AND ARE VALID.
			if(isset($_COOKIE["session_code"])) {
				$log_session	= $_COOKIE['session_code'];
				$log_id = mysqli_fetch_assoc($query = DB_Query("SELECT * FROM `Users_sessions` WHERE `Session_code`='$log_session' AND `Active`='1' LIMIT 1"))['UID'];
				$numrows = mysqli_num_rows($query);
				if($numrows > 0){
					$user_ok = true;
				} elseif(isset($_COOKIE["session_code"])) {
					setcookie("session_code", '', strtotime('-5 days'), '/');
				}
			}
		// GET USERS DATA AND NOTIFICATIONS
			if($user_ok) {
				// USERDATA
					$userdata = mysqli_fetch_assoc(DB_Query("SELECT * FROM `Users` WHERE `ID`='$log_id' LIMIT 1"));
				// NOTIFICATIONS
					$notifications = mysqli_fetch_array(DB_Query("SELECT * FROM `Users_notifications` WHERE `UID`='$log_id' LIMIT 1"));
					$notifications['count'] = mysqli_fetch_array(DB_Query("SELECT count(*) FROM `Users_notifications` WHERE `UID`='$log_id' LIMIT 1"))[0];
			//
		//
	}
?>