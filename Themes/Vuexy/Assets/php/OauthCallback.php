<?
    $stage = 0;
    if(isset($_GET['code'])) {
        $userdata['Zoho Mail Authorisation Code'] = $_GET['code'];
        $stage = 1;
    }
    if($stage != 0) {
?>
<html>
    <head>

    </head>
    <body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script title="Save Authorisation/Access/Refresh codes">
            var url = "https://accounts.zoho.eu/oauth/v2/token?code=<?=$_GET['code']?>&grant_type=authorization_code&client_id=<?=$config['Zoho Client ID']?>&client_secret=<?=$config['Zoho Client Secret']?>&redirect_uri=http://admin.candlestick-indev.co.uk/OauthCallback.php&scope=ZohoMail.messages.ALL,ZohoMail.attachments.ALL,ZohoMail.tags.ALL,ZohoMail.folders.ALL";
            console.log(url);
            $.post({
                url: url,
                type: 'POST',
                dataType: 'jsonp',
                cors: true,
                contentType:'application/json',
                secure: true,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                },
                success: function (data){
                    console.log(data);

                    
                    data  = 'api_key=iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3';
                    data += '&uid=<?print($userdata['ID'])?>';
                    data += '&access=<?print($userdata['Zoho Mail Access Code'])?>';
                    data += '&refresh=<?print($userdata['Zoho Mail Refresh Code'])?>';
                    $.ajax({
                        url: '<?print(__API__)?>/Users/OAuth/',
                        data: data,
                        type: 'POST',
                        xhrFields: {
                            withCredentials: true
                        },
                        success: function(body) {
                            close();
                        },
                        error: function(body) {
                            alert('Error authorizing.')
                        }
                    });
                }
            })
        </script>
    </body>
</html>
<?
    }
?>