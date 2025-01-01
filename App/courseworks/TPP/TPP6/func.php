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

    if (empty($nama) || empty($telp) || empty($alamat)) {
      echo "<script>alert('All fields are required');</script>";
      return;
    }

    $patternNama = "/^[a-zA-Z'-]+$/";
    $patternTelp = "/^[0-9]+$/";
    // $patternTelp = "/^\d{12}$/";
    $patternAlamat = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/";
    if (!preg_match($patternNama, $nama) || !preg_match($patternTelp, $telp) || !preg_match($patternAlamat, $alamat)) {
      echo "<script>alert('Field nama or telp or alamat contains invalid characters');</script>";
      return;
    }

    $query = "INSERT INTO supplier (nama, telp, alamat) VALUES ('{$nama}', '{$telp}', '{$alamat}')";

    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Data inserted successfully');</script>";
    } else {
      echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "');</script>";
    }
  }

  function update_supplier($id, $nama, $telp, $alamat) {
    global $conn;

    if (empty($nama) || empty($telp) || empty($alamat)) {
      echo "<script>alert('All fields are required');</script>";
      return;
    }

    $patternNama = "/^[a-zA-Z'-]+$/";
    $patternTelp = "/^[0-9]+$/";
    // $patternTelp = "/^\d{12}$/";
    $patternAlamat = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/";

    if (!preg_match($patternNama, $nama) && !preg_match($patternTelp, $telp) && !preg_match($patternAlamat, $alamat)) {
      echo "<script>alert('Field nama or telp or alamat contains invalid characters');</script>";
      return;
    }

    $query = "UPDATE supplier SET nama = '{$nama}', telp = '{$telp}', alamat = '{$alamat}' WHERE id = {$id}";

    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Data updated successfully');</script>";
    } else {
      echo "<script>alert('Error updating data: " . mysqli_error($conn) . "');</script>";
    }
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
    $query = "SELECT * FROM barang";
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

    if (empty($kode_barang) || empty($nama_barang) || empty($harga) || empty($stok) || empty($supplier_id)) {
      echo "<script>alert('All fields are required');</script>";
      return;
    }

    if (!is_numeric($harga) || !is_numeric($stok)) {
      echo "<script>alert('Harga and Stok must be numbers');</script>";
      return;
    }

    $query = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES ('$kode_barang', '$nama_barang', $harga, $stok, $supplier_id)";

    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Data added successfully');</script>";
    } else {
      echo "<script>alert('Error adding data: " . mysqli_error($conn) . "');</script>";
    }
  }

  function update_barang($id, $kode_barang, $nama_barang, $harga, $stok, $supplier_id) {
    global $conn;

    if (empty($kode_barang) || empty($nama_barang) || empty($harga) || empty($stok) || empty($supplier_id)) {
      echo "<script>alert('All fields are required');</script>";
      return;
    }

    if (!is_numeric($harga) || !is_numeric($stok)) {
      echo "<script>alert('Harga and Stok must be numbers');</script>";
      return;
    }

    $query = "UPDATE barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', harga = $harga, stok = $stok, supplier_id = $supplier_id WHERE id = $id";

    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Data updated successfully');</script>";
    } else {
      echo "<script>alert('Error updating data: " . mysqli_error($conn) . "');</script>";
    }
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
?>