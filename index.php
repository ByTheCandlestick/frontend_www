<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	// Set www. as subdomain if no subdomain exists
		if($website_info['Subdomain'] == null) {
			header('Location: '.($_SERVER['HTTPS']?'https://www.':'http://www.').$_SERVER['HTTP_HOST'].'/');
		}
	// Display file if get[file] and get[ext] is set, else display theme index file for the eheme
		if(isset($_GET['file']) && isset($_GET['ext'])) {
			if(file_exists($path = sprintf("%s/CDN/%s/%s.%s", __ROOT__, $_GET['ext'], str_replace("_", "/", $_GET['file']), $_GET['ext']))) {
				if($_GET['ext'] == "php") {
					include_once($path);
				} else {
					header('Content-Type: text/'.$_GET['ext']);
					print(file_get_contents($path));
				}
			} else {
				header('Content-Type: text/json');
				print(json_encode(array("error"=>"File not found",
										"Location" => $path)));
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
	//
?>