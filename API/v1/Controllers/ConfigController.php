<?php
	class ConfigController extends BaseController {
		/** "/Config/" Endpoint
		 *	
		 *	@return JSON
		 */
            public function Permission() {
                // Vars
                    $requestMethod = $_SERVER['REQUEST_METHOD'];
                    $arr_conf_info = $this->getQueryStringParams();
                    $str_response = "";
                // Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
                    /**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Creates a new permission level
						// Confirmations
							try{
								if(!isset($arr_conf_info['name'])	 || $arr_conf_info['name'] == "")		throw new Error("ERR-CNF-1");
								if(!isset($arr_conf_info['default']) || $arr_conf_info['default'] == "")	throw new Error("ERR-CNF-2");
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
								$mdl_conf = new ConfigModel();
								$status = $mdl_conf->createPermission($arr_conf_info['name'], $arr_conf_info['default']);
								if($status) {	// Success
									$str_response = json_encode(array('status'=>'success'));
								} else {		// Error submitting
									throw new Error("ERR-CNF-3");
								}
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
							}
						//
                    elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Unsupported
                        $this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
                    elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Update a permission name / default
						// Confirmations
							try{
								if(!isset($arr_conf_info['oldName']) || $arr_conf_info['oldName'] == "")	throw new Error("ERR-CNF-1");
								if(!isset($arr_conf_info['newName']) || $arr_conf_info['newName'] == "")	throw new Error("ERR-CNF-2");
								if(!isset($arr_conf_info['default']) || $arr_conf_info['default'] == "")	throw new Error("ERR-CNF-3");
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
								$mdl_conf = new ConfigModel();
								$status = $mdl_conf->updatePermission($arr_conf_info['oldName'], $arr_conf_info['newName'], $arr_conf_info['default']);
								if($status) {	// Success
									$str_response = json_encode(array('status'=>'success'));
								} else {		// Error submitting
									throw new Error("ERR-CNF-4");
								}
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
							}
						//
                    elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗷 --	Delete a permission
						// Confirmations
							try{
								if(!isset($arr_conf_info['name']) || $arr_conf_info['name'] == "")	throw new Error("ERR-CNF-1");
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
								$mdl_conf = new ConfigModel();
								$status = $mdl_conf->deletePermission($arr_conf_info['name']);
								if($status) {	// Success
									$str_response = json_encode(array('status'=>'success'));
								} else {		// Error submitting
									throw new Error("ERR-CNF-4");
								}
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
							}
						//
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