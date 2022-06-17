<?php
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'):
        $url = "https://";   
    else:
        $url = "http://";
    endif;
    $url.= $_SERVER['HTTP_HOST'];   
?>
    <section>
    	<link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui.css" />
        <style>
            .topbar {
                display: none!important;
            }
        </style>
        <div id="swagger-ui"></div>
        <script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-bundle.js" charset="UTF-8"></script>
        <script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-standalone-preset.js" charset="UTF-8"></script>
        <script>
            window.onload = function() {
                const ui = SwaggerUIBundle({
                    url: "<??>/api.json",
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
    </section>