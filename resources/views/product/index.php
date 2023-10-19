<?php require __DIR__ . '/../partials/header.php'; ?>
<h1>Halo</h1>
<?php $GLOBALS['flasher'] ?>
<a href="<?= BASEURL ?>/product/create">Tambah</a>
<table>
    <?php $i = 1 ?>
    <?php foreach ($data['products'] as $product) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $product['name'] ?></td>
            <td><img src="<?= BASEURL ?>/public/assets/img/uploads/<?= $product['photo'] ?>" alt="<?= $product['photo'] ?>" width="300"></td>
            <td><a href="<?= BASEURL ?>/product/edit/<?= $product['id'] ?>">EDIT</a></td>
            <td><a href="<?= BASEURL ?>/product/delete/<?= $product['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">DELETE</a></td>
        </tr>
        <?php $i++ ?>
    <?php endforeach ?>
</table>
<?php require __DIR__ . '/../partials/footer.php'; ?>