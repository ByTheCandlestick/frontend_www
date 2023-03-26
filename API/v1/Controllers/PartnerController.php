<?
	class PartnerController extends BaseController {
		/** "/Partner/{uid}" Endpoint - Get list of Products
		 *	
		 *	@return JSON
		 */
		public function List() {
			// Vars
				$mdl_partner = new PartnerModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_partner_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Create a new partner
					// Confirmations
						try{
							if(!isset($arr_partner_info['name']) || $arr_partner_info == "")	throw new Error("ERR-PRT-1");
							if(!isset($arr_partner_info['public']) || $arr_partner_info == "")	throw new Error("ERR-PRT-2");
							if(!isset($arr_partner_info['desc_s']) || $arr_partner_info == "")	throw new Error("ERR-PRT-3");
							if(!isset($arr_partner_info['desc_l']) || $arr_partner_info == "")	throw new Error("ERR-PRT-4");
							//if(!isset($arr_partner_info['logo']) || $arr_partner_info == "")	throw new Error("ERR-PRT-5");
							if(!isset($arr_partner_info['link']) || $arr_partner_info == "")	throw new Error("ERR-PRT-6");
							if(!isset($arr_partner_info['email']) || $arr_partner_info == "")	throw new Error("ERR-PRT-7");
							if(!isset($arr_partner_info['phone']) || $arr_partner_info == "")	throw new Error("ERR-PRT-8");
							if(!isset($arr_partner_info['slug']) || $arr_partner_info == "")	throw new Error("ERR-PRT-9");
							if(!isset($arr_partner_info['active']) || $arr_partner_info == "")	throw new Error("ERR-PRT-10");
							if(!isset($arr_partner_info['uid']) || $arr_partner_info == "")		throw new Error("ERR-PRT-10");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Validation
						try{
							// Nothing to validate
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Submit application
						try{
							$arr_partner_info['logo'] = '';
							if($mdl_partner->Create($arr_partner_info['name'], $arr_partner_info['public'], $arr_partner_info['desc_s'], $arr_partner_info['desc_l'], $arr_partner_info['logo'], $arr_partner_info['link'], $arr_partner_info['email'], $arr_partner_info['phone'], $arr_partner_info['slug'], $arr_partner_info['active'], $arr_partner_info['uid'])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-PRT-11");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Unsupported
					$this->throwError("TODO: List partners", "HTTP/1.1 404 Not Found", '', '', '');
				elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗹 --	Updates the partner
					// Confirmations
						try{
							if(!isset($arr_partner_info['id']) || $arr_partner_info == "")		throw new Error("ERR-PRT-1");
							if(!isset($arr_partner_info['name']) || $arr_partner_info == "")	throw new Error("ERR-PRT-2");
							if(!isset($arr_partner_info['public']) || $arr_partner_info == "")	throw new Error("ERR-PRT-3");
							if(!isset($arr_partner_info['desc_s']) || $arr_partner_info == "")	throw new Error("ERR-PRT-4");
							if(!isset($arr_partner_info['desc_l']) || $arr_partner_info == "")	throw new Error("ERR-PRT-5");
							//if(!isset($arr_partner_info['logo']) || $arr_partner_info == "")	throw new Error("ERR-PRT-6");
							if(!isset($arr_partner_info['link']) || $arr_partner_info == "")	throw new Error("ERR-PRT-7");
							if(!isset($arr_partner_info['email']) || $arr_partner_info == "")	throw new Error("ERR-PRT-8");
							if(!isset($arr_partner_info['phone']) || $arr_partner_info == "")	throw new Error("ERR-PRT-9");
							if(!isset($arr_partner_info['slug']) || $arr_partner_info == "")	throw new Error("ERR-PRT-10");
							if(!isset($arr_partner_info['active']) || $arr_partner_info == "")	throw new Error("ERR-PRT-11");
							if(!isset($arr_partner_info['uid']) || $arr_partner_info == "")	throw new Error("ERR-PRT-11");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Validation
						try{
							// Nothing to validate
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Submit application
						try{
							$arr_partner_info['logo'] = '';
							if($mdl_partner->Update($arr_partner_info['id'], $arr_partner_info['name'], $arr_partner_info['public'], $arr_partner_info['desc_s'], $arr_partner_info['desc_l'], $arr_partner_info['logo'], $arr_partner_info['link'], $arr_partner_info['email'], $arr_partner_info['phone'], $arr_partner_info['slug'], $arr_partner_info['active'], $arr_partner_info['uid'])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-PRT-12");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗹 --	Deletes a partnerT
					// Confirmations
						try{
							if(!isset($arr_partner_info['id']) || $arr_partner_info == "")		throw new Error("ERR-PRT-1");
							if(!isset($arr_partner_info['uid']) || $arr_partner_info == "")		throw new Error("ERR-PRT-1");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Validation
						try{
							// Nothing to validate
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Submit application
						try{
							if($mdl_partner->Delete($arr_partner_info['id'], $arr_partner_info['uid'])) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								throw new Error("ERR-PRT-2");
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				else:
					$this->throwError("Method not supported", "HTTP/1.1 422 Unprocessable Entity", '', '', '');
				endif;
			// Send output
				return $this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
	}
?>