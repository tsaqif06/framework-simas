<?php includeView('partials/header.php', $data) ?>
<h1>Tambah Data</h1>
<form action="" method="post">
    <?= csrf() ?>
    <input type="text" name="name" id="name" <?php oldValue('name') ?>>
    <?php errorValidate('name') ?>
    <input type="email" name="email" id="email" <?php oldValue('email') ?>>
    <?php errorValidate('email') ?>
    <input type="password" name="password" id="password" <?php oldValue('password') ?>>
    <?php errorValidate('password') ?>
    <button type="submit">Add</button>
</form>
<?php includeView('partials/footer.php') ?>