<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	// Set www. as subdomain if no subdomain exists
		if($website_info['Subdomain'] == null) {
			print_r($_SERVER['HTTP_HOST']);
			// header('Location: ' . URL_WWW);
		}
	//
	if(isset($_GET['file']) && isset($_GET['ext'])) {
		if(file_exists($path = sprintf("%s/Themes/%s/Assets/%s/%s.%s", __ROOT__, __THEME__, $_GET['ext'], $_GET['file'], $_GET['ext']))) {
			header('Content-Type: text/'.$_GET['ext']);
			print(file_get_contents($path));
		} else {
			header('Content-Type: text/json');
			print(json_encode(array("error"=>"File not found")));
		}
	} else {
		if($website_info['Maintenance']) {
			require_once('./Pages/maintenance.php');
		} else {
			if(getThemepage(false)) {
				getThemepage(true);
			} else {
				print('The website you are looking for does not exist');
			}
		}
	}
?>