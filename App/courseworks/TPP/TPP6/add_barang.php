<?php
  require 'func.php';

  $suppliers = getSuppliers();
  if (isset($_POST['submit'])) {
    add_barang($_POST['kode_barang'], $_POST['nama_barang'], $_POST['harga'], $_POST['stok'], $_POST['supplier_id']);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Barang</title>
    <link rel="stylesheet" href="css/add_barang.css">
</head>
<body>
    <form action="add_barang.php" method="POST">
      <h3 class="title">Add New Barang</h3>
      <label for="kode_barang">Kode barang</label>
      <input type="text" name="kode_barang" id="kode_barang" value="<?= $_POST['kode_barang'] ?? ''; ?>" placeholder="Masukan kode barang">
      <label for="nama_barang">Nama Barang</label>
      <input type="text" name="nama_barang" id="nama_barang" value="<?= $_POST['nama_barang'] ?? ''; ?>" placeholder="Masukan nama barang">
      <label for="harga">Harga</label>
      <input type="text" name="harga" id="harga" value="<?= $_POST['harga'] ?? ''; ?>" placeholder="Masukan jumllah harga">
      <label for="stok">Stok</label>
      <input type="text" name="stok" id="stok" value="<?= $_POST['stok'] ?? ''; ?>" placeholder="Masukan jumllah stok">
      <label for="supplier_id">Supplier ID</label>
      <select name="supplier_id">
        <option value="">-- Pilih Supplier --</option>
        <?php foreach ($suppliers as $supplier) : ?>
          <option value="<?= $supplier['id'] ?>"><?= $supplier['nama'] ?></option>
        <?php endforeach; ?>
      </select>
      <div class="btn-container">
          <button type="submit" name="submit">Simpan</button>
          <button type="reset">Batal</button></button>
      </div>
    </form>
</body>
</html>