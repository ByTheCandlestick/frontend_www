<?php
	confApiKey();
	$obj_ProductController	= new ProductController();
	if(isset($uri[2]) && strtolower($uri[2])=="container"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "ContainerByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Container";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && strtolower($uri[2])=="wick"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "WickByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Wick";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && strtolower($uri[2])=="wickstand"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "WickStandByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "WickStand";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && strtolower($uri[2])=="material"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "MaterialByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Material";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && strtolower($uri[2])=="fragrance"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "FragranceByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Fragrance";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && strtolower($uri[2])=="colour"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "ColourByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Colour";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && strtolower($uri[2])=="packaging"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "PackagingByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Packaging";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && strtolower($uri[2])=="shipping"):
		if(isset($uri[3]) && $uri[3]!==""):
			$str_MethodName		= "ShippingByID";
			$str_MethodOptions	= array_splice($uri, 3);
		else:
			$str_MethodName		= "Shipping";
			$str_MethodOptions	= array_splice($uri, 3);
		endif;
	elseif(isset($uri[2]) && $uri[2]!==""):
		$str_MethodName		= "ProductByID";
		$str_MethodOptions	= $uri[2];
	else:
		$str_MethodName		= "Product";
		$str_MethodOptions	= array_splice($uri, 3);
	endif;
	$obj_ProductController		-> {$str_MethodName}($str_MethodOptions);
?>
