<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <style>
        table,
        tr,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Halo</h1>
    <?php $GLOBALS['flasher'] ?>
    <a href="<?= BASEURL ?>/user/create">Tambah</a>
    <table>
        <?php $i = 1 ?>
        <?php foreach ($data['user'] as $user) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['password'] ?></td>
                <td><a href="<?= BASEURL ?>/user/edit/<?= $user['id'] ?>">EDIT</a></td>
                <td><a href="<?= BASEURL ?>/user/delete/<?= $user['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">DELETE</a></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach ?>
    </table>
</body>

</html>