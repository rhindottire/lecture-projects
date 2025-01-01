<?php
  require 'func.php';

  if (isset($_POST['submit'])) {
    add($_POST['name'], $_POST['telp'], $_POST['alamat']);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
  <form action="add.php" method="POST">
    <h3 class="title">Tambah Data Master Supplier Baru</h3>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?= $_POST['name'] ?? ''; ?>" placeholder="Nama">
    <label for="telp">Telp</label>
    <input type="text" name="telp" id="telp" value="<?= $_POST['telp'] ?? ''; ?>" placeholder="telp">
    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" id="alamat" value="<?= $_POST['alamat'] ?? ''; ?>" placeholder="alamat">
    <div class="btn-container">
        <button type="submit" name="submit">Simpan</button>
        <button type="reset">Batal</button>
    </div>
  </form>
</body>
</html>