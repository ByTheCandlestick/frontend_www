<?
	date_default_timezone_set('Europe/London');
	//
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	//
	print_r(QS);
	if(QS == "/manifest.json") {

	} else {
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>