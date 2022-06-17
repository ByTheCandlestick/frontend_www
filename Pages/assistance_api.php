<?php
	$code_info = array( 
		"200" => array(
			"200",
			"OK"
		),
		"401" => array(
			"401",
			""
		),
		"403" => array(
			"403",
			""
		),
		"404" => array(
			"404",
			"File not found"
		),
		"405" => array(
			"405",
			"Error, Method Not Allowed Error"
		),
		"406" => array(
			"406",
			""
		),
		"412" => array(
			"412",
			""
		),
		"422" => array(
			"422",
			""
		),
		"431" => array(
			"431",
			""
		),
		"500" => array(
			"500",
			""
		),
		"501" => array(
			"501",
			""
		),
		"502" => array(
			"502",
			""
		)
	);
	if(isset($_GET['code'])) {
		$code = $_GET['code'];
		exit(json_encode($code_info[$code]));
	}
?>

<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>dashboard | By The Candlestick API</title>
			<link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui.css" />
			<link rel="shortcut icon" href="https://www.thecandlestick.co.uk/assets/images/logos/logo - transparent.svg" type="image/x-icon">
			<style>
				html {
					box-sizing: border-box;
					overflow: -moz-scrollbars-vertical;
					overflow-y: scroll;
				}
				*, *:before, *:after {
					box-sizing: inherit;
				}
				body {
					margin:0;
					background: #fafafa;
				}
				.topbar {
					display: none!important;
				}
			</style>
		</head>

		<body>
			<div id="swagger-ui"></div>
			<script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-bundle.js" charset="UTF-8"></script>
			<script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-standalone-preset.js" charset="UTF-8"></script>
			<script>
				window.onload = function() {
					// Begin Swagger UI call region
					const ui = SwaggerUIBundle({
						url: "/api.json",
						dom_id: '#swagger-ui',
						deepLinking: true,
						presets: [
							SwaggerUIBundle.presets.apis,
							SwaggerUIStandalonePreset
						],
						plugins: [
							SwaggerUIBundle.plugins.DownloadUrl
						],
						layout: "StandaloneLayout"
					});
					window.ui = ui;
				};
			</script>
		</body>
	</html>