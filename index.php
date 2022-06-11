<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');

	if($_SERVER['REQUEST_URI'] == "/manifest.json") {
		if(file_exists($path = sprintf(__ROOT__."/Themes/%s/App/manifest.json", __THEME__))) {
			print(file_get_contents($path));
		} else {
			print(json_encode(array("error"=>"File not found")));
		}
	} else {
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>