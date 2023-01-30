<?
    $userdata['Zoho Mail Access Code'] = $_GET['code'];
?>

<html>
    <head>

    </head>
    <body>
        <script>
		    const api_url = '<?print(__API__)?>/Users/OAuth/';
            const xhr = new XMLHttpRequest()
            // configure a `POST` request
            xhr.open('POST', api_url)
            // create a JSON object
            const params = {
                api_key: 's999MUtbgk44pSsXClHLmlT7M0MV6zXZr8CXRJzRP1uU75CnyKUJwiAdK3vwcCDsOIfTEMGuDFqCegQd8ySZ7qIuZyOhEEsbqvo1lejs2qOU8J3bleZV9PG6GQoJsp6nv45c4CQINEswrkLvLUjafTBCkti8migCD94azeA9uWkH7PwlVjLjXprYQ1AbGbQwX54PLezf3XsqwVQVZccZUUeasavhlwK8nwCDuSjLUrdMefTjS0ZH09SO5qeKBn3s',
                oauth: '<?print($userdata['Zoho Mail Access Code'])?>',
                uid: '<?print($userdata['ID'])?>'
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