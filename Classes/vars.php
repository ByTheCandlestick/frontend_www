<?
	if(str_contains($_SERVER["SERVER_NAME"], "indev")) {	#	THE WESBITE IN IN DEVELOPMENT MODE
		define('__API__',		'http://api.candlestick-indev.co.uk/v1');
		define('STRIPE_API',	['pk_test_51JKqfVFDFLz8LpozviM6GdhHOMvQJh75VMcH0CVomCXtA9gbTRR7tKRvfjLnWQuXEedTNvoD2O6Gj6hmhDRktH2I00hk6jMnBJ', 'sk_test_51JKqfVFDFLz8LpozmlliBbv92XkspmRyy2O7G6IMk2IccfP9ZnimCZ8rJHHCVfIGupLx5FJZafa92igVC2HFWPkz00umY4pOUm']);
		define('ADMIN',			['db5007323432.hosting-data.io',	'dbu3023777',	'CandleStick2603',	'dbs6033983']);
		define('ANALYTICS',		['db5007323454.hosting-data.io',	'dbu557431',	'CandleStick2603',	'dbs6034000']);
	} else {												#	THE WEBSITE IS LAUNCHED AND IS FULLY RELEASED
		define('__API__',		'https://api.thecandlestick.co.uk/v1');
		define('STRIPE_API',	['pk_live_51JKqfVFDFLz8LpozgswYwIgi1ACsHesIfWpbfyfLEzaKRNk2Meqgt6orqe3Sq6GU5BqVAjxJqvfda6hmK8Od3iVw00IUenuYaQ', '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']);
		define('ADMIN', 		['db5007320590.hosting-data.io',	'dbu1278426',	'CandleStick2603',	'dbs6031251']);
		define('ANALYTICS',		['db5007301242.hosting-data.io',	'dbu235049',	'CandleStick2603',	'dbs6015868']);
	}
	define('ROOT',			realpath($_SERVER["DOCUMENT_ROOT"]));
	define('QS_PAGE',		(isset($_GET['page'])) ? strtolower($_GET['page']) : 'index');
	define('QS_SUBPAGE',	(isset($_GET['subpage'])) ? strtolower($_GET['subpage']) : null);
	define('QS',			(isset($_GET['q'])) ? strtolower($_GET['q']) : null);
	// SET USERS IP
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	// CHECK IF THE USER IS LOGGED IN
		// SET THE VARIABLES
			$user_ok = false;
			$log_session = "";
			$cookies_exist = false;
			$session_exists = false;
		// CHECK IF THE COOKIES EXIST, SESSION EXISTS AND ARE VALID.
			if(isset($_COOKIE["session_code"])) {
				$log_session	= $_COOKIE['session_code'];
				$query = DB_Query("SELECT * FROM `Users_sessions` WHERE `Session_code`='$log_session' AND `Active`='1' LIMIT 1");
				$numrows = mysqli_num_rows($query);
				if($numrows > 0){
					$user_ok = true;
				} elseif(isset($_COOKIE["session_code"])) {
					setcookie("session_code",	'',	strtotime('-5 days'),	'/');
				} else {
					$user_ok = false;
				}
			}
		// EVALUATE WHETHER THE USER IS LOGGED IN
			if($user_ok) {
				// USERDATA
					$query = DB_Query("SELECT * FROM `Users_sessions` WHERE `Session_code`='$log_session' LIMIT 1");
					$log_id = mysqli_fetch_assoc($query)['UID'];
					$query = DB_Query("SELECT * FROM `Users` WHERE `ID`='$log_id' LIMIT 1");
					$userdata = mysqli_fetch_assoc($query);
				// NOTIFICATIONS
					$query = DB_Query("SELECT * FROM `Users_notifications` WHERE `UID`='$log_id' LIMIT 1");
					$notifications = mysqli_fetch_array($query);
				// NOTIFICATION COUNT
					$query = DB_Query("SELECT count(*) FROM `Users_notifications` WHERE `UID`='$log_id' LIMIT 1");
					$row = mysqli_fetch_array($query);
					$notifications['count'] = $row[0];
			//
		//
	}
	if($user_ok) {
		print_r($_SERVER);
		header('');
	}
?>