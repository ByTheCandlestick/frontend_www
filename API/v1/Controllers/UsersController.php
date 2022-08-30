<?php
	class UsersController extends BaseController {
		/** "/Users/" Endpoint - Get list of Users
		 *	@final Complete
		 *	@return JSON
		 */
			public function List() {
				// Vars
					$mdl_User = new UserModel();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$arr_user_info = $this->getQueryStringParams();
					$str_response = "";
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Create new user
						// Confirmations
							try{
								if(!isset($arr_user_info['uname']) || $arr_user_info == "")	throw new Error("ERR-SUP-1");
								if(!isset($arr_user_info['pass1']) || $arr_user_info == "")	throw new Error("ERR-SUP-2");
								if(!isset($arr_user_info['pass2']) || $arr_user_info == "")	throw new Error("ERR-SUP-3");
								if(!isset($arr_user_info['email']) || $arr_user_info == "")	throw new Error("ERR-SUP-4");
								if(!isset($arr_user_info['fname']) || $arr_user_info == "")	throw new Error("ERR-SUP-5");
								if(!isset($arr_user_info['lname']) || $arr_user_info == "")	throw new Error("ERR-SUP-6");
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
							}
						// Validation
							try{
								if(!$this->ValidateEmail($arr_user_info['email']))		throw new Error("ERR-SUP-7");
								if($arr_user_info['pass1']!==$arr_user_info['pass2'])	throw new Error("ERR-SUP-8");
								if($this->ValidatePaswd($arr_user_info['pass1']) != 'success')	throw new Error("ERR-SUP-9");
								if(strlen($arr_user_info['pass1']) < 8)	throw new Error("ERR-SUP-10");
								if(strlen($arr_user_info['uname']) < 6)	throw new Error("ERR-SUP-11");
								$arr_user_info['pass'] = hash('sha512', $arr_user_info['pass1']);
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
							}
						// Submit application
							try{
								$status = $mdl_User->Register($arr_user_info);
								if($status) {	// Success
									$str_response = json_encode(array('status'=>'success'));
								} else {		// Error submitting
									throw new Error("ERR-SUP-12");
								}
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
							}
						//
					elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗹 --	Read all users
						try {
							$int_Limit = 10;
							if(isset($arr_user_info['limit']) && $arr_user_info['limit']) $int_Limit = $arr_user_info['limit'];
							$arr_Users = $mdl_User->ListUsers($int_Limit);
							$str_response = json_encode($arr_Users);
						} catch(Error $er) {
							$this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error");
						}
					elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unknown
						$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
					elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗷 --	Unknown
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
		/** "/Users/{ id }" Endpoint - Get user by ID
		 *	@todo	Update user information
		 *	@return JSON
		 */
			public function GetUser($arr) {
				// Vars
					$mdl_User = new UserModel();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$arr_user_info = $this->getQueryStringParams();
					$str_response = "";
				// Functions 									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Unknown
						$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
					elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗹 --	Read userdata
						try {
							$arr_User = $mdl_User->GetUserById($arr[0]);
							if(isset($arr[1]) && $arr[1]!== "") {
								if(isset($arr_User[0][$arr[1]])) {
									$str_response = json_encode($arr_User[0][$arr[1]]);
								} else {
									$this->throwError("The offset '$arr[1]' you were looking for was not found.", "HTTP/1.1 404 Not Found");
								}
							} else {
								$str_response = json_encode($arr_User);
							}
						} catch (Error $ex) {
							$this->throwError($ex->getMessage()." - Something went wrong! Please contact support.", "HTTP/1.1 500 Internal Server Error");
						}
					elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗹 --	Update user
						$update = array();	$info = array();
						// Confirmations
							try {
								( isset($arr_user_info['pass'])  && $arr_user_info['pass']!="" )? $update['p']=true		: $update['p']=false;
								( isset($arr_user_info['uname']) && $arr_user_info['uname']!="")? $update['uname']=true	: $update['uname']=false;
								( isset($arr_user_info['fname']) && $arr_user_info['fname']!="")? $update['fname']=true	: $update['fname']=false;
								( isset($arr_user_info['lname']) && $arr_user_info['lname']!="")? $update['lname']=true	: $update['lname']=false;
								( isset($arr_user_info['email']) && $arr_user_info['email']!="")? $update['email']=true	: $update['email']=false;
								( isset($arr_user_info['phone']) && $arr_user_info['phone']!="")? $update['phone']=true	: $update['phone']=false;
								( isset($arr_user_info['r_pass']) && $arr_user_info['r_pass']!="")? $update['r_pass']=true	: $update['r_pass']=false;
								( isset($arr_user_info['d_analytics']) && $arr_user_info['d_analytics']!="")? $update['d_analytics']=true	: $update['d_analytics']=false;
								( isset($arr_user_info['e_active']) && $arr_user_info['e_active']!="")? $update['e_active']=true	: $update['e_active']=false;
								( isset($arr_user_info['u_active']) && $arr_user_info['u_active']!="")? $update['u_active']=true	: $update['u_active']=false;

								if( $update['p'] ) {
									$userPass = $mdl_User->GetUserById($arr[0])[0]['pass'];
									$arr_user_info['pass'] = hash('sha512', $arr_user_info['pass']);

									if( isset($arr_user_info['pass1']) && $arr_user_info['pass1']!=""):
										if(isset($arr_user_info['pass2']) && $arr_user_info['pass2']!=""):
											$update['pass'] = true;
										else:
											throw new Error("ERR-UUSR-2");
										endif;
									endif;
								}
							} catch (Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
							}
						// Validation
							try{
								if($update['uname']) {
									if(strlen($arr_user_info['uname']) < 6):
										throw new Error("ERR-UUSR-2");
									else:
										$info['username'] = $arr_user_info['uname'];
									endif;
								}
								if($update['email']) {
									if(!$this->ValidateEmail($arr_user_info['email'])):
										throw new Error("ERR-UUSR-3");
									else:
										$info['email'] = $arr_user_info['email'];
									endif;
								}
								if($update['phone']) {
									if(!$this->ValidatePhone($arr_user_info['email'])):
										throw new Error("ERR-UUSR-3");
									else:
										$info['email'] = $arr_user_info['email'];
									endif;
								}
								if($update['p']) {
									if($arr_user_info['pass1'] != $arr_user_info['pass2'])
										throw new Error("ERR-UUSR-4");
									if($this->ValidatePassword($arr_user_info['pass1']) != 'success')
										throw new Error("ERR-UUSR-5");
									if(strlen($arr_user_info['pass1']) < 8)
										throw new Error("ERR-UUSR-6");
									$info['pass'] = hash('sha512', $arr_user_info['pass1']);
								}
								if($update['fname']) {
									$info['firstname'] = $arr_user_info['fname'];
								}
								if($update['lname']) {
									$info['surname'] = $arr_user_info['lname'];
								}
							} catch(Error $er) {
								$this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity");
							}
						// Submit application
							try {
								if($mdl_User->UpdateUser($arr[0], $update, $arr_user_info)) {	// Success
									$str_response = json_encode(array('status'=>'success'));
								} else {		// Error submitting
									throw new Error("ERR-UUSR-3");
								}
							} catch(Error $er) {
								$this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error");
							}
					elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗹 --	Remove user
						$arr_user_info['user_id'] = $arr[0];
						// Submit application
							try{
								if($mdl_User->DeleteRow($arr_user_info)) {	// Success
									$str_response = json_encode(array('status'=>'success'));
								} else {		// Error submitting
									exit($error = array("status", "ERR-SUP-12"));
								}
							} catch(Exception $ex) {
								$str_ErrorDesc = $ex->getMessage()." - Something went wrong! Please contact support.";
								$str_ErrorHeader = "HTTP/1.1 500 Internal Server Error";
							}
						//
					else:
						$this->throwError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
					endif;
				// send output
					$this->sendOutput(
						$str_response,
						array("Content-Type: application/json", 'HTTP/1.1 200 OK')
					);
				// End of function
			}
		/** "/Users/Session/" Endpoint - Log user in
		 *  @todo Add list sessions functionality
		 *  @todo Add the ability to log in (PUT session)
		 *  @todo Add the ability to logout (DELETE session)
		 *  @param array $arr
		 *	@return JSON
		 */
			public function Session(array $arr) {
				// Vars
					$mdl_User = new UserModel();
					$arr_user_info = $this->getQueryStringParams();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$str_response = "";
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗹 --	Logs the user in and creates a session
						// Confirmations
							try{
								if(!isset($arr_user_info['username']) || $arr_user_info['username'] == "")	throw new Error("ERR-SIN-1");
								if(!isset($arr_user_info['password']) || $arr_user_info['password'] == "")	throw new Error("ERR-SIN-2");
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
							}
						// Validation
							$type = $this->ConfirmUser($arr_user_info['username']);
							try{
								if($type == 'email') {
									if(!$this->ValidateEmail($arr_user_info['email'])) throw new Error("ERR-SIN-3"); // Check if email is valid
								} else {
									if(!$this->ValidateUname($arr_user_info['username'])) throw new Error("ERR-SIN-4"); // Check if the username is valid
								}
								if(!$this->ValidatePaswd($arr_user_info['password'])) throw new Error("ERR-SIN-5"); // Check if password is valid

								$arr_user_info['psecure'] = hash('sha512', 'salt'.$arr_user_info['password'].'pepper');
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
							}
						// Submit application
							try{
								$status = $mdl_User->Login($arr_user_info['username'], $arr_user_info['psecure']);
								if($status) {	// Success
									$str_response = json_encode($status);
								} else {		// Error submitting
									throw new Error("ERR-SUP-11");
								}
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
							}
						//
					elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Lists all sessions
						exit($this->throwError("TODO: This request has not yet been finished", "HTTP/1.1 500 Not Found"));
					elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗹 --	Logs the user out and removes the session
						// Confirmations
							try{
								if(!isset($arr_user_info['session_code']) || $arr_user_info['session_code'] == "")	throw new Error("ERR-SOU-1");
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
							}
						// Validation
							try{
								if(!$mdl_User->ConfirmSession($arr_user_info['session_code'])) throw new Exception("Session code used was not valid");
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
							}
						// Submit application
							try{
								$status = $mdl_User->Logout($arr_user_info['session_code']);
								if($status) {	// Success
									$str_response = json_encode($status);
								} else {		// Error submitting
									throw new Error("ERR-SUP-11");
								}
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
							}
						//
					else:
						exit($this->throwError("Method not supported", "HTTP/1.1 422 Unprocessable Entity"));
					endif;
				// Send output
					$this->sendOutput(
						$str_response,
						array("Content-Type: application/json", "HTTP/1.1 200 OK")
					);
				// End of function
			}
		/** "/Users/Session/" Endpoint - Log user in
		 *  @todo Add list sessions functionality
		 *  @todo Add the ability to log in (PUT session)
		 *  @todo Add the ability to logout (DELETE session)
		 *  @param array $arr
		 *	@return JSON
		 */
			public function Permission(array $arr) {
				// Vars
					$mdl_User = new UserModel();
					$arr_user_info = $this->getQueryStringParams();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$str_response = "";
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗹 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗷 --	Unknown
						// Confirmations
							try{
								// Nothing to confirm
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
							}
						// Validation
							try{
								// Nothing to validate
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 422 Unprocessable Entity"));
							}
						// Submit application
							try{
								if($mdl_User->updatePermissions()) {	// Success
									$str_response = json_encode($status);
								} else {		// Error submitting
									throw new Error("ERR-SUP-11");
								}
							} catch(Error $er) {
								exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
							}
						//
					elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗹 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found"));
					else:
						exit($this->throwError("Method not supported", "HTTP/1.1 422 Unprocessable Entity"));
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