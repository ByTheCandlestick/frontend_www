<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	print($_GET);
	if(isset($_GET['file']) && isset($_GET['ext'])) {
		if(file_exists($path = 'Themes/'.__THEME__.'/Assets/'.$_GET['ext'].'/'.$_GET['file'].'.'.$_GET['ext'])) {
			print(file_get_contents($path));
		}
	} else {
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>