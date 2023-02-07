<?
	class BaseModel {

		/**
		 * 
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
		/**
		 * 
		 */
		public function ConfCookie(string $name) {
			if(isset($_COOKIE[$name])) return true;
			return false;
		}
		
		/**
		 *	Execute
		 *
		 *	@param	array	$DBInfo
		 *	@param	string	$query	"SELECT * FROM..."
		 *	@param	int		$returnType	boolean, row, array, assoc (Default: Boolean)
		 *	@return	Boolean	True / False
		 *	@return	Row		Fetch row as array
		 *	@return	Array	Fetch row as array with keys
		 *	@return	Assoc	Fetch multiple rows with keys
		**/
		public function Execute(string $query, int $returnType, $DBinfo = ADMIN) {
			try {
				if($conn = mysqli_connect($DBinfo[0], $DBinfo[1], $DBinfo[2], $DBinfo[3])) {
					$res = mysqli_query($conn, $query);
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
				} else {
					throw new Exception("Unable to connect to the DB, Please try again later: " . mysqli_error($this->connection));
				}
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
			return false;
		}
	}
?>