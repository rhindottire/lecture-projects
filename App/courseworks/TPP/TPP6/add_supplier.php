<?php
  require 'func.php';

  if (isset($_POST['submit'])) {
    add_supplier($_POST['nama'] ?? '', $_POST['telp'] ?? '', $_POST['alamat'] ?? '');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier</title>
    <link rel="stylesheet" href="css/add_supplier.css">
</head>
<body>
  <form action="add_supplier.php" method="POST">
    <h3 class="title">Tambah Data Master Supplier Baru</h3>
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" value="<?= $_POST['nama'] ?? ''; ?>" placeholder="Nama">
    
    <label for="telp">Telp</label>
    <input type="text" name="telp" id="telp" value="<?= $_POST['telp'] ?? ''; ?>" placeholder="Telp">
    
    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" id="alamat" value="<?= $_POST['alamat'] ?? ''; ?>" placeholder="Alamat">
    
    <div class="btn-container">
        <button type="submit" name="submit">Simpan</button>
        <button type="reset">Batal</button>
    </div>
  </form>
</body>
</html>