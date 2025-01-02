<?php
include "../aksi/koneksi.php";
$key = addslashes($_GET['key']);
$playlistId = $_GET['playlist_id'];
$no = 0;
$musics = query("SELECT
                mp.*,mp.tanggal_ditambahkan AS added_at,mp.id as mpID,
                m.*, m.judul_musik AS judul,
                a.*,
                art.*,
                p.*,p.name as nama_playlist
            FROM musik_playlist AS mp
            LEFT JOIN playlists as p ON p.id = mp.playlist_id
            LEFT JOIN musik AS m ON mp.musik_id = m.id_musik
            LEFT JOIN album AS a ON a.id_album = m.id_album
            LEFT JOIN artis AS art ON m.id_artis = art.id_artis
            WHERE (m.judul_musik LIKE '%$key%' OR art.nama_artis LIKE '%$key%')
            AND mp.playlist_id = $playlistId");

?>

<div id="songList">
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
                $file_path = './assets/uploads/lagu/' . $music['file_musik'];
                ?>
                <tr onclick="handleCardClick(`<?= htmlspecialchars($music['judul_musik']) ?>`,
                                                '<?= htmlspecialchars($music['nama_artis']) ?>',
                                                '<?= htmlspecialchars($cover_image) ?>',
                                                '<?= htmlspecialchars($file_path) ?>', <?= (int)$music['id_musik'] ?>)">
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
                        <div class="del-mpl" onclick="openDeleteMusikPopup(<?= htmlspecialchars($music['mpID']); ?>)">
                            <i class=" fa-solid fa-trash"></i>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>