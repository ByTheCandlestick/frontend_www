<?php
	date_default_timezone_set('Europe/London');
	require_once('./Classes/funcs.php');
	require_once('./Classes/config.php');
	require_once('./Classes/vars.php');
	require_once('./Classes/endpoints.php');

	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type');
		header('Access-Control-Max-Age: 86400');
		header('Content-Length: 0');
		exit();
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$data = json_decode(file_get_contents("php://input"), true);
		$endpoint = strtok($_SERVER["REQUEST_URI"],'?');
		$result = call_user_func($endpoints[$endpoint], $data);
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		print(json_encode($result));
		exit();
	} else {
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: text/json');
		print(json_encode(array("error"=>"Invalid request method")));
		exit();
	}
?>