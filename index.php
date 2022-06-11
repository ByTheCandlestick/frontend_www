<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');

	if($_SERVER['REQUEST_URI'] == "/manifest.json") {
		print(file_get_contents('Themes/'.__THEME__.'/Assets/json/manifest.json'));
	} else {
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>