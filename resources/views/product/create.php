<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>

<body>
    <h1>Tambah Data</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="name" id="name" <?php oldValue('name') ?>>
        <?php errorValidate('name') ?>
        <input type="file" name="photo" id="photo" accept="image/*">
        <?php errorValidate('photo') ?>
        <button type="submit">Store</button>
    </form>
</body>

</html>