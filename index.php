<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	if(isset($_GET['file']) && isset($_GET['ext'])) {
		if(file_exists($path = sprintf("%s/Themes/%s/Assets/%s/%s.%s", __ROOT__, __THEME__, $_GET['ext'], $_GET['file'], $_GET['ext']))) {
			print(file_get_contents($path));
		} else {
			print(json_encode(array("error"=>"File not found")));
		}
	} else {
		if($website_info['Maintenance']) {

		} else {
			if(getThemepage(false)) {
				getThemepage(true);
			} else {
				print('The website you are looking for does not exist')
			}
		}
	}
?>