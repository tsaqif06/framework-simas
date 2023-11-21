<?php includeView('partials/header.php', $data) ?>
<h1>Halo</h1>
<?= flasher() ?>

<a href="<?= BASEURL ?>/product/create">Tambah</a>
<table>
    <?php $i = 1 ?>
    <?php foreach ($products as $product) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $product['name'] ?></td>
            <td><img src="<?= BASEURL ?>/assets/img/uploads/<?= $product['photo'] ?>" alt="<?= $product['photo'] ?>" width="300"></td>
            <?php if (auth()->role === 'admin') : ?>
                <td><a href="<?= BASEURL ?>/product/edit/<?= $product['id'] ?>">EDIT</a></td>
                <td><a href="<?= BASEURL ?>/product/delete/<?= $product['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">DELETE</a></td>
            <?php endif ?>
        </tr>
        <?php $i++ ?>
    <?php endforeach ?>
</table>
<?php includeView('partials/footer.php') ?>