<?php
	confApiKey();
	$obj_PartnerController	= new PartnerController();
	if(isset($uri[2]) && $uri[2]==""):
		$str_MethodName		= "List";
		$str_MethodOptions	= array_splice($uri, 3);
	else:
		exit(invalid_request(4));
	endif;
	$obj_PartnerController		-> {$str_MethodName}($str_MethodOptions);
?>
