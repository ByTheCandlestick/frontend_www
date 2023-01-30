<?
    $userdata['Zoho Mail Access Code'] = $_GET['code'];
?>

<html>
    <head>

    </head>
    <body>
        <script>
            let xhr = new XMLHttpRequest();
            xhr.open("POST", '<?print(__API__)?>/Users/OAuth/');

            xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                console.log(xhr.status);
                console.log(xhr.responseText);
            }};

            let data = {
                "api_key": 's999MUtbgk44pSsXClHLmlT7M0MV6zXZr8CXRJzRP1uU75CnyKUJwiAdK3vwcCDsOIfTEMGuDFqCegQd8ySZ7qIuZyOhEEsbqvo1lejs2qOU8J3bleZV9PG6GQoJsp6nv45c4CQINEswrkLvLUjafTBCkti8migCD94azeA9uWkH7PwlVjLjXprYQ1AbGbQwX54PLezf3XsqwVQVZccZUUeasavhlwK8nwCDuSjLUrdMefTjS0ZH09SO5qeKBn3s',
                "oauth": "<?print($userdata['Zoho Mail Access Code'])?>",
                "uid": "<?print($userdata['ID'])?>"
            };

            xhr.send(data);
            xhr.onload = () => {
                console.log(xhr.responseText)
            }
        </script>
    </body>
</html>