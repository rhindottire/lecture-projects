<?php
include "./aksi/koneksi.php";
$page = "playlist";

$no = 0;

$id_client = $client['id'];

// Periksa apakah `playlist_id` ada di URL dan inisialisasi variabel $playlistID
$playlistID = isset($_GET["playlist_id"]) ? $_GET["playlist_id"] : null;

// Ambil semua playlist milik client
$playlists = query("SELECT * FROM playlists WHERE user_id = $id_client");

$playlist = null;
$musics = [];

// Jika $playlistID tersedia, ambil data playlist dan musik
if ($playlistID) {
    // Ambil informasi playlist (cover, nama playlist)
    $playlist = query("SELECT * FROM playlists WHERE id = $playlistID AND user_id = $id_client");

    // Jika playlist ditemukan, ambil lagu-lagu yang terkait
    if ($playlist) {
        $musics = query("SELECT 
            mp.*, mp.tanggal_ditambahkan AS added_at, mp.id as mpID,
            m.*, m.judul_musik AS judul,
            a.*, 
            art.*
        FROM musik_playlist AS mp
        LEFT JOIN musik AS m ON mp.musik_id = m.id_musik
        LEFT JOIN album AS a ON a.id_album = m.id_album
        LEFT JOIN artis AS art ON m.id_artis = art.id_artis
        WHERE mp.playlist_id = $playlistID;");
    }
}
?>

<html>

<head>
    <title>Playlist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/StylePP.css">
    <link rel="stylesheet" href="./assets/songsPlayer.css">
</head>

<body>
    <div class="container">
        <?php include "./assets/sidebar.php" ?>
        <div class="main-content">
            <?php if (empty($playlists)): ?>
                <!-- Jika tidak ada playlist -->
                <h1>Anda belum punya playlist.</h1>
            <?php elseif ($playlistID && $playlist): ?>
                <div class="header">
                    <div class="search-bar">
                        <form action="">
                            <i class="fas fa-search"></i>
                            <input placeholder="What do you want to play?" id="keyword" type="text" autocomplete="off">
                        </form>
                    </div>
                    <div class="controls">
                        <div class="edit" onclick="openPopup()">
                            <div class="edit-btn">
                                <i class="fa-regular fa-pen-to-square" title="Edit playlist"></i>
                            </div>
                        </div>
                        <div class="delete-playlist" onclick="openDeletePopup()">
                            <div class="delete-pl-btn">
                                <i class="fa-solid fa-x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten Playlist -->
                <div class="playlist-header">
                    <!-- Jika ada playlist -->
                    <img alt="Playlist cover" height="150" src="data:image/jpeg;base64,<?= base64_encode($playlist[0]['cover_playlist']); ?>" width="150" />
                    <div class="details">
                        <h1><?= htmlspecialchars($playlist[0]["name"]); ?></h1>
                        <div class="owner">
                            <img alt="Owner picture" height="30" src="https://storage.googleapis.com/a1aa/image/6iiVFIeaD42oIKAeyovKKivlKKkjccSPW8mNW8SOg4f3jCrnA.jpg" width="30" />
                            <span><?= $client['username'] ?> • <?= count($musics) ?> Lagu</span>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Jika playlistID tidak ditemukan -->
                    <h1>Silakan pilih playlist untuk ditampilkan.</h1>
                <?php endif; ?>
                </div>

                <!-- Song List -->
                <div id="songList">
                    <?php if ($playlistID && !empty($musics)): ?>
                        <table class="song-list">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Album</th>
                                    <th>Date added</th>
                                    <th><i class="fas fa-clock"></i></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($musics as $music): ?>
                                    <?php
                                    $cover_image = 'data:image/jpeg;base64,' . base64_encode($music['gambar_sampul']);
                                    $file_path = '../uploads/lagu/' . $music['file_musik'];
                                    ?>
                                    <tr onclick="handleCardClick(`<?=($music['judul_musik']) ?>`,
                                                                '<?= htmlspecialchars($music['nama_artis']) ?>',
                                                                '<?= htmlspecialchars($cover_image) ?>',
                                                                '<?= htmlspecialchars($file_path) ?>',
                                                                <?= (int)$music['id_musik'] ?>)">
                                        <td><?= ++$no ?></td>
                                        <td class="song-info">
                                            <div>
                                                <img alt="Song cover" height="40" src="data:image/jpeg;base64,<?= base64_encode($music['gambar_sampul']); ?>" width="40" />
                                                <div style="display: inline-block;" class="judulLagu">
                                                    <div><?= htmlspecialchars($music["judul"]); ?></div>
                                                    <span><a href=""><?= htmlspecialchars($music["nama_artis"]); ?></a></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($music["nama_album"]); ?></td>
                                        <td><?= htmlspecialchars($music["added_at"]); ?></td>
                                        <td><?= htmlspecialchars($music["durasi"]); ?></td>
                                        <td class="aksi">
                                            <div class="del-mpl" onclick="event.stopPropagation();openDeleteMusikPopup(<?= htmlspecialchars($music['mpID']); ?>)">
                                                <i class=" fa-solid fa-trash"></i>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
        </div>
    </div>
    <!-- Popup MusicPlayer -->
    <?php include "./assets/songsPlayer.php" ?>

    <!-- Popup Edit Playlist -->
    <?php include "./assets/popEditPL.php"; ?>

    <!-- Popup Konfirmasi Hapus -->
    <?php include "./assets/popHpsPL.php"; ?>

    <!-- Popup Konfirmasi Hapus Musik -->
    <div id="popupDeleteMusik" class="popup deleteMusik-popup">
        <div class="popup-content deleteMusik-popup-content">
            <h2>Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus lagu ini dari playlist?</p>
            <div class="popup-actions deleteMusik-popup-actions">
                <button class="btn-confirm deleteMusik-btn-confirm" id="confirmDeleteMusik">Hapus</button>
                <button class="btn-cancel deleteMusik-btn-cancel" onclick="closeDeleteMusikPopup()">Batal</button>
            </div>
        </div>
    </div>
    <script src="./aksi/songPlayer.js"></script>
    <script src="./assets/script.js"></script>
    <script>
        // Script untuk hapus musik
        let params = new URLSearchParams(document.location.search);
        let playlistID = params.get('playlist_id');
        let BASE_PATH = './aksi'

        initLiveSearch(
            'keyword',
            'songList',
            './ajax/musikPLajx.php', {
                playlist_id: playlistID
            }
        );

        let musicIdToDelete = null;

        function openDeleteMusikPopup(musicId) {
            musicIdToDelete = musicId;
            document.getElementById("popupDeleteMusik").style.display = "flex";
        }

        function closeDeleteMusikPopup() {
            musicIdToDelete = null;
            document.getElementById("popupDeleteMusik").style.display = "none";
        }

        document.getElementById("confirmDeleteMusik").addEventListener("click", function() {
            if (musicIdToDelete) {
                window.location.href = `./aksi/hapusMusikPL.php?playlist_id=${playlistID}&mpID=${musicIdToDelete}`;
            }
        });
    </script>
</body>

</html>