<?php
include_once "./koneksi.php";

if (isset($_POST['submit-button'])) {
    $playlistID = $_POST['playlist_id'];
    $playlistName = $_POST['edit_playlist_name'];
    $coverPlaylist = null;

    // Cek apakah ada file cover yang di-upload
    if (isset($_FILES['edit_cover_playlist']) && $_FILES['edit_cover_playlist']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['edit_cover_playlist']['tmp_name'];
        $fileData = file_get_contents($fileTmpPath); // Membaca file sebagai binary
        $coverPlaylist = mysqli_real_escape_string($conn, $fileData); // Menyaring data binary
    }

    // Query untuk update playlist
    $sql = "UPDATE playlists SET name = '$playlistName'";

    if ($coverPlaylist) {
        $sql .= ", cover_playlist = '$coverPlaylist'"; // Menambahkan data cover baru jika ada
    }
    $sql .= " WHERE id = $playlistID";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Playlist berhasil diperbarui!'); window.location.href='../index.php?playlist_id=$playlistID';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>