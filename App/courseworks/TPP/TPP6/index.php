<?php 
  require 'func.php';

  $suppliers = getSuppliers();
  // var_dump($supplier);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="header">
    <h1 class="title">Pengelolaan Master Detail Data</h1>
    <button class="add">
      <a href="add_supplier.php">Tambah Data Supplier</a>
    </button>
    <button class="add">
      <a href="add_barang.php">Tambah Data Barang</a>
    </button>
  </div>

  <table>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Telp</th>
      <th>Alamat</th>
      <th>Tindakan</th>
    </tr>
    <?php
      $no = 1;
      foreach ($suppliers as $supplier) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <!-- <td><?= $supplier['id'] ?></td> -->
          <td><?= $supplier['nama'] ?></td>
          <td><?= $supplier['telp'] ?></td>
          <td><?= $supplier['alamat'] ?? 'Surabaya' ?></td>
          <td class="action">
                <button class="edit">
                    <a href="edit.php?id=<?= $supplier['id'] . '&name=' . $supplier['nama'] . '&telp=' . $supplier['telp'] . '&alamat=' . $supplier['alamat'] ?>">Edit</a>
                </button>
                <button class="delete" onclick="confirmDelete(<?= $supplier['id'] ?>)">Hapus</button>
            </td>
        </tr>
    <?php endforeach ?>
  </table>
  <?php
        echo "
        <script>
            function confirmDelete(id) {
                if (confirm('Are you sure you want to delete this supplier?')) {
                    location.href = 'delete.php?id=' + id;
                } else {
                    return false;
                }
            }
        </script>";
    ?>
</body>
</html>