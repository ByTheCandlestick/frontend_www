<?
	header('HTTP/1.1 200 OK');
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	print($_GET['file']);
	if($_GET['file'] == "/manifest.json") {
		if(file_exists($path = 'Themes/'.__THEME__.'/Assets/json/manifest.json')) {
			print(file_get_contents($path));
		}
	} else {
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>