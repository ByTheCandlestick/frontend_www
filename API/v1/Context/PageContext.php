<?php
	/** Page API
	 * @final
	 */
	confApiKey();
	$obj_PageController	= new PageController();
	if(isset($uri[2]) && strtolower($uri[2])=="layout"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "LayoutByPageID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$obj_PageController->throwError("Unknown function", "HTTP/1.1 404 Not Found");
		endif;
	elseif(isset($uri[2]) && $uri[2]!==""):
		$str_MethodName		= "PageByID";
		$str_MethodOptions	= array_splice($uri, 2);
	else:
		$str_MethodName		= "Page";
		$str_MethodOptions	= array_splice($uri, 2);
	endif;
	$obj_PageController		-> {$str_MethodName}($str_MethodOptions);
?>
