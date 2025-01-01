<?php
date_default_timezone_set('Asia/Jakarta');
$errors = [];

function getAlltransaksi_Pelanggan() { 
  global $conn;
  $query = "SELECT
              transaksi.id AS transaksi_id, 
              transaksi.waktu_transaksi, 
              transaksi.keterangan, 
              transaksi.total, 
              pelanggan.nama, 
              pelanggan.jenis_kelamin, 
              pelanggan.telp, 
              pelanggan.alamat
          FROM
              transaksi
          JOIN
              pelanggan ON transaksi.pelanggan_id = pelanggan.id;";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
  }
  $rows = [];
  while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function validateTransaksiDetail($id_barang, $id_transaksi, $qty) {
  $errors = [];
  if (empty($id_barang) || empty($id_transaksi)) {
    $errors[] = "ID Barang dan ID Transaksi Tidak Boleh Kosong";
  }
  if (!validateTotal($qty)) {
    $errors[] = "Qty Tidak Boleh Kosong atau Invalid";
  }
  return $errors;
}

function getHargaBarang($id_barang) {
  global $conn;
  $result = mysqli_query($conn, "SELECT harga FROM barang WHERE id = '$id_barang'");
  $row = mysqli_fetch_assoc($result);
  return $row ? $row['harga'] : null;
}

function isDuplicateTransaksiDetail($id_transaksi, $id_barang) {
  global $conn;
  $query = "SELECT * FROM transaksi_detail
            WHERE transaksi_id = '$id_transaksi'
            AND barang_id = '$id_barang'";
  $result = mysqli_query($conn, $query);
  return mysqli_num_rows($result) > 0;
}

function insertTransaksiDetail($id_transaksi, $id_barang, $harga_total, $qty) {
  global $conn;
  $query = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
            VALUES ('$id_transaksi', '$id_barang', '$harga_total', '$qty')";
  return mysqli_query($conn, $query);
}

function validateWaktu($field) {
  if (empty($field)) {
    return "Waktu Transaksi Tidak Boleh Kosong";
  } elseif (strtotime($field) < strtotime(date("Y-m-d"))) {
    return "Tanggal transaksi tidak boleh kurang dari hari sekarang";
  }
  return true;
}

function validateKeterangan($field) {
  if (empty($field)) {
    return "Field keterangan Tidak Boleh Kosong";
  } elseif (!preg_match("/.{3,}/", $field)) {
    return "Field Keterangan Minimal 3 Huruf";
  }
  return true;
}

function validateTotal($field) {
  if (empty($field)) {
    return "Total Tidak Boleh Kosong";
  }
  return true;
}

function validateTransaksiFields($waktu, $keterangan, $total) {
  $errors = [];
  $waktuError = validateWaktu($waktu);
  if ($waktuError) $errors['waktu'] = $waktuError;
  $keteranganError = validateKeterangan($keterangan);
  if ($keteranganError) $errors['keterangan'] = $keteranganError;
  $totalError = validateTotal($total);
  if ($totalError) $errors['total'] = $totalError;
  return $errors;
}

function updateTotalTransaksi($conn, $id) {
  $query = "UPDATE transaksi SET total =
            (SELECT SUM(harga * qty) FROM transaksi_detail
            WHERE transaksi_id = '$id') WHERE id = '$id'";
  mysqli_query($conn, $query);
}
?>