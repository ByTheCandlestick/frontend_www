<?
	confApiKey();
	$obj_TasksController		= new TasksController();
	/**/if(isset($uri[2]) && $uri[2]!==""):
		$str_MethodName		= $uri[2];
		$str_MethodOptions	= array();
	endif;
	$obj_TasksController		-> {$str_MethodName}($str_MethodOptions);
?>