<?
	class BaseModel {
		/** CreateCookie
		 * 
		 *	@param	string	$name
		 *	@param	string	$value
		 *	@return	void
		 */
			public function CreateCookie(string $name, string $value) {
				$options = array (
					'expires'	=>  strtotime('+365 days'),	// Epiry date in string
					'domain'	=> '.thecandlestick.co.uk',	// leading dot for compatibility or use subdomain
					'httponly'	=>  true,					// true or false
					'secure'	=>  true,					// true or false
					'samesite'	=> 'none',					// None || Lax  || Strict
				);
				try {
					if(isset($_COOKIE[$name])) {
						return true;
					} else {
						throw new Error();
					}
				}catch(Error $er){
					return $er;
				}
			}
		/** ConfCookie
		 * 
		 *	@param	string	$name
		 *	@return	void
		 */
			public function ConfCookie(string $name) {
				return isset($_COOKIE[$name]);
			}
		/** Execute
		 *
		 *	@param	array	$DBInfo
		 *	@param	string	$query	"SELECT * FROM..."
		 *	@param	int		$returnType	boolean, row, array, assoc (Default: Boolean)
		 *	@return	Boolean	True / False
		 *	@return	Row		Fetch row as array
		 *	@return	Array	Fetch row as array with keys
		 *	@return	Assoc	Fetch multiple rows with keys
		 *	@return	void
		 */
			public function Execute(string $query, int $returnType, $DBinfo = ADMIN) {
				try {
					if($conn = mysqli_connect($DBinfo[0], $DBinfo[1], $DBinfo[2], $DBinfo[3])) {
						if($res = mysqli_query($conn, $query)) {
							switch ($returnType) {
								case 1:
									return true;
								case 2:
									return mysqli_fetch_row($res);
								case 3:
									return mysqli_fetch_array($res);
								case 4:
									$result = Array();
									while($r=mysqli_fetch_assoc($res)) {
										array_push($result, $r);
									}
									return $result;
								case 5:
									return mysqli_num_rows($res);
							}
						}
					} else {
						throw new Exception("Unable to connect to the DB, Please try again later");
					}
				} catch (Exception $e) {
					throw new Exception($e->getMessage());
				}
				return false;
			}

		/** arrToStr
		 * 
		 * @param	array	$a
		 */
			public function arrToStr(array $a, string $s) {
				$arr = array();
				foreach($a as $x) {
					if(gettype($x) == 'array') {
						array_push($arr, $this->arrToStr($x, ', '));
					} else {
						array_push($arr, gettype($x)."(".strlen($x).") ".$x);
					}
				}
				return join(", ", $arr);
			}
		/** uploadAudit
		 * 
		 *	@param			$f
		 *	@param	array	$p
		 *	@param	string	$s
		 *	@param	string	$category
		 *	@param	int		$uid		0
		 *	@return	void
		 */
			public function uploadAudit($f, array $p, string $s, string $category, string $uid = "0") {
				$this->Execute(sprintf("INSERT INTO `Audit trail`(`IP`, `Timestamp`, `Function`, `Args`, `String`, `User ID`, `Category`) VALUES('%s', now(), '%s', '%s', '%s', '%s', '%s')",
					getHostByName(getHostName()),
					$f,
					$this->arrToStr($p, ', '),
					$s,
					$uid,
					$category
				), 1);
			}
	}
?>