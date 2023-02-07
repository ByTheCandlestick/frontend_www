<?php
	confApiKey();
	$obj_AnalyticsController	= new AnalyticsController();
	if(isset($uri[2]) && $uri[2]==""):
		$str_MethodName		= "";
		$str_MethodOptions	= array_splice($uri, 3);
	else:
		exit(invalid_request(3));
	endif;
	$obj_AnalyticsController		-> {$str_MethodName}($str_MethodOptions);
?>
