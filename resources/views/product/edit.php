<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>
    <h1>Tambah Data</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="name" id="name" value="<?= $data['product']['name'] ?>">
        <input type="file" name="photo" id="photo" value="<?= $data['product']['photo'] ?>" accept="image/*">
        <button type="submit">Update</button>
    </form>
</body>

</html>