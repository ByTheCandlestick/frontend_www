<?
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