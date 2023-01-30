<?
    // Auth
        $client_id='1000.XN45OX38ZOV31OELINSLXW5NJBM09X';
        $client_secret='fede0b187e3e93608c2fd2bf8cf214267f0b172c9a';
        $scope='messages';
        $response_type='code';
        $rediredt_url='http://candlestick-indev.co.uk/';

        $uri = 'https://accounts.zoho.eu/oauth/v2/auth?scope='.$scope.'&client_id='.$client_id.'&response_type='.$response_type.'&access_type=online&redirect_uri='.$redirect_uri;
        $options = array(
            'http' => array(
                'method'  => 'GET',
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { 
            echo 'Email failled to get account. Var dump: ';
            die(var_dump($result));
        }
    // Get user account
        $url = " http://mail.zoho.com/api/accounts";
        $options = array(
            'http' => array(
                'method'  => 'GET',
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { 
            echo 'Email failled to get account. Var dump: ';
            die(var_dump($result));
        }

    // Send Email
        $url = 'https://mail.zoho.eu/api/accounts/20081772349/messages';
        $data = array(
            'fromAddress'=>'noreply@thecandlestick.co.uk',
            'toAddress'=>'rsmith_20@outlook.com',
            'subject'=>'subject',
            'content'=>'content',
            'askReceipt'=>'yes');
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { 
            echo 'Email failled to send. Var dump: ';
            var_dump($result);
        } else {
            echo 'Email sent successfully';
        }

?>