<?php
	class MailController extends BaseController {
		/** "/Mail/Send/" Endpoint
		 *	
		 *	@return JSON
		 */
		public function Send() {
			// Vars
				$arr_mail_info = $this->getQueryStringParams();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Unsupported
					// Confirmations
						try{
							if(!isset($arr_mail_info['f']) || $arr_mail_info['f'] == "")	throw new Error("ERR-MAL-1");
							if(!isset($arr_mail_info['t']) || $arr_mail_info['t'] == "")	throw new Error("ERR-MAL-2");
							if(!isset($arr_mail_info['c']))									throw new Error("ERR-MAL-3");
							if(!isset($arr_mail_info['b']))									throw new Error("ERR-MAL-4");
							if(!isset($arr_mail_info['s']) || $arr_mail_info['s'] == "")	throw new Error("ERR-MAL-5");
							if(!isset($arr_mail_info['m']) || $arr_mail_info['m'] == "")	throw new Error("ERR-MAL-6");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
						}
					// Validation
						try{
                            if(!$this->ValidateEmail($arr_mail_info['t'])) throw new Error("ERR-MAL-7");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
						}
					// Submit application
						try{
							$mdl_Mail = new MailModel();
							$status = $mdl_Mail->Send($arr_mail_info['f'], $arr_mail_info['t'], $arr_mail_info['c'], $arr_mail_info['b'], $arr_mail_info['s'], $arr_mail_info['m']);
							if($status) {	// Success
								$str_response = json_encode($status);
							} else {		// Error submitting
								throw new Error("ERR-MAL-5");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Unsupported
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unsupported
					$this->throwError("TODO: Update user's mail", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗷 --	Unsupported
					$this->throwError("TODO: Remove from users mail", "HTTP/1.1 404 Not Found");
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
		/** "/Mail/Archive/" Endpoint
		 *	
		 *	@return JSON
		 */
		public function Archive() {
			// Vars
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_prod_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Unsupported
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Unsupported
					$this->throwError("TODO: List users mail", "HTTP/1.1 404 Not Found");
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