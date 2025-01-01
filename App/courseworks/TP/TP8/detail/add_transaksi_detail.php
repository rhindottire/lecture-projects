<?php 
require "func.php";
require "validate.php";

$transaksi = get_transaksi_detail();
$barang = get_barangs();

$id_barang = $id_transaksi = $qty = '';

if (isset($_POST['submit'])) {
  $id_barang = $_POST['id_barang'];
  $id_transaksi = $_POST['transaksi_id'];
  $qty = $_POST['qty'];

  $errors = validateTransaksiDetail($id_barang, $id_transaksi, $qty);
  
  if (empty($errors)) {
    $harga_satuan = getHargaBarang($id_barang);
    if ($harga_satuan !== null) {
        $harga_total = $harga_satuan * $qty;
        if (!isDuplicateTransaksiDetail($id_transaksi, $id_barang)) {
          // var_dump($id_transaksi, $id_barang, $harga_total, $qty);die;
          if (insertTransaksiDetail($id_transaksi, $id_barang, $harga_total, $qty)) {
            // var_dump();die;
            echo "<script>alert('Data Berhasil Di Tambahkan');</script>";
            updateTotalTransaksi($conn, $id_transaksi);
          } else {
            echo "<script>alert('Data Gagal Di Tambahkan');</script>";
          }
        } else {
          echo "<script>alert('Data Dengan Transaksi ini Sudah ada');</script>";
        }
    } else {
      echo "Barang tidak ditemukan.";
    }
  } else {
    foreach ($errors as $error) {
      echo "<script>alert('$error');</script>";
    }
  }
}
// var_dump($transaksi)
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/add_transaksi_detail.css">
</head>
<body>
  <form action="" method="post">
    <h1>Tambahkan Detail Transaksi</h1>
    <label for="id_barang">Pilih Barang </label>
    <select id="id_barang" name="id_barang">
      <?php foreach($barang as $row_br) : ?>
        <option value="<?= $row_br['barang_id']; ?>">
          <?= $row_br['barang_id'] ?> -
          <?= $row_br['nama_barang'] ?>
        </option>
      <?php endforeach ?>
    </select>

    <label for="transaksi_id">Id Transaksi</label>
    <select id="transaksi_id" name="transaksi_id">
      <?php foreach($transaksi as $row_tr) : ?>
      <option value="<?= $row_tr['transaksi_detail_id']; ?>">
        <?= $row_tr['transaksi_detail_id'] ?> -
        <?= $row_tr['waktu_transaksi'] ?>
      </option>
      <?php endforeach ?>
    </select>
    <?php if (isset($errors['waktu'])): ?>
      <small><?= $errors['waktu'] ?></small>
    <?php endif; ?>

    <label for="qty">QTY :</label>
    <input type="number" id="qty" value="<?= htmlspecialchars($qty) ?>" name="qty"/>
    <button type="submit" name="submit">Submit</button>
  </form>
</body>
</html>