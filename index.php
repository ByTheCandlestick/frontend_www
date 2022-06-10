<?
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
    $theme = getThemepage();
	define('THEME_ROOT', realpath($_SERVER["DOCUMENT_ROOT"]));
	print_r(THEME_ROOT);
?>