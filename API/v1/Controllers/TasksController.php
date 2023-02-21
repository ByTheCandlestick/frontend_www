<?php
	class TasksController extends BaseController {
		/** "/Tasks/Daily/" Endpoint - Executes all daily tasks
		 *	@final Complete
		 *	@return JSON
		 */
			public function Daily() {
				// Vars
					$mdl_tasks = new TasksModel();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$arr_user_info = $this->getQueryStringParams();
					$str_response = "";
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗹 --	Executes all tasks
						// Functions
						try {
							if(!$mdl_tasks->resetTransactions()) throw new Error("ERR-TKD-1");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
						// Submit application
						$str_response = '\n['.date('r').'] - successfully run \'Daily\' tasks;';
					elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
					else:
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
					endif;
				// Send output
					$this->sendOutput(
						$str_response,
						array("Content-Type: Text/plain", "HTTP/1.1 200 OK")
					);
				// End of function
			}
		/** "/Tasks/Weekly/" Endpoint - Executes all weekly tasks
		 *	@final Complete
		 *	@return JSON
		 */
			public function Weekly() {
				// Vars
					$mdl_tasks = new TasksModel();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$arr_user_info = $this->getQueryStringParams();
					$str_response = "";
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗹 --	Executes all tasks
						// Functions
						try {
							if(!$mdl_tasks->resetDudPages()) throw new Error("ERR-TKW-1");
							if(!$mdl_tasks->refundOldOrders()) throw new Error("ERR-TKW-2");
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
						// Submit application
                    	$str_response = '\n['.date('r').'] successfully run \'Weekly\' tasks;';
					elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
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
        /** "/Tasks/Bimonthly/" Endpoint - Executes all Biannual tasks
		 *	@final Complete
		 *	@return JSON
		 */
			public function Bimonthly() {
				// Vars
					$mdl_tasks = new TasksModel();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$arr_user_info = $this->getQueryStringParams();
					$str_response = "";
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗹 --	Executes all tasks
						// Functions
						try {

						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
						// Submit application
                    	$str_response = '\n['.date('r').'] - successfully run \'Bi-monthly\' tasks;';
					elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
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
		/** "/Tasks/Monthly/" Endpoint - Executes all monthly tasks
		 *	@final Complete
		 *	@return JSON
		 */
			public function Monthly() {
				// Vars
					$mdl_tasks = new TasksModel();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$arr_user_info = $this->getQueryStringParams();
					$str_response = "";
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗹 --	Executes all tasks
						// Functions
						try {

						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
						// Submit application
                    	$str_response = '\n['.date('r').'] - successfully run \'Monthly\' tasks;';
					elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
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
		/** "/Tasks/Biannually/" Endpoint - Executes all Biannual tasks
		 *	@final Complete
		 *	@return JSON
		 */
			public function Biannually() {
				// Vars
					$mdl_tasks = new TasksModel();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$arr_user_info = $this->getQueryStringParams();
					$str_response = "";
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗹 --	Executes all tasks
						// Functions
						try {

						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
						// Submit application
                    	$str_response = '\n['.date('r').'] - successfully run \'Bi-annual\' tasks;';
					elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
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
		/** "/Tasks/Annualy/" Endpoint - Executes all annual tasks
		 *	@final Complete
		 *	@return JSON
		 */
			public function Annualy() {
				// Vars
					$mdl_tasks = new TasksModel();
					$requestMethod = $_SERVER['REQUEST_METHOD'];
					$arr_user_info = $this->getQueryStringParams();
					$str_response = "";
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
					elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗹 --	Executes all tasks
						// Functions
						try {

						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
						// Submit application
                    	$str_response = '\n['.date('r').'] - successfully run \'Annual\' tasks;';
					elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unknown
						exit($this->throwError("Unknown Request type for this function", "", "", "", "HTTP/1.1 404 Not Found"));
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