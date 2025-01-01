<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "store";

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "<script>console.log('Connected successfully');</script>";
date_default_timezone_set('Asia/Jakarta');
$errors = [];

function getSuppliers() {
  global $conn;
  $query = "SELECT * FROM supplier";
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

function add_supplier($nama, $telp, $alamat) {
  global $conn;
  $errorMessage = "";

  $fields = ['Nama' => $nama, 'Telp' => $telp, 'Alamat' => $alamat];
  foreach ($fields as $field => $value) {
    if (empty($value)) {
      $errorMessage .= "$field, ";
    }
  }

  if ($errorMessage) {
    echo "<script>alert('Fields berikut tidak boleh kosong: " . rtrim($errorMessage, ', ') . "');</script>";
    return;
  }

  $patterns = [
    'Nama' => "/^[a-zA-Z'-]+$/",
    'Telp' => "/^[0-9]{11,13}$/",
    'Alamat' => "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s\.\-]+$/"
  ];
  $values = ['Nama' => $nama, 'Telp' => $telp, 'Alamat' => $alamat];

  foreach ($patterns as $field => $pattern) {
    if (!preg_match($pattern, $values[$field])) {
      $errorMessages = [
        'Nama' => 'Nama : hanya boleh huruf',
        'Telp' => 'Telp : hanya boleh angka (11-13 digit)',
        'Alamat' => 'Alamat : isian harus alfanumerik \n(minimal harus ada 1 angka dan 1 huruf)'
      ];
      echo "<script>alert('{$errorMessages[$field]}');</script>";
      return;
    }
  }

  $query = "INSERT INTO supplier (nama, telp, alamat)
            VALUES ('{$nama}', '{$telp}', '{$alamat}')";

  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data inserted successfully');</script>";
  } else {
    echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "');</script>";
  }
}

function update_supplier($id, $nama, $telp, $alamat) {
  global $conn;
  $errorMessage = "";

  $fields = ['Nama' => $nama, 'Telp' => $telp, 'Alamat' => $alamat];
  foreach ($fields as $field => $value) {
    if (empty($value)) {
      $errorMessage .= "$field, ";
    }
  }

  if ($errorMessage) {
    echo "<script>alert('Please fill in the following required fields: " . rtrim($errorMessage, ', ') . "');</script>";
    return;
  }

  $patterns = [
    'Nama' => "/^[a-zA-Z'-]+$/",
    'Telp' => "/^[0-9]{11,13}$/",
    'Alamat' => "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s\.\-]+$/"
  ];
  $values = ['Nama' => $nama, 'Telp' => $telp, 'Alamat' => $alamat];

  $errorMessages = [
    'Nama' => 'Nama : hanya boleh huruf',
    'Telp' => 'Telp : hanya boleh angka (11-13 digit)',
    'Alamat' => 'Alamat : isian harus alfanumerik \n(minimal harus ada 1 angka dan 1 huruf)'
  ];

  foreach ($patterns as $field => $pattern) {
    if (!preg_match($pattern, $values[$field])) {
      echo "<script>alert('{$errorMessages[$field]}');</script>";
      return;
    }
  }

  $query = "UPDATE supplier SET nama = ?, telp = ?, alamat = ? WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "sssi", $nama, $telp, $alamat, $id);

  if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Data updated successfully');</script>";
  } else {
    echo "<script>alert('Error updating data: " . mysqli_error($conn) . "');</script>";
  }
  mysqli_stmt_close($stmt);
}

function delete_supplier($id) {
  global $conn;
  $query = "DELETE FROM supplier WHERE id = {$id}";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data deleted successfully');</script>";
  } else {
    echo "<script>alert('Error deleting data: " . mysqli_error($conn) . "');</script>";
  }
}

function get_barangs() {
  global $conn;
  $query = "SELECT
              barang.id AS barang_id,
              barang.kode_barang,
              barang.nama_barang,
              barang.harga,
              barang.stok,
              supplier.nama
            FROM barang
            JOIN supplier ON barang.supplier_id = supplier.id";
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

function add_barang($kode_barang, $nama_barang, $harga, $stok, $supplier_id) {
  global $conn;
  $errorMessage = "";
  $fields = [
    'Kode Barang' => $kode_barang,
    'Nama Barang' => $nama_barang,
    'Harga' => $harga,
    'Stok' => $stok,
    'Supplier ID' => $supplier_id
  ];
  foreach ($fields as $field => $value) {
    if (empty($value)) {
      $errorMessage .= "$field, ";
    }
  }
  if ($errorMessage) {
    echo "<script>alert('Fields berikut tidak boleh kosong: " . rtrim($errorMessage, ', ') . "');</script>";
    return;
  }

  $query_check = "SELECT id FROM barang WHERE kode_barang = '{$kode_barang}'";
  $result_check = mysqli_query($conn, $query_check);
  if (mysqli_num_rows($result_check) > 0) {
    echo "<script>alert('Kode Barang {$kode_barang} sudah ada, silakan gunakan kode yang berbeda');</script>";
    return;
  }

  $patterns = [
    'Kode Barang' => "/^BRG[0-9]{3,4}$/",
    'Nama Barang' => "/^[A-Za-z0-9\s\-\.\,]+$/",
    'Harga' => "/^[0-9]+(\.[0-9]{1,2})?$/", // numeric with optional decimal
    'Stok' => "/^[0-9]+$/",
    'Supplier ID' => "/^[0-9]+$/",
  ];
  $values = ['Kode Barang' => $kode_barang, 'Nama Barang' => $nama_barang, 'Harga' => $harga, 'Stok' => $stok, 'Supplier ID' => $supplier_id];

  $errorMessages = [
    'Kode Barang' => 'Kode Barang : tulis BRG dan angka (3-4 digit)',
    'Nama Barang' => 'Nama Barang : hanya boleh huruf, angka, spasi, titik, koma dan dash',
    'Harga' => 'Harga : harus angka (dengan dua desimal maksimal)',
    'Stok' => 'Stok : harus angka bulat',
    'Supplier ID' => 'Supplier ID : harus angka'
  ];

  foreach ($patterns as $field => $pattern) {
    if (!preg_match($pattern, $values[$field])) {
      echo "<script>alert('{$errorMessages[$field]}');</script>";
      return;
    }
  }

  $query = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id)
            VALUES ('{$kode_barang}', '{$nama_barang}', {$harga}, {$stok}, {$supplier_id})";

  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data inserted successfully');</script>";
    // echo "<script>window.location.href = 'index.php';</script>";
  } else {
    echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "');</script>";
  }
}

