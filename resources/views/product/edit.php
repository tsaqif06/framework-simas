<?php includeView('partials/header.php', $data) ?>
<h1>Tambah Data</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="name" id="name" value="<?= $data['product']['name'] ?>">
    <img class="img-preview" src="<?= BASEURL ?>/assets/img/uploads/<?= $data['product']['photo'] ?>" alt="<?= $data['product']['photo'] ?>" width="200" style="display: block">
    <input type="file" name="photo" id="photo" accept="image/*" onchange="showPreview('photo')">
    <button type="submit">Update</button>
</form>

<?php includeView('partials/footer.php') ?>