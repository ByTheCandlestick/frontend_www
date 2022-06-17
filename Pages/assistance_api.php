<?
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'? $url = "https://" : $url = "http://";
    $url.= $_SERVER['HTTP_HOST'];   
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Analytics</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui.css" />
        <div id="swagger-ui"></div>
        <script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-bundle.js" charset="UTF-8"></script>
        <script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-standalone-preset.js" charset="UTF-8"></script>
        <script>
            window.onload = function() {
                const ui = SwaggerUIBundle({
                    url: "<?print($url);?>/api.json",
                    dom_id: '#swagger-ui',
                    deepLinking: true,
                    validatorUrl: null,
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
    </div>
</section>