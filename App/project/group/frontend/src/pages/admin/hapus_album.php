<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Ambil ID album dari query string
    $id_album = isset($_GET['id_album']) ? intval($_GET['id_album']) : 0;

    // Validasi jika ID album tidak valid
    if ($id_album <= 0) {
        echo "ID album tidak valid!";
        exit;
    }

    // Ambil nama album berdasarkan ID
    $stmt = $conn->prepare("SELECT nama_album FROM album WHERE id_album = ?");
    $stmt->bind_param("i", $id_album);
    $stmt->execute();
    $result = $stmt->get_result();
    $album = $result->fetch_assoc();

    // Jika album tidak ditemukan
    if (!$album) {
        echo "Album tidak ditemukan!";
        exit;
    }

    // Ambil nama album
    $nama_album = $album['nama_album'];

    // Siapkan query untuk menghapus album
    $stmt = $conn->prepare("DELETE FROM album WHERE id_album = ?");
    $stmt->bind_param("i", $id_album);

    // Eksekusi query untuk menghapus album
    if ($stmt->execute()) {
        // Catat tindakan penghapusan album ke tabel history
        $aksi = "Album dengan ID $id_album dan nama '$nama_album' dihapus.";
        $log_stmt = $conn->prepare("INSERT INTO history (aksi) VALUES (?)");
        $log_stmt->bind_param("s", $aksi);
        $log_stmt->execute();
        $log_stmt->close();

        // Set session untuk menampilkan alert setelah redirect
        $_SESSION['message'] = 'Album berhasil dihapus!';
        $_SESSION['message_type'] = 'delete'; // Menambahkan tipe pesan
        header("Location: Album.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
