<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');

	if(isset($_SERVER['SCRIPT_URL'])) {
		if(file_exists($path = sprintf("/Themes/%s/Assets/", __THEME__, ))) {
			print(file_get_contents($path));
		}
	} else {
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>