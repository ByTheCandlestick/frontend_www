<?
    /* Auth
        $client_id='1000.GMJG9U2N95YAZGNK6ZN871Q944ASIH';
        $client_secret='e6a2b1e622c987501425712fb1e6193a41eebf38f3';
        $scope='messages';
        $response_type='code';
        $rediredt_url='http://candlestick-indev.co.uk/';

        $url = 'https://accounts.zoho.com/oauth/v2/auth?
            response_type=code&
            client_id='.$client_id.'&
            scope=ZohoMail.folders.READ&
            redirect_uri=http://candlestick-indev.co.uk/
        ';
        $options = array(
            'http' => array(
                'content' => 'application/x-www-form-urlencoded',
                'method'  => 'POST',
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { 
            echo 'Failled to auth. Var dump: ';
            die(var_dump($result));
        }
    */
?>

<html>
    <head>

    </head>
    <body>
        <input type="button" value="Send Email" onclick="submit();">
        <script>
            function submit() {
                var url = "https://accounts.zoho.com/oauth/v2/auth?scope=ZohoMail.folders.READ&client_id=1000.GMJG9U2N95YAZGNK6ZN871Q944ASIH&response_type=code&access_type=offline&redirect_uri=http://candlestick-indev.co.uk/";
                var xhr = new XMLHttpRequest();

                xhr.open("GET", url, true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                
                var res = document.createElement('div');
                res.innerHTML = xhr.responseText;
                res.querySelector("#ElementID")
            }
        </script>
    </body>
</html>