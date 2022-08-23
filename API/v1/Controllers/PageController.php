<?php
	class PageController extends BaseController {
		/** "/Page/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function Page($arr) {
			// Vars
				$mdl_page = new PageModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_page_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗹 --	Creates a new page
					// Confirmations
						try{
							if(!isset($arr_page_info['style']))			throw new Error("ERR-PAG-1");
							if(!isset($arr_page_info['script']))		throw new Error("ERR-PAG-2");
							if(!isset($arr_page_info['name']))			throw new Error("ERR-PAG-3");
							if(!isset($arr_page_info['title']))			throw new Error("ERR-PAG-4");
							if(!isset($arr_page_info['page_url']))		throw new Error("ERR-PAG-5");
							if(!isset($arr_page_info['subpage_url']))	throw new Error("ERR-PAG-6");
							if(!isset($arr_page_info['domain_id']))		throw new Error("ERR-PAG-7");
							if(!isset($arr_page_info['menu_item']))		throw new Error("ERR-PAG-8");
							if(!isset($arr_page_info['menu_order']))	throw new Error("ERR-PAG-9");
							if(!isset($arr_page_info['menu_icon']))		throw new Error("ERR-PAG-10");
							if(!isset($arr_page_info['menu_url']))		throw new Error("ERR-PAG-11");
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
							if($mdl_page->CreatePage($arr_page_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-PAG-7");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:											// (U)nsupported-- 🗹 --	The method is unsupported
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Page/{ID}/" Endpoint
		 * @final
		 * @return JSON
		 */
		public function PageByID($arr) {
			// Vars
				$mdl_page = new PageModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_page_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Updates a page
					// Confirmations
						try{
							if(!isset($arr_page_info['style']))			throw new Error("ERR-PAG-1");
							if(!isset($arr_page_info['script']))		throw new Error("ERR-PAG-2");
							if(!isset($arr_page_info['name']))			throw new Error("ERR-PAG-3");
							if(!isset($arr_page_info['title']))			throw new Error("ERR-PAG-4");
							if(!isset($arr_page_info['page_url']))		throw new Error("ERR-PAG-5");
							if(!isset($arr_page_info['subpage_url']))	throw new Error("ERR-PAG-6");
							if(!isset($arr_page_info['domain_id']))		throw new Error("ERR-PAG-7");
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
							if($mdl_page->UpdatePage($arr[0], $arr_page_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-PAG-7");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗹 --	Delete a page
					// Confirmations
						try{
							// Nothing to confirm.
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
							if($mdl_page->DeletePage($arr[0])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-PAG-1");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				else:											// (U)nsupported-- 🗹 --	The method is unsupported
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Page/Layout/{id}" Endpoint
		 * @final
		 * @return JSON
		 */
		public function LayoutByPageID($arr) {
			// Vars
				$mdl_page = new PageModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_page_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗹 --	Update a page layout
					// Confirmations
						try{
							if(!isset($arr_page_info['display_type']))	throw new Error("ERR-LAY-1");
							if(!isset($arr_page_info['sections']))		throw new Error("ERR-LAY-2");
							if(!isset($arr_page_info['page']))			throw new Error("ERR-LAY-3");
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
							if($mdl_page->UpdateLayout($arr[0], $arr_page_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-PAG-7");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:											// (U)nsupported-- 🗹 --	The method is unsupported
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