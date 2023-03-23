<?php
	date_default_timezone_set('Europe/London');
	require_once('./funcs.php');
	require_once('./config.php');
	require_once('./endpoints.php');

	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type');
		header('Access-Control-Max-Age: 86400');
		header('Content-Length: 0');
		exit();
	}
	$endpoint = preg_replace('/\/v[0-9](\/.*)/', '$2 $1', strtok($_SERVER["REQUEST_URI"], '?'));
	$controller = explode('/', $endpoint)[1];
	if($endpoint !== '/') {
		if($_SERVER['REQUEST_METHOD'] == 'PUT') {
			$data = file_get_contents("php://input");
		   require_once("./endpoints/".$controller.".php");
		   $result = call_user_func($endpoints["C:$controller"], $data);
		   exit();
	   } else if($_SERVER['REQUEST_METHOD'] == 'GET') {
		   $data = $_GET;
		   require_once("./endpoints/".$controller.".php");
		   $result = call_user_func($endpoints["R:$controller"], $data);
		   exit();
	   } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
		   $data = json_decode(file_get_contents("php://input"), true);
		   require_once("./endpoints/".$controller.".php");
		   $result = call_user_func($endpoints["U:$controller"], $data);	
		   exit();
	   } else if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		   require_once("./endpoints/".$controller.".php");
		   $result = call_user_func($endpoints["D:$controller"]);
		   exit();
	   } else {
		   $result = array(
			   json_encode(array( "error"=>"Invalid request method")),
			   'Access-Control-Allow-Origin: *',
			   'Content-Type: text/json',
		   );
		   exit();
	   }
	}
	print_r(implode('; ', array_slice($result, 1)));
?>