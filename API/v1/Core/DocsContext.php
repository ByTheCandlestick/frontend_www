<?php
	confApiKey();
	$obj_DocsController	= new DocsController();
	if(isset($uri[2]) && $uri[2]=="Invoice"):
		$str_MethodName		= $uri[2];
		$str_MethodOptions	= array_splice($uri, 3);
	else:
		exit(invalid_request(4));
	endif;
	$obj_DocsController		-> {$str_MethodName}($str_MethodOptions);
?>
