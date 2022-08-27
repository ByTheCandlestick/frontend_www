<?php
	class ConfigController extends BaseController {
		/** "/Config/" Endpoint
		 *	
		 *	@return JSON
		 */
            public function Permission() {
                // Vars
                    $requestMethod = $_SERVER['REQUEST_METHOD'];
                    $arr_prod_info = $this->getQueryStringParams();
                    $str_response = "";
                // Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
                    /**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Creates a new permission level
					// Confirmations
						try{
							if(!isset($arr_cart_info['oldName']) || $arr_cart_info['uid'] == "")	throw new Error("ERR-CRT-1");
							if(!isset($arr_cart_info['newName']) || $arr_cart_info['sku'] == "")	throw new Error("ERR-CRT-2");
							if(!isset($arr_cart_info['default']) || $arr_cart_info['qty'] == "")	throw new Error("ERR-CRT-3");
							if(!isset($arr_cart_info['opt']) || $arr_cart_info['opt'] == "")	throw new Error("ERR-CRT-4");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
						}
					// Validation
						try{
							// Nothing to validate.
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
						}
					// Submit application
						try{
							$mdl_Cart = new CartModel();
							$status = $mdl_Cart->add($uid, $sku, $qty, $opt);
							if($status) {	// Success
								$str_response = json_encode($status);
							} else {		// Error submitting
								throw new Error("ERR-CRT-5");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
                    elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Unsupported
                        $this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
                    elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unsupported
                        $this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
                    elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗷 --	Unsupported
                        $this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
                    else:
                        $this->throwError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
                    endif;
                // Send output
                    $this->sendOutput(
                        $str_response,
                        array("Content-Type: application/json", "HTTP/1.1 200 OK")
                    );
                // End of function
            }
	}
?>