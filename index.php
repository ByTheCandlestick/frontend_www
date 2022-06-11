<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');

	print_r($_SERVER);

	if(isset($_SERVER['SCRIPT_URL']))) {
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