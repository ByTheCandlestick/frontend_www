<html>
    <head>
    </head>
    <body>
        <?
            if($userdata['Zoho Mail Auth Code'] == null) {  
        ?>
            <script>
                let params = `scrollbars=no,resizable=yes,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=0,top=0`;
                open('https://accounts.zoho.eu/oauth/v2/auth?scope=ZohoMail.messages.READ&client_id='.$config['Zoho Client ID'].'&response_type=code&access_type=online&redirect_uri=http://admin.candlestick-indev.co.uk/OauthCallback.php', 'test', params);
            </script>
        <?
            } else {
                print_r('Auth Code: '.$userdata['Zoho Mail Auth Code']);
            }
        ?>
    </body>
</html>