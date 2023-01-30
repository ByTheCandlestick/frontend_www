<html>
    <head>

    </head>
    <body>

        <script>
<?
    if($userdata['Zoho Mail Access Code'] == null) {
?>

    let params = `scrollbars=no,resizable=yes,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`;
    open('https://accounts.zoho.eu/oauth/v2/auth?scope=ZohoMail.messages.READ&client_id=1000.6C2QBKYOO1SJTD3805A56BULSYFRJS&response_type=code&access_type=online&redirect_uri=http://admin.candlestick-indev.co.uk/OauthCallback.php', 'test', params);

<?
    }
?>
        </script>
    </body>
</html>