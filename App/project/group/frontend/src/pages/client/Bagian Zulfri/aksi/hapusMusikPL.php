<?php
include "koneksi.php";

// Periksa apakah parameter musik_id dan playlist_id diterima
if (isset($_GET['mpID']) && isset($_GET['playlist_id'])) {
    $mpID = $_GET['mpID'];
    $playlist_id = $_GET['playlist_id'];

    // Query untuk menghapus musik dari playlist
    $query = "DELETE FROM musik_playlist WHERE id = $mpID";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect ke halaman playlist dengan pesan sukses
        header("Location: ../index.php?playlist_id=$playlist_id&message=success");
        exit;
    } else {
        // Redirect ke halaman playlist dengan pesan error
        header("Location: ../index.php?playlist_id=$playlist_id&message=error");
        exit;
    }
} 
