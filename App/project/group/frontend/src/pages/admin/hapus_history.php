<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tanggal'])) {
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    
    $query = "DELETE FROM history WHERE tanggal = '$tanggal'";
    if (mysqli_query($conn, $query)) {
        // Redirect kembali ke dashboard dengan pesan sukses
        header('Location: home.php?message=Riwayat berhasil dihapus');
    } else {
        // Redirect dengan pesan error
        header('Location: home.php?message=Gagal menghapus riwayat');
    }
} else {
    header('Location: dashboard.php?section=home'); // Jika langsung akses tanpa POST
}
