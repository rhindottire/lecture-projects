<?php
require "func.php";
$id = $_GET['id'];
$query = "DELETE FROM barang WHERE id = '$id'";

if (mysqli_query($conn, $query)) {
  echo "<script>alert('Data Berhasil Di Hapus'); location.href='index.php';</script>";
  exit();
} else {
  echo "<script>alert('Data Gagal di Hapus'); location.href='index.php';</script>";
}
?>