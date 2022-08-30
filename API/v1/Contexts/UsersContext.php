<?
	confApiKey();
	$obj_UserController		= new UsersController();
	/**/if(isset($uri[2]) && $uri[2]!=="" && strtolower($uri[2])=="session"):
		$str_MethodName		= "Session";
		$str_MethodOptions	= array_splice($uri, 3);
	elseif(isset($uri[2]) && $uri[2]!=="" && strtolower($uri[2])=="perms"):
		$str_MethodName		= "Permissions";
		$str_MethodOptions	= array_splice($uri, 3);
	elseif(isset($uri[2]) && $uri[2]!==""):
		$str_MethodName		= "GetUser";
		$str_MethodOptions	= array($uri[2], $uri[3]);
	else:
		$str_MethodName		= 'List';
		$str_MethodOptions	= array();
	endif;
	$obj_UserController		-> {$str_MethodName}($str_MethodOptions);
?>