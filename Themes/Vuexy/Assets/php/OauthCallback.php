<?
    print_r($_GET);
    print_r($_POST);
?>

<html>
    <head>

    </head>
    <body>

        <script>
<?
    if($userdata['Zoho Mail Access Code'] == null) {
?>

    let params = `scrollbars=no,resizable=yes,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=-1000,top=-1000`;
    open('https://accounts.zoho.eu/oauth/v2/auth?scope=messages&client_id=1000.GMJG9U2N95YAZGNK6ZN871Q944ASIH&response_type=code&access_type=online&redirect_uri=http://admin.candlestick-indev.co.uk/OathCallback.php', 'test', params);

<?
    }
?>
        </script>
    </body>
</html>