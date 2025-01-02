<?php
include "../aksi/koneksi.php";
$key = addslashes($_GET['key']);

$musics = query("SELECT 
    m.*, m.judul_musik AS judul,
    a.*, 
    art.*
FROM musik AS m
LEFT JOIN album AS a ON a.id_album = m.id_album
LEFT JOIN artis AS art ON m.id_artis = art.id_artis
WHERE m.judul_musik LIKE '%$key%'
OR art.nama_artis LIKE '%$key%'
ORDER BY m.id_musik DESC
LIMIT 50");

$no = 0;

?>
<div id="song-list">
    <table class="song-list">
        <thead>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Title
                </th>
                <th>
                    Album
                </th>
                <th>
                    Date added
                </th>
                <th>
                    <i class="fas fa-clock">
                    </i>
                </th>
                <th>
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($musics as $music) : ?>
                <?php
                $cover_image = 'data:image/jpeg;base64,' . base64_encode($music['gambar_sampul']);
                $file_path = './assets/songs/' . htmlspecialchars($music['file_musik']);
                ?>
                <tr onclick="handleCardClick(`<?= ($music['judul_musik']) ?>`,
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
                    <td>
                        <?= $music["nama_album"] ?>
                    </td>
                    <td>
                        <?= $music["tanggal_ditambahkan"] ?>
                    </td>
                    <td>
                        <?= $music["durasi"] ?>
                    </td>
                    <td class="aksi" onclick="showPopup(<?= $music['id_musik']; ?>)">
                        <div class="poke" title="Tambah ke playlist">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>