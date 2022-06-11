<?
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
	if(isset($_GET['file']) && isset($_GET['ext'])) {
		echo $path = sprintf("%s/Themes/%s/%s/%s.%s", __ROOT__, __THEME__, $_GET['ext'], $_GET['file'], $_GET['ext'])
		if(file_exists($path)) {
			print(file_get_contents($path));
		} else {
			print(json_encode(array("error"=>"File not found")));
		}
	} else {
		if($website_info['Maintenance']) {

		} else {
			getThemepage(true);
		}
	}
?>