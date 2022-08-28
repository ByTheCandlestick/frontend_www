<?
	// Define all vars
		(isset($_SERVER["HTTP_REFERER"]))?$referrer=$_SERVER["HTTP_REFERER"] : $referrer=$_SERVER["SERVER_NAME"];
		if(str_contains($referrer, "indev")) {	#	THE WESBITE IN IN DEVELOPMENT MODE
			define('STRIPE_API',	'sk_test_51JKqfVFDFLz8LpozmlliBbv92XkspmRyy2O7G6IMk2IccfP9ZnimCZ8rJHHCVfIGupLx5FJZafa92igVC2HFWPkz00umY4pOUm');
			define('ANALYTICS',		['db5007323454.hosting-data.io',	'dbu557431',	'CandleStick2603',	'dbs6034000']);
			define('ADMIN',			['db5007323432.hosting-data.io',	'dbu3023777',	'CandleStick2603',	'dbs6033983']);
		} else {												#	THE WEBSITE IS LAUNCHED AND IS FULLY RELEASED
			define('STRIPE_API',	'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');
			define('ANALYTICS',		['db5007301242.hosting-data.io',	'dbu235049',	'CandleStick2603',	'dbs6015868']);
			define('ADMIN', 		['db5007320590.hosting-data.io',	'dbu1278426',	'CandleStick2603',	'dbs6031251']);
		}
		define('__ROOT__',			$_SERVER['DOCUMENT_ROOT']);
	//	Get the query string for each REST type
		if($_SERVER['REQUEST_METHOD'] == "GET") {				// 
			$keys = array_keys($_GET);
			$vals = $_GET;
			$queries = array();
			for($i=0; $i<count($_GET); $i++) {
				array_push($queries, $keys[$i].'='.$vals[$keys[$i]]);
			}
			define('QUERY_STRING',	implode('&', $queries));
		} elseif($_SERVER['REQUEST_METHOD'] == "PUT") {			// DONE
			define('QUERY_STRING',	file_get_contents("php://input"));
		} elseif($_SERVER['REQUEST_METHOD'] == "POST") {		//
			$keys = array_keys($_POST);
			$vals = $_POST;
			$queries = array();
			for($i=0; $i<count($_POST); $i++) {
				array_push($queries, $keys[$i].'='.$vals[$keys[$i]]);
			}
			define('QUERY_STRING',	implode('&', $queries));
		} elseif($_SERVER['REQUEST_METHOD'] == "DELETE") {		// 
			define('QUERY_STRING',	file_get_contents("php://input"));
		}
	//	Functions
		/**	invalid_request
		 *	Return an invalid request.
		 *	@return	exit	Ends the API and displays an error
		 */
			function invalid_request(int $loc) {
				exit( json_encode( array(
					'error' => 'No valid host, request, key or parameters.',
					'location' => $loc
				) ) );
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
				$hosts = [];
				$query = DB_Query("SELECT `ID`, `Hostname` FROM `API Allowed hosts` WHERE `Active?`=1 AND `Created`<now()");
				while($host = mysqli_fetch_array($query)) {
					$hosts[$host['ID']] = $host['Hostname'];
				}
				if(isset($origin)) {
					if(in_array(strtolower($origin), $hosts)) {
						$active = true;
					}
				}
				return (!$active)?invalid_request(4): $origin;
			};
	//	Get URI Vars
		if(checkHost($referrer)) {
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Allow-Methods: GET, POST, OPTIONS, HEAD, PUT, DELETE');
			header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
			header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
			ini_set('display_errors', 1);
		}
		$uri = get_uri();
		$version = checkVersion($uri);
		$controller = checkController($uri);
	//	Confirm Controller exists
?>