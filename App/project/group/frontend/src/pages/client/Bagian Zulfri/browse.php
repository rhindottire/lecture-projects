<?php
include_once "./aksi/koneksi.php";
$no = 0;
$page = "filter";
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';

$musics = query("SELECT 
    m.*, m.judul_musik AS judul,
    a.*, 
    art.*
FROM musik AS m
LEFT JOIN album AS a ON a.id_album = m.id_album
LEFT JOIN artis AS art ON m.id_artis = art.id_artis
WHERE m.genre = '$genre'");

$playlists = query("SELECT * FROM playlists");



if (isset($_POST['submit'])) {
    $added_at = $_POST['added_at'];
    $songId = $_POST['song_id'];  // ID lagu yang ingin ditambahkan
    $playlistId = $_POST['playlist_id'];  // ID playlist tempat lagu akan ditambahkan

    // Validasi input
    if (!empty($songId) && !empty($playlistId)) {
        // Query untuk menambahkan lagu ke dalam playlist
        $query = "INSERT INTO musik_playlist (playlist_id, musik_id,tanggal_ditambahkan) VALUES ('$playlistId', '$songId','$added_at')";

        // Menjalankan query
        if (mysqli_query($conn, $query)) {
            // Jika berhasil, redirect atau tampilkan pesan sukses
            echo "<script>alert('Song added to playlist successfully!'); window.location.href = 'browse.php?genre=$genre';</script>";
        } else {
            // Jika gagal, tampilkan pesan error
            echo "<script>alert('Failed to add song to playlist.'); window.location.href = 'browse.php?genre=$genre';</script>";
        }
    } else {
        // Jika data tidak lengkap, tampilkan pesan error
        echo "<script>alert('Data not complete.'); window.location.href = 'browse.php?genre=$genre';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Genre</title>
    <style>
        /* Pop-up Style */
        .popup {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .popup-content {
            background-color: #2c2c2c;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        .popup select {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            background-color: #444;
            color: white;
            border-radius: 5px;
            border: none;
        }

        .popup button {
            background-color: rgb(14 165 233);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 5px;
        }

        .popup button:hover {
            background-color: rgb(14 165 233);
        }

        /* Main Content */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #FFFFFF;
        }

        .main-content {
            flex: 1;
            background-color: #181818;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header .search-bar {
            display: flex;
            align-items: center;
            background-color: #333333;
            padding: 5px 10px;
            border-radius: 25px;
        }

        .header .search-bar input {
            background: none;
            border: none;
            color: #FFFFFF;
            margin-left: 10px;
            outline: none;
            height: 35px;
            width: 500px;
            font-size: 16px;
        }

        .song-list {
            width: 100%;
            border-collapse: collapse;
        }

        .song-list th,
        .song-list td {
            padding: 10px;
            text-align: left;
        }

        .song-list th {
            color: #B3B3B3;
            font-size: 12px;
            text-transform: uppercase;
        }

        .song-list td {
            border-top: 1px solid #333333;
        }

        .song-list td.aksi {
            padding: 0;
        }

        .song-list td.aksi div.aksi-icon {
            display: flex;
        }

        .song-list td.aksi div.aksi-icon i {
            margin: auto;
            font-size: 1.3rem;
        }

        .song-list tbody tr {
            transition: all .2s ease-in-out;
        }

        .song-list tbody tr:hover {
            background-color: #333331;
            transform: scale(1.01);
            transition: all .2s ease-in-out;
        }

        .song-list td img {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .song-list td .song-info {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .song-list td .song-info div {
            font-size: 14px;
        }

        .song-info .judulLagu span a {
            font-size: 13px;
            text-decoration: none;
            color: white;
        }

        .song-info .judulLagu span a:hover {
            font-size: 13px;
            text-decoration: underline;
        }
    </style>
    <link rel="stylesheet" href="./assets/songsPlayer.css">
</head>

<body>
    <div class="container">
        <?php include "./assets/sidebar.php"; ?>
        <div class="main-content">
            <div class="header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input placeholder="Search a new song...." type="text" id="keyword">
                </div>
            </div>
            <div>
                <h1>Browse <?= $genre; ?> Musics</h1>
            </div>
            <div id="song-list">
                <table class="song-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Album</th>
                            <th>Date added</th>
                            <th><i class="fas fa-clock"></i></th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($musics as $music) : ?>
                            <?php
                            $cover_image = 'data:image/jpeg;base64,' . base64_encode($music['gambar_sampul']);
                            $file_path = '../../admin/uploads/lagu/' . $music['file_musik'];
                            ?>
                            <tr onclick="handleCardClick(`<?= htmlspecialchars($music['judul_musik']) ?>`,
                                                        '<?= htmlspecialchars($music['nama_artis']) ?>',
                                                        '<?= htmlspecialchars($cover_image) ?>',
                                                        '<?= htmlspecialchars($file_path) ?>',
                                                        <?= (int)$music['id_musik'] ?>)">
                                <td><?= ++$no ?></td>
                                <td class="song-info">
                                    <div>
                                        <img alt="Song cover" height="40" src="data:image/jpeg;base64,<?= base64_encode($music['gambar_sampul']); ?>" width="40" />
                                        <div style="display: inline-block;" class="judulLagu">
                                            <div><?= $music["judul"] ?></div>
                                            <span><a href=""><?= $music["nama_artis"] ?></a></span>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $music["nama_album"] ?></td>
                                <td><?= $music["tanggal_ditambahkan"] ?></td>
                                <td><?= $music["durasi"] ?></td>
                                <td class="aksi" onclick="event.stopPropagation();showPopup(<?= $music['id_musik']; ?>)">
                                    <div class="aksi-icon" title="Tambah ke Playlist">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pop-up Form -->
    <div class="popup" id="popup">
        <div class="popup-content">
            <h3>Add to Playlist</h3>
            <form action="" method="POST">
                <select id="playlist-select" name="playlist_id">
                    <?php foreach ($playlists as $playlist) : ?>
                        <option value="<?= $playlist['id'] ?>"><?= $playlist['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="genre" id="genre" value="<?= $genre ?>">
                <input type="hidden" id="song-id" name="song_id" value="" />
                <input type="hidden" name="added_at" id="added" value="<?= date("Y-m-d") ?>">
                <button type="submit" name="submit">Add to Playlist</button>
                <button type="button" onclick="closePopup()">Close</button>
            </form>
        </div>
    </div>

    <!-- Pop-up Music Player -->
    <?php include "./assets/songsPlayer.php" ?>

    <script src="./aksi/songPlayer.js"></script>
    <script src="./assets/script.js"></script>
    <script>
        let params = new URLSearchParams(document.location.search);
        let genre = params.get('genre');
        let BASE_PATH = ".aksi/"

        initLiveSearch(
            'keyword',
            'song-list',
            './ajax/browseSearchAJX.php', {
                genre: genre
            }
        );

        function showPopup(songId) {
            document.getElementById("popup").style.display = "flex";
            document.getElementById("song-id").value = songId;
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }
    </script>
</body>

</html>