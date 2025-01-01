<?php
  require 'func.php';

  if (isset($_POST['submit'])) {
    update_supplier($_POST['id'], $_POST['name'], $_POST['telp'], $_POST['alamat']);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link rel="stylesheet" href="css/edit_supplier.css">
</head>
<body>
  <form action="" method="POST">
    <h3 class="title">Edit Data Master Supplier</h3>
    <input type="hidden" name="id" value="<?= $_GET['id'] ?? ''; ?>">
    <label for="name">Nama</label>
    <input type="text" name="name" id="name" value="<?= $_GET['name'] ?? ''; ?>">
    <label for="telp">Telp</label>
    <input type="text" name="telp" id="telp" value="<?= $_GET['telp'] ?? ''; ?>">
    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" id="alamat" value="<?= $_GET['alamat'] ?? ''; ?>">
    <div class="btn-container">
      <button type="submit" name="submit">Simpan</button>
      <button type="reset" onclick="window.location.href='index.php'">Batal</button>
    </div>
  </form>
</body>
</html>