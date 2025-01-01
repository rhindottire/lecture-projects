<?php
    require 'func.php';

    if (isset($_GET['submit'])) {
        update($_GET['id'], $_GET['name'], $_GET['telp'], $_GET['alamat']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
    <form action="" method="GET">
        <h3 class="title">Edit Data Master Supplier</h3>
        <input type="text" hidden name="id" value="<?= $_GET['id'] ?? ''; ?>">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= $_GET['name'] ?? ''; ?>">
        <label for="telp">Telp</label>
        <input type="text" name="telp" id="telp" value="<?= $_GET['telp'] ?? ''; ?>">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" value="<?= $_GET['alamat'] ?? ''; ?>">
        <div class="btn-container">
            <button type="submit" name="submit">Simpan</button>
            <button type="reset">batal</button>
        </div>
    </form>
</body>
</html>