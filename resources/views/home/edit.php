<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>
    <h1>Tambah Data</h1>
    <form action="" method="post">
        <input type="text" name="name" id="name" value="<?= $data['user']['name'] ?>">
        <input type="email" name="email" id="email" value="<?= $data['user']['email'] ?>">
        <input type="password" name="password" id="password" value="<?= $data['user']['password'] ?>">
        <button type="submit">Add</button>
    </form>
</body>

</html>