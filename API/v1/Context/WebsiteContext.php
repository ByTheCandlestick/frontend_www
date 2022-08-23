<?php
	/** Website API
	 * @final
	 */
	confApiKey();
	$obj_WebsiteController	= new WebsiteController();
	if(isset($uri[2]) && strtolower($uri[2])=="script"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "ScriptByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Script";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && strtolower($uri[2]) =="style"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "StyleByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Style";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && strtolower($uri[2]) =="theme"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "ThemeByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Theme";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && $uri[2]!==""):
		$str_MethodName		= "WebsiteByID";
		$str_MethodOptions	= array_splice($uri, 2);
	else:
		$str_MethodName		= "Website";
		$str_MethodOptions	= array_splice($uri, 2);
	endif;
	$obj_WebsiteController		-> {$str_MethodName}($str_MethodOptions);
?>
