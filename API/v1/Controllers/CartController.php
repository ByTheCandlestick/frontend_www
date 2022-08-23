<?php
	class CartController extends BaseController {
		/** "/Cart/" Endpoint - Get list of Products
		 *	
		 *	@return JSON
		 */
		public function Cart() {
			// Vars
				$arr_cart_info = $this->getQueryStringParams();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$str_response = "";
				$uid = intval($arr_cart_info['uid']); $sku = intval($arr_cart_info['sku']);
				$qty = intval($arr_cart_info['qty']); $opt = $arr_cart_info['opt'];
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Unsupported
					// Confirmations
						try{
							if(!isset($arr_cart_info['uid']) || $arr_cart_info['uid'] == "")	throw new Error("ERR-CRT-1");
							if(!isset($arr_cart_info['sku']) || $arr_cart_info['sku'] == "")	throw new Error("ERR-CRT-2");
							if(!isset($arr_cart_info['qty']) || $arr_cart_info['qty'] == "")	throw new Error("ERR-CRT-3");
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
					$this->throwError("TODO: Update user's cart", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗷 --	Unsupported
					$this->throwError("TODO: Remove from users cart", "HTTP/1.1 404 Not Found");
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
		/** "/Cart/{uid}" Endpoint - Get list of Products
		 *	
		 *	@return JSON
		 */
		public function List() {
			// Vars
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_prod_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Unsupported
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Unsupported
					$this->throwError("TODO: List users cart", "HTTP/1.1 404 Not Found");
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