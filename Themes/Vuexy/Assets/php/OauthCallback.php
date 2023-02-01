<?
    $userdata['Zoho Mail Access Code'] = $_GET['code'];
	print_r($_GET);
?>
<!--
<html>
    <head>

    </head>
    <body>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            data  = 'api_key=iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3';
            data += '&uid=<?print($userdata['ID'])?>';
            data += '&oauth=<?print($userdata['Zoho Mail Access Code'])?>';
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
        </script>
    </body>
</html>
-->