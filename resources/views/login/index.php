<?php includeView('partials/header.php', $data) ?>
<?= flasher() ?>
<form action="" method="POST">
    <?= csrf() ?>
    <input type="email" name="email" id="email" placeholder="email" <?php oldValue('email') ?>><br>
    <?php errorValidate('email') ?>
    <input type="password" name="password" id="password" placeholder="password" <?php oldValue('password') ?>><br>
    <?php errorValidate('password') ?>
    <button type="submit">Login</button>
</form>
<?php includeView('partials/footer.php') ?>