<?
	class OrdersController extends BaseController {
		/** "/Orders/Status" Endpoint
		 *	@final
		 *	@return JSON
		 */
		public function Status(array $image_vars) {
			// Vars
				$arr_orders_info = $this->getQueryStringParams();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$mdl_orders = new OrdersModel();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
				elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Unknosn
					exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
				elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Update status
					// Confirmations
						try {
							if(isset($arr_orders_info['status'])	&& $arr_orders_info['status'] !== "")	new Error("ERR-STA-1");
							if(isset($arr_orders_info['invoice'])	&& $arr_orders_info['invoice'] !== "")	new Error("ERR-STA-2");
						} catch (Error $er) {
							$this->throwError($er->getMessage(), "HTTP/1.1 404 Not Found", '', '', '');
						}
					// Validation
						try {
							// Nothing to validate
						} catch (Error $er) {
							$this->throwError($er->getMessage(), "HTTP/1.1 404 Not Found", '', '', '');
						}
					// Submit application
						try{
							if($mdl_orders->updateStatus($arr_orders_info['status'], $arr_orders_info['invoice'], $arr_orders_info['uid'])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-STA-3");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗷 --	Unknown
					exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
				else:
					exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
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