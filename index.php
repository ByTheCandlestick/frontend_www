<?
	date_default_timezone_set('Europe/London');
	//
	require_once('./Classes/vars.php');
	//
	print_r(QS_PAGE);
	if(QS_PAGE == "/manifest.json") {

	} else {
		require_once('./Classes/funcs.php');
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>