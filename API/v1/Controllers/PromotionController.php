<?php
	class PromotionController extends BaseController {
		/** "/Promotion/{uid}" Endpoint - Get list of Products
		 *	
		 *	@return JSON
		 */
		public function List() {
			// Vars
				$mdl_promotion = new PromotionModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_promotion_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Create a new promotion
					// Confirmations
						try{
							if(!isset($arr_promotion_info['name']) || $arr_promotion_info == "")		throw new Error("ERR-PRM-1");
							if(!isset($arr_promotion_info['percentage']) || $arr_promotion_info == "")	throw new Error("ERR-PRM-2");
							if(!isset($arr_promotion_info['start']) || $arr_promotion_info == "")		throw new Error("ERR-PRM-3");
							if(!isset($arr_promotion_info['end']) || $arr_promotion_info == "")			throw new Error("ERR-PRM-4");
							if(!isset($arr_promotion_info['voucher']) || $arr_promotion_info == "")		throw new Error("ERR-PRM-5");
							if(!isset($arr_promotion_info['active']) || $arr_promotion_info == "")		throw new Error("ERR-PRM-6");
							if(!isset($arr_promotion_info['type']) || $arr_promotion_info == "")		throw new Error("ERR-PRM-7");
							if(!isset($arr_promotion_info['description']) || $arr_promotion_info == "")	throw new Error("ERR-PRM-8");
							if(!isset($arr_promotion_info['categories']) || $arr_promotion_info == "")	throw new Error("ERR-PRM-9");
							if(!isset($arr_promotion_info['collections']) || $arr_promotion_info == "")	throw new Error("ERR-PRM-10");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
						}
					// Validation
						try{
							// Norhting to validate
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
						}
					// Submit application
						try{
							if($mdl_promotion->Create($arr_promotion_info['name'], $arr_promotion_info['percentage'], $arr_promotion_info['start'], $arr_promotion_info['end'], $arr_promotion_info['voucher'], $arr_promotion_info['active'], $arr_promotion_info['type'], $arr_promotion_info['description'], $arr_promotion_info['categories'], $arr_promotion_info['collections'])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-PRM-11");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Unsupported
					$this->throwError("TODO: List promotions", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- ☐ --	Unsupported
					// Confirmations
						try{
							if(!isset($arr_promotion_info['id']) || $arr_promotion_info['id'] == "")					throw new Error("ERR-PRM-1");
							if(!isset($arr_promotion_info['name']) || $arr_promotion_info['name'] == "")				throw new Error("ERR-PRM-2");
							if(!isset($arr_promotion_info['percentage']) || $arr_promotion_info['percentage'] == "")	throw new Error("ERR-PRM-3");
							if(!isset($arr_promotion_info['start']) || $arr_promotion_info['start'] == "")				throw new Error("ERR-PRM-4");
							if(!isset($arr_promotion_info['end']) || $arr_promotion_info['end'] == "")					throw new Error("ERR-PRM-5");
							if(!isset($arr_promotion_info['voucher']) || $arr_promotion_info['voucher'] == "")			throw new Error("ERR-PRM-6");
							if(!isset($arr_promotion_info['active']) || $arr_promotion_info['active'] == "")			throw new Error("ERR-PRM-7");
							if(!isset($arr_promotion_info['type']) || $arr_promotion_info['type'] == "")				throw new Error("ERR-PRM-8");
							if(!isset($arr_promotion_info['description']) || $arr_promotion_info['description'] == "")	throw new Error("ERR-PRM-9");
							if(!isset($arr_promotion_info['categories']) || $arr_promotion_info['categories'] == "")	throw new Error("ERR-PRM-10");
							if(!isset($arr_promotion_info['collections']) || $arr_promotion_info['collections'] == "")	throw new Error("ERR-PRM-11");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
						}
					// Validation
						try{
							// Norhting to validate
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
						}
					// Submit application
						try{
							if($mdl_promotion->Update($arr_promotion_info['id'], $arr_promotion_info['name'], $arr_promotion_info['percentage'], $arr_promotion_info['start'], $arr_promotion_info['end'], $arr_promotion_info['voucher'], $arr_promotion_info['active'], $arr_promotion_info['type'], $arr_promotion_info['description'], $arr_promotion_info['categories'], $arr_promotion_info['collections'])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-PRM-12");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
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