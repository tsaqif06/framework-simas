<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="POST">
        <input type="email" name="email" id="email" placeholder="email" <?php oldValue('email') ?>><br>
        <?php errorValidate('email') ?>
        <input type="password" name="password" id="password" placeholder="password" <?php oldValue('password') ?>><br>
        <?php errorValidate('password') ?>
        <button type="submit">Login</button>
    </form>
</body>

</html>