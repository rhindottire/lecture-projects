<?php
require 'config.php';

// Ambil ID artis dari query string
$id_artis = isset($_GET['id_artis']) ? intval($_GET['id_artis']) : 0;

// Simpan halaman sebelumnya
$previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'artist.php'; // Default ke artist.php jika tidak ada referer

if ($id_artis > 0) {
    // Ambil nama artis untuk mencatat di riwayat sebelum dihapus
    $stmt_select = $conn->prepare("SELECT nama_artis FROM artis WHERE id_artis = ?");
    $stmt_select->bind_param("i", $id_artis);
    $stmt_select->execute();
    $stmt_select->bind_result($nama_artis);
    $stmt_select->fetch();
    $stmt_select->close();

    if ($nama_artis) {
        // Siapkan pernyataan untuk menghapus artis
        $stmt_delete = $conn->prepare("DELETE FROM artis WHERE id_artis = ?");
        $stmt_delete->bind_param("i", $id_artis);

        // Eksekusi pernyataan
        if ($stmt_delete->execute()) {
            // Catat aksi ke history
            $aksi = "Menghapus artis dengan nama '$nama_artis'";
            $stmt_history = $conn->prepare("INSERT INTO history (aksi) VALUES (?)");
            $stmt_history->bind_param("s", $aksi);
            $stmt_history->execute();
            $stmt_history->close();

            // Set session untuk menampilkan alert setelah redirect
            $_SESSION['message'] = 'Artis berhasil dihapus!';
            $_SESSION['message_type'] = 'delete'; // Menambahkan tipe pesan
            header("Location: artist.php");
            exit;
        } else {
            echo "Gagal menghapus artis: " . $stmt_delete->error;
        }

        $stmt_delete->close();
    } else {
        echo "Artis tidak ditemukan!";
    }
} else {
    echo "ID artis tidak valid!";
}
?>
