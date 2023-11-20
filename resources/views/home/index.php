<?php includeView('partials/header.php', $data) ?>
<h1><?= lang('welcome') ?></h1>
<h1><?= lang('greeting', ['name' => auth()->name]) ?></h1>
<?= flasher() ?>

<?php if (auth()->role === 'admin') : ?>
    <a href="<?= BASEURL ?>/user/create"><?= lang('add') ?></a>
<?php endif ?>
<table>
    <?php $i = 1 ?>
    <?php foreach ($data['user'] as $user) : ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['password'] ?></td>
            <?php if (auth()->role === 'admin') : ?>
                <td><a href="<?= BASEURL ?>/user/edit/<?= $user['id'] ?>">EDIT</a></td>
                <td><a href="<?= BASEURL ?>/user/delete/<?= $user['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">DELETE</a></td>
            <?php endif ?>
        </tr>
        <?php $i++ ?>
    <?php endforeach ?>
</table>
<?php includeView('partials/footer.php') ?>