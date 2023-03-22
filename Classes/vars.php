<?
	
	$keys = [];
	$query = DB_Query("SELECT `ID`, `Key` FROM `API Keys` WHERE `Active?`=1 AND `Created`<now()");
	while($key = mysqli_fetch_array($query)) { $keys[$key['ID']] = $key['Key']; }
	define('__API_KEYS__',	$keys);
	define('__ROOT__',		$_SERVER["DOCUMENT_ROOT"]);
	define('__THEME__',		getThemepage(false));
	define('QS_PAGE',		isset($_GET['page']) ? strtolower($_GET['page']) : 'index');
	define('QS_SUBPAGE',	isset($_GET['subpage']) ? strtolower($_GET['subpage']) : null);
	define('QS',			isset($_GET['q']) ? (strpos($_GET['q'], '/') ? explode('/', strtolower($_GET['q'])) : strtolower($_GET['q'])) : null);
	define('__API__',		($_SERVER['HTTPS'] ? 'https://' : 'http://' ) . 'api.' . removeSubdomain($_SERVER['HTTP_HOST']).'/v1');
	define('URL_WWW',		($_SERVER['HTTPS'] ? 'https://' : 'http://' ) . 'www.' . removeSubdomain($_SERVER['HTTP_HOST']));
	define('URL_BLOG',		($_SERVER['HTTPS'] ? 'https://' : 'http://' ) . 'blog.' . removeSubdomain($_SERVER['HTTP_HOST']));
	define('URL_ADMIN',		($_SERVER['HTTPS'] ? 'https://' : 'http://' ) . 'admin.' . removeSubdomain($_SERVER['HTTP_HOST']));
	define('URL_CURR',		($_SERVER['HTTPS'] ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST']);
	// SET USERS IP
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	// GET PAGE INFORMATION
		$website_info = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Website domains` WHERE `Domain`='%s' LIMIT 1", $_SERVER['HTTP_HOST'])));
	// REDIRECT TO WWW. IF NO SUBDOMAIN EXISTS
		$x = array('uk'=>'co');		// exceptions of tld's with 2 parts
		$r = explode('.', $_SERVER['HTTP_HOST']);
		$t = array_pop($r);
		if(isset($x[$t]) && end($r)==$x[$t]) $website_info['TLD'] = array_pop($r) . '.' . $t; // add to tld for the exceptions
		$website_info['Domain'] = implode('.', $r);
		$website_info['Subdomain'] = explode('.', $website_info['Domain']);
		($website_info['Subdomain'] == $website_info['Domain'])? $website_info['Subdomain'] = null : $website_info['Domain'] = array_pop($website_info['Subdomain']);
		$website_info['Subdomain'] = reset($website_info['Subdomain']);
	// CHECK IF THE USER IS LOGGED IN
		// SET THE VARIABLES
			$user_ok = false;
			$log_session = "";
			$cookies_exist = false;
			$session_exists = false;
		// CHECK IF THE COOKIES EXIST, SESSION EXISTS AND ARE VALID.
			if(isset($_COOKIE["session_code"])) {
				$log_session	= $_COOKIE['session_code'];
				$log_id = mysqli_fetch_assoc($query = DB_Query("SELECT * FROM `User sessions` WHERE `Session_code`='$log_session' AND `Active`='1' LIMIT 1"))['UID'];
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
					$userdata = mysqli_fetch_assoc(DB_Query("SELECT * FROM `User accounts` WHERE `ID`='$log_id' LIMIT 1"));
					$userperm = mysqli_fetch_assoc(DB_Query("SELECT * FROM `User permissions` WHERE `UID`='$log_id' LIMIT 1"));
				// NOTIFICATIONS
					$notifications = mysqli_fetch_array(DB_Query("SELECT * FROM `User notifications` WHERE `UID`='$log_id' LIMIT 1"));
					$notifications['count'] = mysqli_fetch_array(DB_Query("SELECT count(*) FROM `User notifications` WHERE `UID`='$log_id' LIMIT 1"))[0];
				// GET SERVER CONFIGURATION
					$oauths = [];
					$query = DB_Query("SELECT * FROM `User oauths` WHERE `UID`=".$userdata['ID']);
					$oauths = mysqli_fetch_assoc($query);
				//
			}
		// GET ALL USERS
			$users = [];
			$query = DB_Query("SELECT * FROM `User accounts` WHERE `Active`='1'");
			while($u = mysqli_fetch_assoc($query)) { $users[$u['ID']] = $u; }
		// GET SERVER CONFIGURATION
			$users = [];
			$query = DB_Query("SELECT * FROM `Config`");
			while($c = mysqli_fetch_assoc($query)) { $config[$c['Key']] = $c['Value']; }
		// 
			unset($query, $c, $u, $numrows);
?>