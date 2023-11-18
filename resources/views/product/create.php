<?php includeView('partials/header.php', $data) ?>
<h1>Tambah Data</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="text" class="<?php isInvalid('name') ?>" name="name" id="name" <?php oldValue('name') ?>>
    <?php errorValidate('name') ?>
    <img class="img-preview" width="200" style="display: none;">
    <input type="file" class="<?php isInvalid('photo') ?>" name="photo" id="photo" accept="image/*" onchange="showPreview('photo')">
    <?php errorValidate('photo') ?>
    <button type="submit">Store</button>
</form>

<?php includeView('partials/footer.php') ?>