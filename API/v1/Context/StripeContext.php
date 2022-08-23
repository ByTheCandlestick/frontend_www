<?php
	confApiKey();
	$obj_StripeController	= new StripeController();
	if(isset($uri[2]) && $uri[2]==""):
		$str_MethodName		= "SecurePayment";
		$str_MethodOptions	= array_splice($uri, 3);
	elseif(isset($uri[2]) && strtolower($uri[2])=="refund"):
		$str_MethodName		= "SecureRefund";
		$str_MethodOptions	= array_splice($uri, 3);
	else:
		exit(invalid_request(3));
	endif;
	$obj_StripeController		-> {$str_MethodName}($str_MethodOptions);
?>
