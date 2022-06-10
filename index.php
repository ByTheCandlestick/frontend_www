<?
	require_once('./Classes/funcs.php');
	require_once('./Classes/vars.php');
    $theme = getThemepage();
	define('THEME_ROOT', $_SERVER["DOCUMENT_ROOT"]."/Themes/".$theme."/");
?>