<?php
	confApiKey();
	$obj_ConfigController	= new ConfigController();
	if(isset($uri[2]) && $uri[2]=="permission"):
		$str_MethodName		= "Permission";
		$str_MethodOptions	= array_splice($uri, 3);
	else:
		exit(invalid_request(3));
	endif;
	$obj_ConfigController		-> {$str_MethodName}($str_MethodOptions);
?>
