<?
	date_default_timezone_set('Europe/London');
	print_r($_SERVER['SCRIPT_NAME']);
	if($_SERVER['SCRIPT_NAME'] == "/manifest.json") {

	} else {
		require_once('./Classes/funcs.php');
		require_once('./Classes/vars.php');
		//
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>