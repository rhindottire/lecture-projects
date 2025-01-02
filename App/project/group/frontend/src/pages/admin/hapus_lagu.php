<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_musik']) && is_numeric($_GET['id_musik'])) {
    $id_musik = $_GET['id_musik']; // Pastikan variabel ini benar

    // Ambil nama lagu sebelum dihapus
    $stmt = $conn->prepare("SELECT judul_musik FROM musik WHERE id_musik = ?");
    $stmt->bind_param("i", $id_musik);
    $stmt->execute();
    $result = $stmt->get_result();
    $musik = $result->fetch_assoc();

    // Jika lagu tidak ditemukan
    if (!$musik) {
        echo "Lagu tidak ditemukan!";
        exit;
    }

    // Ambil nama lagu
    $judul_musik = $musik['judul_musik'];

    // Siapkan query untuk menghapus lagu
    $stmt = $conn->prepare("DELETE FROM musik WHERE id_musik = ?");
    $stmt->bind_param("i", $id_musik); // Menggunakan $id_musik, bukan $id_album

    // Eksekusi query untuk menghapus lagu
    if ($stmt->execute()) {
        // Catat tindakan penghapusan lagu ke tabel history
        $aksi = "Lagu dengan ID $id_musik dan judul '$judul_musik' dihapus.";
        $log_stmt = $conn->prepare("INSERT INTO history (aksi) VALUES (?)");
        $log_stmt->bind_param("s", $aksi);
        $log_stmt->execute();
        $log_stmt->close();

        // Redirect setelah penghapusan
        header("Location: musik.php");
        exit;
    } else {
        // Tampilkan pesan kesalahan jika ada masalah saat penghapusan
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID lagu tidak ditemukan atau tidak valid.";
}

$conn->close();
?>