function update_barang($id, $kode_barang, $nama_barang, $harga, $stok, $supplier_id) {
  global $conn;
  $errorMessage = "";

  $fields = ['Kode Barang' => $kode_barang, 'Nama Barang' => $nama_barang, 'Harga' => $harga, 'Stok' => $stok, 'Supplier ID' => $supplier_id];
  foreach ($fields as $field => $value) {
    if (empty($value)) {
      $errorMessage .= "$field, ";
    }
  }
  if ($errorMessage) {
    echo "<script>alert('Please fill in the following required fields: " . rtrim($errorMessage, ', ') . "');</script>";
    return;
  }

  $query_check = "SELECT id FROM barang WHERE kode_barang = '{$kode_barang}' AND id != {$id}";
  $result_check = mysqli_query($conn, $query_check);
  if (mysqli_num_rows($result_check) > 0) {
    echo "<script>alert('Kode Barang {$kode_barang} sudah ada, silakan gunakan kode yang berbeda');</script>";
    return;
  }

  $patterns = [
    'Kode Barang' => "/^BRG[0-9]{3,4}$/",
    'Nama Barang' => "/^[A-Za-z0-9\s\-\.\,]+$/",
    'Harga' => "/^[0-9]+(\.[0-9]{1,2})?$/",
    'Stok' => "/^[0-9]+$/",
    'Supplier ID' => "/^[0-9]+$/",
  ];

  $values = [
    'Kode Barang' => $kode_barang,
    'Nama Barang' => $nama_barang,
    'Harga' => $harga,
    'Stok' => $stok,
    'Supplier ID' => $supplier_id
  ];

  $errorMessages = [
    'Kode Barang' => 'Kode Barang : harus dimulai dengan BRG diikuti 3-4 angka',
    'Nama Barang' => 'Nama Barang : hanya boleh huruf, angka, spasi, titik, koma dan dash',
    'Harga' => 'Harga : harus angka (dengan dua desimal maksimal)',
    'Stok' => 'Stok : harus angka bulat',
    'Supplier ID' => 'Supplier ID : harus angka'
  ];

  foreach ($patterns as $field => $pattern) {
    if (!preg_match($pattern, $values[$field])) {
      echo "<script>alert('{$errorMessages[$field]}');</script>";
      return;
    }
  }

  $query_supplier_check = "SELECT id FROM supplier WHERE id = {$supplier_id}";
  $result_supplier_check = mysqli_query($conn, $query_supplier_check);
  if (mysqli_num_rows($result_supplier_check) == 0) {
      echo "<script>alert('Supplier ID tidak ditemukan');</script>";
      return;
  }

  $query = "UPDATE barang
            SET kode_barang = ?, nama_barang = ?, harga = ?, stok = ?, supplier_id = ?
            WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ssdiis", $kode_barang, $nama_barang, $harga, $stok, $supplier_id, $id);

  if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Data updated successfully'); window.location.href='index.php';</script>";
  } else {
    echo "<script>alert('Error updating data: " . mysqli_error($conn) . "');</script>";
  }
  mysqli_stmt_close($stmt);
}

function delete_barang($id) {
  global $conn;
  $query = "DELETE FROM barang WHERE id = $id";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data deleted successfully');</script>";
  } else {
    echo "<script>alert('Error deleting data: " . mysqli_error($conn) . "');</script>";
  }
}

function get_transaksi_detail() { 
  global $conn;
  $query = "SELECT
              transaksi_detail.transaksi_id AS transaksi_detail_id,
              transaksi_detail.barang_id,
              transaksi_detail.harga,
              transaksi_detail.qty,
              barang.kode_barang,
              barang.nama_barang,
              transaksi.waktu_transaksi AS waktu_transaksi
            FROM transaksi_detail
            JOIN barang ON transaksi_detail.barang_id = barang.id
            JOIN transaksi ON transaksi_detail.transaksi_id = transaksi.id
            GROUP BY transaksi.id";
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
?>