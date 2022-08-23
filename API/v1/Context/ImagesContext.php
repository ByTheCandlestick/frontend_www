<?php
//	confOrigin();
	$obj_ImagesController	= new ImagesController();
	if(isset($uri[2]) && $uri[2]!==""):
		$str_MethodName		= $uri[2];
		$str_MethodOptions	= array_splice($uri, 3);
	else:
		exit(invalid_request(3));
	endif;
	$obj_ImagesController		-> {$str_MethodName}($str_MethodOptions);
?>
