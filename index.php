<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	print_r(json_encode($_SERVER));
	if($_SERVER['SCRIPT_URL']=="/manifest.json") {
		if(file_exists($path = sprintf("/Themes/%s/App/manifest.json", __THEME__))) {
			print(file_get_contents($path));
		}
	} else {
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>