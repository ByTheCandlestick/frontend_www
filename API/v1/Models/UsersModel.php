<?
	class UserModel extends BaseModel {
		/** ListUsers
		 *  Lists all users from the database
		 *  @param int $limit
		 *  @return array
		 *	@final
		 */
			public function ListUsers(int $limit) {
				return $this->Execute("SELECT * FROM `Users` ORDER BY `ID` ASC LIMIT $limit", 4);
			}
		/** GetUserByID
		 *  Gets user by User ID
		 *  @param int $uid
		 *  @return array
		 *	@final
		 */
			public function GetUserById(int $uid) {
				return $this->Execute("SELECT * FROM `Users` WHERE `ID`=$uid", 4);
			}
		/**	ListSessions
		 *  Creates a list of all user sessions for a specific user
		 *	@param	array	$arr_user_info
		 *	@return	assoc
		 *	@final
		 */
			public function ListSessions(int $limit) {
				return $this->Execute("SELECT * FROM `Users_sessions` ORDER BY `Start_time` ASC LIMIT $limit", 1);
			}
		/** login
		 *  Logs the user in and creates a session
		 *  @param array $userdata
		 *  @return
		 *	@final
		 */
			public function Login(string $uname, string $pass) {
				$uid = $this->Execute("SELECT `ID` FROM `Users` WHERE `Username`='$uname' AND `Password`='$pass'", 1);
				$code = bin2hex(random_bytes(32));
				$ip = (isset($_SERVER['HTTP_X_FORWARDED_FOR']))? $_SERVER['HTTP_X_FORWARDED_FOR']: $_SERVER['REMOTE_ADDR'];
				$https = (isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != null)? true : false;
				try {
					$arr_cookie_options = array (
						"expires"	=>  date('D, d M Y H:i:s', strtotime('+1 year')),	// Epiry date in string
						"path"		=> "/",												// Base path for the cookie
						"domain"	=> ltrim($_SERVER['HTTP_HOST'], 'api'),				// leading dot for compatibility or use subdomain
						"httponly"	=>  true,											// true or false
						"secure"	=>  $https,											// true or false
						"samesite"	=> "none",											// None || Lax  || Strict
					);

					// Insert session and cookies
					$this->Execute("INSERT INTO `Users_sessions` (`UID`, `Session_code`, `IP_address`, `Start_time`, `Active`) VALUES ('$uid', '$code', '$ip', now(), '1')", 0);
					$session = $this->Execute("SELECT `Session_code` FROM `Users_sessions` WHERE `Session_code`='$code'", 3)[0];
					if(isset($session)) {
						return array(
							"status" => "success",
							"cookies" => array(
								"session_code" => $session
							),
							"options"=>$arr_cookie_options
						);
					} else {
						throw new error('1. False');
					}
				} catch(Error $er) {
					return array(
						"status"=>$er->getMessage(),
					);
				}
			}
		/** Register
		 *  Registers a new user
		 *  @param array $userdata
		 *  @return bool
		 *	@final
		 */
			public function Register(array $userdata) {
				$fname = $userdata['fname']; $email = $userdata['email'];
				$sname = $userdata['lname']; $uname = $userdata['uname'];
				$psecure = $userdata['psecure'];
				if($this->Execute("SELECT * FROM `Users` WHERE `Username`='$uname' OR `Email`='$email'", 5) == 0) {
					$this->Execute("INSERT INTO `Users` (`Username`, `Email`, `First_name`, `Last_name`, `Password`, `Email_active`) VALUES ('$uname', '$email', '$fname', '$sname', '$psecure','0')", 0);
					if($this->Execute("SELECT COUNT(*) FROM `Users` WHERE `Username`='$uname' AND `Email`='$email' AND `Fist_name`='$fname' AND `Last_name`='$sname' AND `Password`='$psecure' AND `Email_active`='0'", 3)[0] == 1) {
						$this->ConfirmEmail($email);
						return true;
					} else {
						return false;
					}
				} else {
					return false;	// Username or email already taken
				}
			}
		/** Logout
		 *	Logs the user out of their account on the current device by session code
		 * 
		 *	@final
		 */
			public function Logout(string $session_code) {
				$session = $this->Execute("UPDATE `Users_sessions` SET `Session_code`='$session_code', `Last accessed`=now(), `Active`='0'", 0);
				if(isset($session)) {
					return array(
						"status" => "success",
					);
				} else {
					return false;
				}
			}
		/** UpdateUser
		 *
		 *	@final
		 */
			public function UpdateUser(int $uid, array $update, array $info) {
				$vars = array();
				if($update['uname']) { array_push($vars, "`Username`='" . $info['uname']."'"); }
				if($update['fname']) { array_push($vars, "`First_name`='" . $info['fname']."'"); }
				if($update['lname']) { array_push($vars, "`Last_name`='" . $info['lname']."'"); }
				if($update['email']) { array_push($vars, "`Email`='" . $info['email']."'"); }
				if($update['phone']) { array_push($vars, "`Phone`='" . $info['phone']."'"); }
				if($update['r_pass']) { array_push($vars, "`Change_password`=" . $info['r_pass']); }
				if($update['d_analytics']) { array_push($vars, "`Disable_analytics`=" . $info['d_analytics']); }
				if($update['e_active']) { array_push($vars, "`Email_active`=" . $info['e_active']); }
				if($update['u_active']) { array_push($vars, "`Active`=" . $info['u_active']); }
				if($update['pass']) { array_push($vars, "`Password`='" . $info['pass1']."'"); }
				return $this->Execute("UPDATE `Users` SET" . implode(', ', $vars) . " WHERE `ID`=".$uid, 1);
			}
		/** ConfirmEmail
		 *
		 *	@todo
		 */
			public function ConfirmEmail(string $t) {
				// headers
				$h  = "From: The Candlestick <no-reply@thecandlestick.co.uk>\r\n";
				$h .= "MIME-Version: 1.0\r\n";
				$h .= "Content-Type: text/html; charset=UTF-8\r\n";
				$h .= "Cc:\r\n";
				$h .= "Bcc:\r\n";
				$s = "Welcome to The Candlestick!";
				$m = "<body marginheight=\"0\" topmargin=\"0\" marginwidth=\"0\" style=\"margin: 0px; background-color: #f2f3f8;\" leftmargin=\"0\"> <table cellspacing=\"0\" border=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#f2f3f8\" style=\"@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;\"> <tr> <td> <table style=\"background-color: #f2f3f8; max-width:670px; margin:0 auto;\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"> <tr> <td style=\"height:80px;\">&nbsp;</td></tr><tr> <td style=\"text-align:center;\"> <a href=\"https://rakeshmandal.com\" title=\"logo\" target=\"_blank\"> <img width=\"60\" src=\"https://indev.thecandlestick.co.uk/assets/images/logos/logo.svg\" title=\"logo\" alt=\"logo\"> </a> </td></tr><tr> <td style=\"height:20px;\">&nbsp;</td></tr><tr> <td> <table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);\"> <tr> <td style=\"height:40px;\">&nbsp;</td></tr><tr> <td style=\"padding:0 35px;\"> <h1 style=\"color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;\">Please confirm your email address</h1> <span style=\"display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;\"></span> <p style=\"color:#455056; font-size:15px;line-height:24px; margin:0;\"> Welcome to ByThe Candlestick, We are glad to have you around! Before you can do anything however, you will need to confirm your email address. (Just to make sure you're not a robot!). So click the link below and get going!</p><a href=\"javascript:void(0);\" style=\"background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;\">Confirm email address</a> </td></tr><tr> <td style=\"height:40px;\">&nbsp;</td></tr></table> </td><tr> <td style=\"height:20px;\">&nbsp;</td></tr><tr> <td style=\"text-align:center;\"> <p style=\"font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;\">&copy; <strong>By The Candlestick</strong> </p></td></tr><tr> <td style=\"height:80px;\">&nbsp;</td></tr></table> </td></tr></table></body>";
				// Send the message
				$sent = mail($t, $s, $m, $h);
				if($sent) {
					return $this->Execute("INSERT INTO `Mail`(`From`, `To`, `Cc`, `Bcc`, `Subject`, `Message`, `Archived?`, `Status`) VALUES ('$f', '$t', '$c', '$b', '$s', '$m', '0', 'Sent')", 1);
				} else {
					$this->Execute("INSERT INTO `Mail`(`From`, `To`, `Cc`, `Bcc`, `Subject`, `Message`, `Archived?`, `Status`) VALUES ('$f', '$t', '$c', '$b', '$s', '$m', '0', 'Error')", 1);
					return false;
				}
				mail($to,$subject,$txt,$headers);
			}
		/** ConfirmUser
		 *
		 */
			public function ConfirmUser(string $username) {
				
			}
		/** ConfirmSession
		 *
		 *	@todo
		 */
			public function ConfirmSession(string $seccode) {
				return $this->Execute(sprintf("SELECT * FROM `Users` WHERE ``=%s LIMIT 1", $seccode), 1);
			}
		/**	updatePermissions
		 *	
		 *	@todo
		 */
			public function updatePermissions(array $perms, string $uid) {
				array_shift($perms);
				$keys = array_keys($perms);
				$vals = $perms;
				$string = [];
				for($i=0; $i<=count($keys); $i++) {
					if($keys[$i] != "" && $vals[$keys[$i]] != "") {
						$key = preg_replace("/permission_/", "", $keys[$i]);
						array_push($string, '`'.$key.'`='.$vals[$keys[$i]]);
					}
				}
				return $this->Execute(sprintf("UPDATE `Users_permissions` SET ".implode(', ', $string)." WHERE `UID`=%s LIMIT 1", $uid), 1);
			}
	}
?>