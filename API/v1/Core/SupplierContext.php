<?php
	/** Supplier API
	 * @final
	 */
	confApiKey();
	$obj_SupplierController	= new SupplierController();
	if(isset($uri[2]) && $uri[2]!==""):
		$str_MethodName		= "SupplierByID";
		$str_MethodOptions	= array_splice($uri, 2);
	else:
		$str_MethodName		= "Supplier";
		$str_MethodOptions	= array_splice($uri, 2);
	endif;
	$obj_SupplierController		-> {$str_MethodName}($str_MethodOptions);
?>
