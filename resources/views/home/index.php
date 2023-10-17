<?php require __DIR__ . '/../partials/header.php'; ?>
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
<?php require __DIR__ . '/../partials/footer.php'; ?>