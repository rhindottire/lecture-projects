<?php
include "koneksi.php";

if (isset($_POST['hapus-playlist'])) {
    $playlist_id = intval($_POST['playlist_id']);

    if ($playlist_id > 0) {
        
        mysqli_query($conn, "DELETE FROM musik_playlist WHERE playlist_id = $playlist_id");
        mysqli_query($conn, "DELETE FROM playlists WHERE id = $playlist_id");

        $last_id = query("SELECT MAX(id) FROM playlists");
        $last_id = $last_id[0]['MAX(id)'];

        echo "<script>
                alert('Playlist berhasil dihapus!');
                window.location.href = '../index.php?playlist_id=$last_id';
            </script>";
        exit();
    } else {
        echo "<script>
                alert('ID playlist tidak valid!');
                window.history.back();
            </script>";
        exit();
    }
} else {
    echo "<script>
            alert('Akses tidak sah!');
            window.history.back();
        </script>";
    exit();
}
?>
