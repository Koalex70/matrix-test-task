<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="/" method="post">
    <p><b>Введите вашу строку:</b></p>
    <p><textarea rows="10" cols="100" name="text"><?php if (isset($_POST['text'])) {echo $_POST['text']; }?></textarea></p>
    <p><input type="submit" value="Показать все варианты"></p>
</form>

</body>
</html>