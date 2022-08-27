<?php
	class ConfigController extends BaseController {
		/** "/Config/" Endpoint
		 *	
		 *	@return JSON
		 */
            public function List() {
                // Vars
                    $requestMethod = $_SERVER['REQUEST_METHOD'];
                    $arr_prod_info = $this->getQueryStringParams();
                    $str_response = "";
                // Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
                    /**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Unsupported
                        $this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
                    elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Unsupported
                        $this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
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