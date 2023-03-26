<?
	class SupplierController extends BaseController {
		/** "/Supplier/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function Supplier($arr) {
			// Vars
				$mdl_supplier = new SupplierModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_page_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗹 --	Creates a new page
					// Confirmations
						try{
							if(!isset($arr_page_info['reference']))	throw new Error("ERR-SUP-1");
							if(!isset($arr_page_info['name']))		throw new Error("ERR-SUP-2");
							if(!isset($arr_page_info['email']))		throw new Error("ERR-SUP-3");
							if(!isset($arr_page_info['phone']))		throw new Error("ERR-SUP-4");
							if(!isset($arr_page_info['hours']))		throw new Error("ERR-SUP-5");
							if(!isset($arr_page_info['active']))    throw new Error("ERR-SUP-6");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Validation
						try{
                            if(!$this->ValidateEmail($arr_page_info['email'])) throw new Error("ERR-SUP-7");
                            if(!$this->ValidatePhone($arr_page_info['phone'])) throw new Error("ERR-SUP-8");
						} catch(Error $er) {
							 
						}
					// Submit application
						try{
							if($mdl_supplier->CreateSupplier($arr_page_info, $arr_page_info['uid'])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-SUP-9");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗷 --	Unknown
					exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
				else:											// (U)nsupported-- 🗹 --	The method is unsupported
					exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
				endif;
			// Send output
				exit($this->sendOutput(
					$str_response,
					"HTTP/1.1 200 OK",
					array(
						"Content-Type: application/json"
					)
				));
			// End of function
		}
		/** "/Supplier/{ID}/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function SupplierByID($arr) {
			// Vars
                $mdl_supplier = new SupplierModel();
                $requestMethod = $_SERVER['REQUEST_METHOD'];
                $arr_page_info = $this->getQueryStringParams();
                $str_response = "";
            // Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Unknown
					exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Updates a page
					// Confirmations
						try{
							if(!isset($arr_page_info['reference']))	throw new Error("ERR-SUP-1");
							if(!isset($arr_page_info['name']))		throw new Error("ERR-SUP-2");
							if(!isset($arr_page_info['email']))		throw new Error("ERR-SUP-3");
							if(!isset($arr_page_info['phone']))		throw new Error("ERR-SUP-4");
							if(!isset($arr_page_info['hours']))		throw new Error("ERR-SUP-5");
							if(!isset($arr_page_info['active']))    throw new Error("ERR-SUP-6");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Validation
						try{
                            if(!$this->ValidateEmail($arr_page_info['email'])) throw new Error("ERR-SUP-7");
                            if(!$this->ValidatePhone($arr_page_info['phone'])) throw new Error("ERR-SUP-8");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Submit application
						try{
							if($mdl_supplier->UpdateSupplier($arr[0], $arr_page_info, $arr_page_info['uid'])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-SUP-9");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗹 --	Delete a page
					// Confirmations
						try{
							// Nothing to confirm.
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Validation
						try{
							// Nothing to validate.
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Submit application
						try{
							if($mdl_supplier->DeleteSupplier($arr[0], $arr_page_info['uid'])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-SUP-1");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				else:											// (U)nsupported-- 🗹 --	The method is unsupported
					exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
				endif;
			// Send output
				exit($this->sendOutput(
					$str_response,
					"HTTP/1.1 200 OK",
					array(
						"Content-Type: application/json"
					)
				));
			// End of function
		}
	}
?>