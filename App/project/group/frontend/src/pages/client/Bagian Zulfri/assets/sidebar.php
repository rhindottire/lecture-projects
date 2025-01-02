<?php
include_once "./aksi/koneksi.php";
$id_client = $client['id'];
$playlists = query("SELECT p.*,p.name AS nama_playlist
                    FROM playlists AS p
                    WHERE user_id = $id_client;");

$prem = query("SELECT 
                    s.*,
                    p.*,
                    c.*
                    FROM subscribes as s
                    LEFT JOIN payments as p ON s.paymentId = p.id
                    LEFT JOIN clients as c ON p.clientId = c.id
                    WHERE c.userId = $id_client");

var_dump(isset($prem[0]));
// die();

?>
<link rel="stylesheet" href="./assets/sidebar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<div class="sidebar">
    <div class="fixed">
        <h2>
            <?= $client['username'] ?> Library
        </h2>
        <div class="menu-item" onclick="window.location.href='../landingPage.php';">
            <i class="fas fa-home">
            </i>
            <small href="##">
                Home
            </small>
        </div>
        <div class="menu-item <?php if ($page == 'filter') echo 'active'; ?>" onclick="document.location.href='GenreFilter.php';">
            <i class="fas fa-filter">
            </i>
            <small href="GenreFilter.php">
                Genre Filter
            </small>
        </div>
        <div class="menu-item <?php if ($page == 'add') echo 'active'; ?>" onclick="document.location.href='newRelease.php'">
            <i class="fas fa-magnifying-glass-plus">
            </i>
            <small>
                Add and New Release
            </small>
        </div>
        <?php if (isset($prem[0])) : ?>
            <div class="menu-item <?php if ($page == 'addPlaylist') echo 'active'; ?>" onclick="document.location.href='create_playlist.php'">
                <i class=" fas fa-plus">
                </i>
                <small href="##">
                    Create Playlist
                </small>
            </div>
        <?php else : ?>
            <div class="menu-item <?php if ($page == 'addPlaylist') echo 'active'; ?>" onclick="return alert('LANGGANAN PREMIUM DIBUTUHKAN UNTUK FITUR INI')">
                <i class=" fas fa-plus">
                </i>
                <small href="##">
                    Create Playlist❗
                </small>
            </div>
        <?php endif; ?>
        <div class="menu-item <?php if ($page == 'playlist') echo 'active'; ?>" onclick="document.location.href='index.php';">
            <i class="fas fa-book">
            </i>
            <small href="index.php">
                Playlists
            </small>
        </div>
        <?php foreach ($playlists as $p) : ?>
            <div class="menu-item" onclick="document.location.href='index.php?playlist_id=<?= $p['id']; ?>'">
                <div class="displayPlaylist">
                    <img alt="Playlist cover" height="40" src="data:image/jpeg;base64,<?= base64_encode($p['cover_playlist']); ?>" width="40" />
                    <p><?= $p["nama_playlist"] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>