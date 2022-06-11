<?
	date_default_timezone_set('Europe/London');
	//
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	if(true) {
		print_r($_SERVER);
	}
	if($website_info['Maintenance']) {

	} else {
		getThemepage(true);
	}
?>