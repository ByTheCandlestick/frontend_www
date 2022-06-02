<?
	if(str_contains($_SERVER["SERVER_NAME"], "indev")) {	#	THE WESBITE IN IN DEVELOPMENT MODE
		define('__API__',		'http://api.candlestick-indev.co.uk/v1');
		define('STRIPE_API',	['pk_test_51JKqfVFDFLz8LpozviM6GdhHOMvQJh75VMcH0CVomCXtA9gbTRR7tKRvfjLnWQuXEedTNvoD2O6Gj6hmhDRktH2I00hk6jMnBJ', 'sk_test_51JKqfVFDFLz8LpozmlliBbv92XkspmRyy2O7G6IMk2IccfP9ZnimCZ8rJHHCVfIGupLx5FJZafa92igVC2HFWPkz00umY4pOUm']);
		define('ADMIN',			['db5007323432.hosting-data.io',	'dbu3023777',	'CandleStick2603',	'dbs6033983']);
		define('ANALYTICS',		['db5007323454.hosting-data.io',	'dbu557431',	'CandleStick2603',	'dbs6034000']);
	} else {												#	THE WEBSITE IS LAUNCHED AND IS FULLY RELEASED
		define('__API__',		'https://api.thecandlestick.co.uk/v1');
		define('STRIPE_API',	['pk_live_51JKqfVFDFLz8LpozgswYwIgi1ACsHesIfWpbfyfLEzaKRNk2Meqgt6orqe3Sq6GU5BqVAjxJqvfda6hmK8Od3iVw00IUenuYaQ', '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']);
		define('ADMIN', 		['db5007320590.hosting-data.io',	'dbu1278426',	'CandleStick2603',	'dbs6031251']);
		define('ANALYTICS',		['db5007301242.hosting-data.io',	'dbu235049',	'CandleStick2603',	'dbs6015868']);
	}
?>