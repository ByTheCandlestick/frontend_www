<?php
//	confOrigin();
	$obj_OrdersController	= new OrdersController();
	if(isset($uri[2]) && $uri[2]!==""):
		$str_MethodName		= $uri[2];
		$str_MethodOptions	= array_splice($uri, 3);
	else:
		exit(invalid_request(4));
	endif;
	$obj_OrdersController		-> {$str_MethodName}($str_MethodOptions);
?>
