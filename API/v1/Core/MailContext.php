<?php
	confApiKey();
	$obj_MailController	= new MailController();
	if(isset($uri[2]) && strtolower($uri[2])=="send"):
		$str_MethodName		= "Send";
		$str_MethodOptions	= array_splice($uri, 3);
	elseif(isset($uri[2]) && strtolower($uri[2])=="archive"):
		$str_MethodName		= "Archive";
		$str_MethodOptions	= array_splice($uri, 3);
	else:
		exit(invalid_request(3));
	endif;
	$obj_MailController		-> {$str_MethodName}($str_MethodOptions);
?>
