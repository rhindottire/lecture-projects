<?php
  require "func.php";
  require "validate.php";
  $barang = get_barangs();
  $transaksi = getAlltransaksi_Pelanggan();
  $transaksi_detail = get_transaksi_detail();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <div class="header">
    <h1 class="title">Pengelolaan Master Detail Data</h1>
    <button class="add"><a href="add_transaksi.php">Add Transaksi</a></button>
    <button class="add"><a href="add_transaksi_detail.php">Add Transaksi Detail</a></button>
  </div>

  <div class="table-container">
    <h1>Table Barang</h1>
    <table>
      <tr>
        <th>ID</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Nama Supplier</th>
        <th>Action</th>
      </tr>
      <?php foreach($barang as $row): ?>
        <tr>
          <td><?= $row['barang_id']; ?></td>
          <td><?= $row['kode_barang']; ?></td>
          <td><?= $row['nama_barang']; ?></td>
          <td><?= $row['harga']; ?></td>
          <td><?= $row['stok']; ?></td>
          <td><?= $row['nama']; ?></td>
          <td>
            <button class="delete">
            <a href="delete_barang.php?id=<?= $row['barang_id']; ?>"
              onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')">
              Hapus
            </a>
            </button>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
    <h1>Table Transaksi</h1>
    <table>
      <tr>
        <th>ID</th>
        <th>Waktu Transaksi</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Nama Pelanggan</th>
      </tr>
      <?php foreach($transaksi as $row): ?>
        <tr>
          <td><?= $row['transaksi_id']; ?></td>
          <td><?= $row['waktu_transaksi']; ?></td>
          <td><?= $row['keterangan']; ?></td>
          <td><?= $row['total']; ?></td>
          <td><?= $row['nama']; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <div class="table-detail">
    <h1>Table Transaksi Detail</h1>
    <table>
      <tr>
        <th>Transaksi ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
      </tr>
      <?php foreach($transaksi_detail as $row): ?>
        <tr>
          <td><?= $row['transaksi_detail_id']; ?></td>
          <td><?= $row['nama_barang']; ?></td>
          <td><?= $row['harga']; ?></td>
          <td><?= $row['qty']; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>