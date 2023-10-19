<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>

<body>
    <h1>Tambah Data</h1>
    <form action="" method="post">
        <input type="text" name="name" id="name" <?php oldValue('name') ?>>
        <?php errorValidate('name') ?>
        <input type="email" name="email" id="email" <?php oldValue('email') ?>>
        <?php errorValidate('email') ?>
        <input type="password" name="password" id="password" <?php oldValue('password') ?>>
        <?php errorValidate('password') ?>
        <button type="submit">Add</button>
    </form>
</body>

</html>