<?
	class BaseController {
		/**
		 *	__call magic method.
		 *	@return	Redirect	Redirects to HTTP/1.1 404
		 *	@final				DO NOT OVERWRITE
		 */
		public function __call($name, $arguments) {
			$this->sendOutput('', array('HTTP/1.1 404 Not Found'));
		}
	
		/**
		 *	Get URI elements.
		 * 
		 *	@return array
		 */
		protected function getUriSegments() {
			$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$uri = explode( '/', $uri );
	
			return $uri;
		}
	
		/**
		 *	Get querystring params.
		 *
		 *	@return array
		 */
		protected function getQueryStringParams() {
			parse_str(QUERY_STRING, $query);
			return $query;
		}
	
		/** throwError
		 *	Throw API error.
		 *  @param string $str_ErrorDesc
		 *  @param string $str_ErrorHeader
		 *  @return null
		 */
		protected function throwError($str_ErrorDesc, $str_ErrorHeader) {
			$this->sendOutput(json_encode(
				array("error" => $str_ErrorDesc)), 
				array("Content-Type: application/json", $str_ErrorHeader)
			);
		}
	
		/** sendOutput
		 *  Send API output.
		 *  @param array $data
		 *  @param array $httpHeaders
		 *  @return string
		 */
		protected function sendOutput($data, $httpHeaders=array()) {
			header_remove('Set-Cookie');
	
			if(is_array($httpHeaders) && count($httpHeaders)) {
				foreach ($httpHeaders as $httpHeader) {
					header($httpHeader);
				}
			}

			print($data);
		}
	
		/**
		 *	Validate user email address.
		 *
		 *	@param string $email
		 */
		protected function ValidateEmail(string $email) {
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}
	
		/**
		 *	Validate user phone number.
		 *
		 *	@param string $phone
		 */
		protected function ValidatePhone(string $phone) {
			$p_num = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
			$p_num = preg_replace('/[^0-9+-]/', '', $p_num);
			if(strlen($p_num)>=10 && strlen($p_num)<12) {
				if (!preg_match('/^[0-9-+]$/',$var)) {
					return true;
				}
				return false;
			}
		}
	
		/**
		 *	Validate user password strength.
		 *
		 *	@param string $password
		 */
		protected function ValidatePaswd(string $password) {
			$password_strength = 0;
			// Check if password is over a valid length
				if(strlen($password) >= 6) $password_strength++;
			// Check if pasword includes an numeric character
				if(preg_match('@[0-9]@', $password)) $password_strength++;
			// Check if pasword includes an upper case character
				if(preg_match('@([a-z].*[A-Z])|([A-Z].*[a-z])@', $password)) $password_strength++;
			// Check if pasword includes a symbolic character
				if(preg_match('@([!,%,&,@,#,$,^,*,?,-,~])@', $password)) $password_strength++;
			// Check if pasword includes multiple symbolic character
				if(preg_match('@([!,%,&,@,#,$,^,*,?,-,~].*[!,%,&,@,#,$,^,*,?,-,~])@', $password)) $password_strength++;
			return ($password_strength >= 3)?true:false;
		}
	
		/**
		 *	Validate user username.
		 *
		 *	@param string $username
		 */
		protected function ValidateUname(string $username) {
			$username_strength = 0;
			if(strlen($username) >= 6) $username_strength++;
			return ($username_strength == 1)?true:false;
		}
	}
?>