<?
	if(str_contains($_SERVER["SERVER_NAME"], "indev")) {	#	THE WESBITE IN IN DEVELOPMENT MODE
		define('DOMAIN_TYPE',	'indev');
		define('STRIPE_API',	['pk_test_51JKqfVFDFLz8LpozviM6GdhHOMvQJh75VMcH0CVomCXtA9gbTRR7tKRvfjLnWQuXEedTNvoD2O6Gj6hmhDRktH2I00hk6jMnBJ', 'sk_test_51JKqfVFDFLz8LpozmlliBbv92XkspmRyy2O7G6IMk2IccfP9ZnimCZ8rJHHCVfIGupLx5FJZafa92igVC2HFWPkz00umY4pOUm']);
		define('ADMIN',			['db5007323432.hosting-data.io',	'dbu3023777',	'CandleStick2603',	'dbs6033983']);
		define('ANALYTICS',		['db5007323454.hosting-data.io',	'dbu557431',	'CandleStick2603',	'dbs6034000']);
	} else {												#	THE WEBSITE IS LAUNCHED AND IS FULLY RELEASED
		define('DOMAIN_TYPE',	'live');
		define('STRIPE_API',	['pk_live_51JKqfVFDFLz8LpozgswYwIgi1ACsHesIfWpbfyfLEzaKRNk2Meqgt6orqe3Sq6GU5BqVAjxJqvfda6hmK8Od3iVw00IUenuYaQ', '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']);
		define('ADMIN', 		['db5007320590.hosting-data.io',	'dbu1278426',	'CandleStick2603',	'dbs6031251']);
		define('ANALYTICS',		['db5007301242.hosting-data.io',	'dbu235049',	'CandleStick2603',	'dbs6015868']);
	}
	define('__ROOT__',		$_SERVER["DOCUMENT_ROOT"]);
	define('__THEME__',		getThemepage(false));
	define('QS_PAGE',		isset($_GET['page']) ? strtolower($_GET['page']) : 'index');
	define('QS_SUBPAGE',	isset($_GET['subpage']) ? strtolower($_GET['subpage']) : null);
	define('QS',			isset($_GET['q']) ? strtolower($_GET['q']) : null);
	define('__API__',		($_SERVER['HTTPS'] ? 'https://' : 'http://' ) . 'api.' . removeSubdomain($_SERVER['HTTP_HOST']).'/v1');
	define('URL_WWW',		($_SERVER['HTTPS'] ? 'https://' : 'http://' ) . 'www.' . removeSubdomain($_SERVER['HTTP_HOST']));
	define('URL_BLOG',		($_SERVER['HTTPS'] ? 'https://' : 'http://' ) . 'blog.' . removeSubdomain($_SERVER['HTTP_HOST']));
	define('URL_ADMIN',		($_SERVER['HTTPS'] ? 'https://' : 'http://' ) . 'admin.' . removeSubdomain($_SERVER['HTTP_HOST']));
	// SET USERS IP
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	// GET PAGE INFORMATION
		$website_info = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Websites` WHERE `Domain`='%s' LIMIT 1", $_SERVER['HTTP_HOST'])));
	// REDIRECT TO WWW. IF NO SUBDOMAIN EXISTS
		$x = array('uk'=>'co');		// exceptions of tld's with 2 parts
		$r = explode('.', $_SERVER['HTTP_HOST']);
		$t = array_pop($r);
		if(isset($x[$t]) && end($r)==$x[$t]) $website_info['TLD'] = array_pop($r) . '.' . $t; // add to tld for the exceptions
		$website_info['Domain'] = implode('.', $r);
		$website_info['Subdomain'] = explode('.', $website_info['Domain'])[0];
		print_r($website_info['Subdomain'] . ' / ' . $website_info['Domain'] . ' / ' . $website_info['TLD']);
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
			}
?>