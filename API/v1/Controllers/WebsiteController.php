<?php
	class WebsiteController extends BaseController {
		/** "/Website/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function Website($arr) {
			// Vars
				$mdl_website = new WebsiteModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_website_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Creates a new website
					// Confirmations
						try{
							if(!isset($arr_website_info['name']))			throw new Error("ERR-WEB-1");
							if(!isset($arr_website_info['domain']))			throw new Error("ERR-WEB-2");
							if(!isset($arr_website_info['page_type']))		throw new Error("ERR-WEB-3");
							if(!isset($arr_website_info['maintenance']))	throw new Error("ERR-WEB-4");
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
							if($mdl_website->CreateWebsite($arr_website_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-WEB-5");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Website/{ID}/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function WebsiteByID($arr) {
			// Vars
				$mdl_website = new WebsiteModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_website_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Updates websites
					// Confirmations
						try{
							if(!isset($arr_website_info['domain']))				throw new Error("ERR-WEB-1");
							if(!isset($arr_website_info['name']))				throw new Error("ERR-WEB-2");
							if(!isset($arr_website_info['page_type']))			throw new Error("ERR-WEB-3");
							if(!isset($arr_website_info['maintenance']))		throw new Error("ERR-WEB-4");
							if(!isset($arr_website_info['meta_title']))			throw new Error("ERR-WEB-5");
							if(!isset($arr_website_info['meta_keywords']))		throw new Error("ERR-WEB-6");
							if(!isset($arr_website_info['meta_description']))	throw new Error("ERR-WEB-7");
							if(!isset($arr_website_info['meta_colour']))		throw new Error("ERR-WEB-8");
							if(!isset($arr_website_info['title']))				throw new Error("ERR-WEB-9");
							if(!isset($arr_website_info['slogan']))				throw new Error("ERR-WEB-10");
							if(!isset($arr_website_info['email']))				throw new Error("ERR-WEB-11");
							if(!isset($arr_website_info['phone']))				throw new Error("ERR-WEB-12");
							if(!isset($arr_website_info['primary_colour']))		throw new Error("ERR-WEB-13");
							if(!isset($arr_website_info['secondary_colour']))	throw new Error("ERR-WEB-14");
							if(!isset($arr_website_info['logo']))				throw new Error("ERR-WEB-15");
							if(!isset($arr_website_info['favicon']))			throw new Error("ERR-WEB-16");
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
							if($mdl_website->UpdateWebsite($arr[0], $arr_website_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-WEB-17");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Delete the domain from the website
					// Confirmations
						try{
							// Nothing to confirm
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
							if($mdl_website->DeleteWebsite($arr[0])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-STY-6");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Website/Style/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function Style($arr) {
			// Vars
				$mdl_website = new WebsiteModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_style_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Creates a new script on the DB
					// Confirmations
						try{
							if(!isset($arr_style_info['name']))			throw new Error("ERR-STY-1");
							if(!isset($arr_style_info['location']))		throw new Error("ERR-STY-2");
							if(!isset($arr_style_info['importance']))	throw new Error("ERR-STY-3");
							if(!isset($arr_style_info['preload']))	throw new Error("ERR-STY-4");
							if(!isset($arr_style_info['active']))		throw new Error("ERR-STY-5");
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
							if($mdl_website->CreateStyle($arr_style_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-STY-6");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Website/Style/{ID}/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function StyleByID($arr) {
			// Vars
				$mdl_website = new WebsiteModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_style_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Update Styles On DB
					// Confirmations
						try{
							if(!isset($arr_style_info['name']))			throw new Error("ERR-STY-1");
							if(!isset($arr_style_info['location']))		throw new Error("ERR-STY-2");
							if(!isset($arr_style_info['importance']))	throw new Error("ERR-STY-3");
							if(!isset($arr_style_info['preload']))		throw new Error("ERR-STY-4");
							if(!isset($arr_style_info['active']))		throw new Error("ERR-STY-5");
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
							if($mdl_website->UpdateStyle($arr[0], $arr_style_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-STY-6");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Delete styles from BD
					// Confirmations
						try{
							// Nothing to confirm
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
							if($mdl_website->DeleteStyle($arr[0])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-STY-6");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Website/Script/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function Script($arr) {
			// Vars
				$mdl_website = new WebsiteModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_script_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Creates a new script on the DB
					// Confirmations
						try{
							if(!isset($arr_script_info['name']))		throw new Error("ERR-SCR-1");
							if(!isset($arr_script_info['location']))	throw new Error("ERR-SCR-2");
							if(!isset($arr_script_info['importance']))	throw new Error("ERR-SCR-3");
							if(!isset($arr_script_info['active']))		throw new Error("ERR-SCR-4");
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
							if($mdl_website->CreateScript($arr_script_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-SCR-5");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Website/Script/{ID}/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function ScriptByID($arr) {
			// Vars
				$mdl_website = new WebsiteModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_script_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Update Script On DB
					// Confirmations
						try{
							if(!isset($arr_script_info['name']))			throw new Error("ERR-SCR-1");
							if(!isset($arr_script_info['location']))		throw new Error("ERR-SCR-2");
							if(!isset($arr_script_info['importance']))	throw new Error("ERR-SCR-3");
							if(!isset($arr_script_info['active']))		throw new Error("ERR-SCR-4");
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
							if($mdl_website->UpdateScript($arr[0], $arr_script_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-SCR-5");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Delete styles from BD
					// Confirmations
						try{
							// Nothing to confirm
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
							if($mdl_website->DeleteScript($arr[0])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-STY-6");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Website/Theme/" Endpoint
		 * @todo
		 * @return JSON
		 */
		public function Theme($arr) {
			// Vars
				$mdl_website = new WebsiteModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_script_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Creates a new script on the DB
					// Confirmations
						try{
							if(!isset($arr_script_info['name']))		throw new Error("ERR-THM-1");
							if(!isset($arr_script_info['description']))	throw new Error("ERR-THM-2");
							if(!isset($arr_script_info['location']))	throw new Error("ERR-THM-3");
							if(!isset($arr_script_info['active']))		throw new Error("ERR-THM-4");
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
							if($mdl_website->CreateTheme($arr_script_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-THM-5");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Website/Theme/{ID}/" Endpoint
		 * @todo
		 * @return JSON
		 */
		public function ThemeByID($arr) {
			// Vars
				$mdl_website = new WebsiteModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_script_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Update Script On DB
					// Confirmations
						try{
							if(!isset($arr_script_info['name']))		throw new Error("ERR-THM-1");
							if(!isset($arr_script_info['description']))	throw new Error("ERR-THM-2");
							if(!isset($arr_script_info['location']))	throw new Error("ERR-THM-3");
							if(!isset($arr_script_info['active']))		throw new Error("ERR-THM-4");
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
							if($mdl_website->UpdateTheme($arr[0], $arr_script_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-THM-5");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Delete styles from BD
					// Confirmations
						try{
							// Nothing to confirm
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
							if($mdl_website->DeleteTheme($arr[0])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-STY-6");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
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