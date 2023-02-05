<?
    $stage = 0;
    if(isset($_GET['code'])) {
        $userdata['Zoho Mail Authorisation Code'] = $_GET['code'];
        $stage = 1;
    }
    if(isset($_GET['access_token '])) {
        $userdata['Zoho Mail Access Code'] = $_GET['access_token '];
        $userdata['Zoho Mail Refresh Code'] = $_GET['refresh_token'];
        $stage = 2;
    }
    if($stage != 0) {
?>
<html>
    <head>

    </head>
    <body>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script title="Save Authorisation/Access/Refresh codes">
            <?
                if($stage == 1) {
            ?>
                var win = window.open('https://accounts.zoho.eu/oauth/v2/token?code=<?=$_GET['code']?>&grant_type=authorization_code&client_id=<?=$config['Zoho Client ID']?>&client_secret=<?=$config['Zoho Client Secret']?>&redirect_uri=http://admin.candlestick-indev.co.uk/OauthCallback.php&scope=ZohoMail.messages.ALL,ZohoMail.attachments.ALL,ZohoMail.tags.ALL,ZohoMail.folders.ALL', 'Zoho OAuth', 'scrollbars=no,resizable=yes,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=0,top=0');
                var timer = setInterval(function() {
                    if(win.closed) {  
                        clearInterval(timer);
                        //window.close();
                    }  
                }, 1000); 
            <?
                }
                if($stage == 2) { 
            ?>
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
            <?
                }
            ?>
        </script>
    </body>
</html>
<?
    }
?>