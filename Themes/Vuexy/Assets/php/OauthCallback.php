<?
    $userdata['Zoho Mail Access Code'] = $_GET['code'];
?>

<html>
    <head>

    </head>
    <body>
        <script>
		    const api_url = '<?print(__API__)?>/Users/Oauth/?api_key=iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3';
            const xhr = new XMLHttpRequest()
            // configure a `POST` request
            xhr.open('POST', api_url+'&uid=1&oauth=1000')
            // create a JSON object
            const params = {
                oauth: '<?print($userdata['Zoho Mail Access Code'])?>',
                uid: '<?print($userdata['UID'])?>'
            }
            // set `Content-Type` header
            xhr.setRequestHeader('Content-Type', 'application/json')
            // pass `params` to `send()` method
            xhr.send(JSON.stringify(params))
            // listen for `load` event
            xhr.onload = () => {
                console.log(xhr.responseText)
            }
        </script>
    </body>
</html>