<?php
require 'config.php';

// Menghapus semua data dari tabel history
$sql = "DELETE FROM history";
if (mysqli_query($conn, $sql)) {
    echo "<script>
        alert('Semua riwayat aktivitas berhasil dihapus.');
        window.location.href = 'home.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus semua riwayat.');
        window.location.href = 'home.php';
    </script>";
}

mysqli_close($conn);
?>
