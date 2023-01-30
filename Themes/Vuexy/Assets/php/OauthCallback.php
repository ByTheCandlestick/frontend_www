<?
    $userdata['Zoho Mail Access Code'] = $_GET['code'];
?>

<html>
    <head>

    </head>
    <body>
        <script>
            const xhr = new XMLHttpRequest()
            // configure a `POST` request
            xhr.open('POST', <?print(__API__)?>'/Users/Oauth/')
            // create a JSON object
            const params = {
                oauth: $userdata['Zoho Mail Access Code'],
                uid: $userdata['UID']
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