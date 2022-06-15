<?
	// Define all vars
		define('API_KEY',	'iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3');
		(isset($_SERVER["HTTP_REFERER"]))?$referer=$_SERVER["HTTP_REFERER"] : $referer=$_SERVER["SERVER_NAME"];
		if(str_contains($referer, "indev")) {	#	THE WESBITE IN IN DEVELOPMENT MODE
			define('STRIPE_API',	['pk_test_51JKqfVFDFLz8LpozviM6GdhHOMvQJh75VMcH0CVomCXtA9gbTRR7tKRvfjLnWQuXEedTNvoD2O6Gj6hmhDRktH2I00hk6jMnBJ', 'sk_test_51JKqfVFDFLz8LpozmlliBbv92XkspmRyy2O7G6IMk2IccfP9ZnimCZ8rJHHCVfIGupLx5FJZafa92igVC2HFWPkz00umY4pOUm']);
			define('ANALYTICS',		['db5007323454.hosting-data.io',	'dbu557431',	'CandleStick2603',	'dbs6034000']);
			define('ADMIN',			['db5007323432.hosting-data.io',	'dbu3023777',	'CandleStick2603',	'dbs6033983']);
		} else {												#	THE WEBSITE IS LAUNCHED AND IS FULLY RELEASED
			define('STRIPE_API',	['pk_live_51JKqfVFDFLz8LpozgswYwIgi1ACsHesIfWpbfyfLEzaKRNk2Meqgt6orqe3Sq6GU5BqVAjxJqvfda6hmK8Od3iVw00IUenuYaQ', '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']);
			define('ANALYTICS',		['db5007301242.hosting-data.io',	'dbu235049',	'CandleStick2603',	'dbs6015868']);
			define('ADMIN', 		['db5007320590.hosting-data.io',	'dbu1278426',	'CandleStick2603',	'dbs6031251']);
		}
		define('__ROOT__',	$_SERVER['DOCUMENT_ROOT']);
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
		/**	Return an invalid request.
		 *	@return	exit	Ends the API and displays an error
		*/
		function invalid_request(int $loc) {
			exit( json_encode( array(
				'error' => 'Valid API request, api_key or OAuth parameters missing',
				'location' => $loc
			) ) );
		};
		/**	Return uri array of string.
		 *	@return	array	Ends the API and displays an error
		*/
		function get_uri() {
			return explode( '/', parse_url(substr($_SERVER['REQUEST_URI'], 1), PHP_URL_PATH) );
		};
		/**	Confirm the API_KEY is set.
		 *	@return	array	Ends the API and displays an error
		*/
		function confApiKey() {
			parse_str(QUERY_STRING, $query);
			if(!isset($query['api_key']) || $query['api_key'] != API_KEY) invalid_request(1);
		};
	//	Get URI Var
		$uri = get_uri();
		$version = $uri[0];
		$controller = $uri[1];
		$controllers = Array(
			'cart',
			'images',
			'product',
			'stripe',
			'users',
			'website',
			'page'
		);
	//	Confirm Controller exists
		if($controller === "" || !in_array(strtolower($controller), $controllers) ) invalid_request(2);
?>