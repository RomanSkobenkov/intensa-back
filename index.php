<?php
include 'request.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Intensa Back</title>
</head>
<body>
<form action="" method="POST">
    <input type="text" name="url" value="<?= $final_url->shortUrl ?>">
    <button type="submit">Сократить</button>
</form>

</body>
</html>