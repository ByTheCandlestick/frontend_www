<?php
	confApiKey();
	$obj_CartController	= new CartController();
	if(isset($uri[2]) && $uri[2]==""):
		$str_MethodName		= "Cart";
		$str_MethodOptions	= array_splice($uri, 3);
	elseif(isset($uri[2]) && $uri[2]!==""):
		$str_MethodName		= "List";
		$str_MethodOptions	= array_splice($uri, 3);
	else:
		exit(invalid_request(3));
	endif;
	$obj_CartController		-> {$str_MethodName}($str_MethodOptions);
?>
