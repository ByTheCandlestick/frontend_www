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
    window.open('https://accounts.zoho.eu/oauth/v2/auth?scope=messages&client_id=1000.GMJG9U2N95YAZGNK6ZN871Q944ASIH&response_type=code&access_type=online&redirect_uri=http://admin.candlestick-indev.co.uk/OathCallback.php')

<?
    }
?>
        </script>
    </body>
</html>