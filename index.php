<?
	date_default_timezone_set('Europe/London');
	$fileRequested = $_SERVER['SCRIPT_NAME'];
	//
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	if($fileRequested == "/manifest.json") {

	} else {
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>