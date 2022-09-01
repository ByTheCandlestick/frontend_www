<?
	print($_SERVER['REMOTE_ADDR']);
	//	Get the query string for each REST type
		/* */if($_SERVER['REQUEST_METHOD'] == "GET") {				// 
			$keys = array_keys($_GET);
			$vals = $_GET;
			$queries = array();
			for($i=0; $i<count($_GET); $i++) {
				array_push($queries, $keys[$i].'='.$vals[$keys[$i]]);
			}
			define('QUERY_STRING',	implode('&', $queries));
		}elseif($_SERVER['REQUEST_METHOD'] == "PUT") {			// DONE
			define('QUERY_STRING',	file_get_contents("php://input"));
		}elseif($_SERVER['REQUEST_METHOD'] == "POST") {		//
			$keys = array_keys($_POST);
			$vals = $_POST;
			$queries = array();
			for($i=0; $i<count($_POST); $i++) {
				array_push($queries, $keys[$i].'='.$vals[$keys[$i]]);
			}
			define('QUERY_STRING',	implode('&', $queries));
		}elseif($_SERVER['REQUEST_METHOD'] == "DELETE") {		// 
			define('QUERY_STRING',	file_get_contents("php://input"));
		}
	//	Functions
		/**	invalid_request
		 *	Return an invalid request.
		 *	@return	exit	Ends the API and displays an error
		 */
			function invalid_request(int $loc) {
				parse_str(QUERY_STRING, $query);
				$api_key = $query['api_key'];
				unset($query['api_key']);
				exit(json_encode(array(
					'error' => 'No valid host, request method, key or parameters.',
					'location' => $loc,
					'info' => array(
						'host' => $_SERVER['HTTP_REFERER'],
						'remote' => $_SERVER['REMOTE_ADDR'],
						'request' => $_SERVER['REQUEST_METHOD'],
						'key' => $api_key,
						'parameters' => $query,
					),
				)));
			};
		/**	get_uri
		 *	Return uri array of string.
		 *	@return	array	Ends the API and displays an error
		 */
			function get_uri() {
				return explode( '/', parse_url(substr($_SERVER['REQUEST_URI'], 1), PHP_URL_PATH) );
			};
		/**	confApiKey
		 *	Confirm the API_KEY is set.
		 *	@return	array	Ends the API and displays an error
		 */
			function confApiKey() {
				parse_str(QUERY_STRING, $query);
				if(isset($query['api_key'])) {
					if(in_array($query['api_key'], __API_KEYS__)) {
						$active = true;
					}
				}
				if(!$active) invalid_request(1);
			};
		/**	denyHost
		 * 	Checks whether the API key allows for the function to be completed on any host
		 *	@return bool
		 */
			function denyHost() {
				parse_str(QUERY_STRING, $query);
				if(isset($query['api_key'])) {
					return (mysqli_fetch_array(DB_Query(sprintf("SELECT `Deny hosts?` FROM `API Keys` WHERE `Key`='%s'", $query['api_key'])))[0])? true: false;
				}
				if(!$active) invalid_request(1);
			}
		/**	checkVersion
		 *	Confirm the Controller is accepted.
		 *	@param	array	$uri
		 *	@return	array	Ends the API and displays an error
		 */
			  function checkVersion(array $uri) {
			   $versions = [];
			   $query = DB_Query("SELECT `ID`, `Version` FROM `API Versions` WHERE `Active?`=1 AND `Created`<now()");
			   while($controller = mysqli_fetch_array($query)) {
				   $versions[$controller['ID']] = $controller['Version'];
			   }
			   if(isset($uri[0])) {
				   if(in_array(strtolower($uri[0]), $versions)) {
					   $active = true;
				   }
			   }
			   return (!$active)?invalid_request(2): $uri[0];
			};
		/**	checkController
		 *	Confirm the Controller is accepted.
		 *	@param	array	$uri
		 *	@return	array	Ends the API and displays an error
		 */
			function checkController(array $uri) {
				$controllers = [];
				$active = false;
				$query = DB_Query("SELECT `ID`, `Controller` FROM `API Controllers` WHERE `Active?`=1");
				while($controller = mysqli_fetch_array($query)) {
					$controllers[$controller['ID']] = $controller['Controller'];
				}
				if(isset($uri[1])) {
					if(in_array(strtolower($uri[1]), $controllers)) {
						$active = true;
					}
				}
				return ($active == false)? invalid_request(3): $uri[1];
			};
		/**	checkHost
		 *	Confirm the host is accepted.
		 *	@param	string	$referrer
		 *	@return	array	Ends the API and displays an error
		 */
			function checkHost(string $origin) {
				return (!mysqli_fetch_array(DB_Query("SELECT COUNT(*) FROM `API Allowed hosts` WHERE `Active?`=1 AND `Created`<now() AND (`Hostname`='$origin' OR `Remote address`='$origin')"))[0]) invalid_request(4): true;
			};
	//	Get URI Vars
		if((denyHost() && checkHost($referrer)) || !denyHost()) {
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
			header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
			header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
			ini_set('display_errors', 1);
		}
		$uri = get_uri();
		$version = checkVersion($uri);
		$controller = checkController($uri);
	//	Confirm Controller exists
?>