<?php
require "func.php";
require "validate.php";

$pelanggan = mysqli_query($conn, "SELECT id,nama FROM pelanggan");

$waktu = $keterangan = $total = $id_pelanggan = '';
$errors = [];

if (isset($_POST['submit'])) {
  $waktu = $_POST['waktu_transaksi'];
  $keterangan = $_POST['keterangan'];
  $id_pelanggan = $_POST['id_pelanggan'];
  $waktuValid = validateWaktu($waktu);
  $keteranganValid = validateKeterangan($keterangan);
  // $totalValid = validateTotal($total);
  if ($waktuValid === true && $keteranganValid === true) {
    $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
            VALUES ('$waktu','$keterangan', '0','$id_pelanggan')";
    if (mysqli_query($conn, $sql)) {
      echo "<script>alert('Data Berhasil Di Tambahkan');</script>";
      $waktu = $keterangan = $total = $id_pelanggan = '';
    } else {
      echo "<script>alert('Data Gagal Di Tambahkan');</script>";
    }
  } else {
    echo "<script>alert('Data Gagal Di Tambahkan');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/add_transaksi.css">
</head>
<body>
  <form action="" method="post">
    <h1>Tambahkan Data Transaksi</h1>
    <label for="waktu_transaksi">Waktu Transaksi :</label>
    <input type="date" id="waktu_transaksi" name="waktu_transaksi" value="<?= htmlspecialchars($waktu) ?>"/>
    <?php if (isset($errors['waktu'])): ?>
      <small><?= $errors['waktu'] ?></small>
    <?php endif; ?>

    <label for="keterangan">Keterangan :</label>
    <textarea id="keterangan" name="keterangan"><?= htmlspecialchars($keterangan) ?></textarea>
    <?php if (isset($errors['keterangan'])): ?>
      <small><?= $errors['keterangan'] ?></small>
    <?php endif; ?>

    <label for="total">Total :</label>
    <input type="number" id="total" name="total" value="0" readonly />
    <?php if (isset($errors['total'])): ?>
      <small><?= $errors['total'] ?></small>
    <?php endif; ?>

    <label for="id_pelanggan">Id Pelanggan</label>
    <select id="id_pelanggan" name="id_pelanggan">
      <?php foreach($pelanggan as $row) : ?>
      <option value="<?= $row['id'] ?>" <?= ($id_pelanggan == $row['id']) ? 'selected' : '' ?>>
        <?= $row['id'] ?> - <?= htmlspecialchars($row['nama']) ?>
      </option>
      <?php endforeach; ?>
    </select>
    <button type="submit" name="submit">Submit</button>
  </form>
</body>
</html>