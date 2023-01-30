<html>
    <head>
    </head>
    <body>
        <?
            if($userdata['Zoho Mail Auth Code'] == null) {  
        ?>
            <script>
            </script>
        <?
            } else {
                print_r('Auth Code: '.$userdata['Zoho Mail Auth Code']);
            }
        ?>
    </body>
</html>