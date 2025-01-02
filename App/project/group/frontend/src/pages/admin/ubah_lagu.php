<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses data yang dikirim dari form
    $id_musik = intval($_POST['id_musik']);
    $judul_musik = trim($_POST['judul_musik']);
    $id_artis = intval($_POST['id_artis']);
    $id_album = intval($_POST['id_album']);
    $genre = trim($_POST['genre']);
    $durasi = trim($_POST['durasi']);

    $stmt = $conn->prepare("SELECT file_musik FROM musik WHERE id_musik = ?");
    $stmt->bind_param("i", $id_musik);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $old_file_musik = $row['file_musik'];
    $stmt->close();

    // Handle file upload
    if (isset($_FILES['file_musik']) && $_FILES['file_musik']['error'] === 0) {
        $file_musik = $_FILES['file_musik']['name'];
        $tmp_name = $_FILES['file_musik']['tmp_name'];
        $file_ex = pathinfo($file_musik, PATHINFO_EXTENSION);
        $file_ex_lc = strtolower($file_ex);
        $allowed_exs = array("3gp", "mp3", "m4a", "wav", "m3u", "ogg");

        if (in_array($file_ex_lc, $allowed_exs)) {
            $new_file_name = uniqid("file-", true) . '.' . $file_ex_lc;
            $file_upload_path = 'uploads/' . $new_file_name;
            move_uploaded_file($tmp_name, $file_upload_path);

            if (!empty($old_file_musik) && file_exists("uploads/" . $old_file_musik)) {
                unlink("uploads/" . $old_file_musik);
            }

            $file_musik = $new_file_name;
        } else {
            $file_musik = $old_file_musik;
        }
    } else {
        $file_musik = $old_file_musik;
    }

    $stmt = $conn->prepare("UPDATE musik 
                            SET judul_musik = ?, id_artis = ?, id_album = ?, genre = ?, durasi = ?, file_musik = ? 
                            WHERE id_musik = ?");
    $stmt->bind_param("siisssi", $judul_musik, $id_artis, $id_album, $genre, $durasi, $file_musik, $id_musik);

    if ($stmt->execute()) {
        // Tambahkan riwayat aktivitas
        $aksi = "Mengubah data lagu dengan ID $id_musik (Judul: $judul_musik)";
        $stmt_history = $conn->prepare("INSERT INTO history (aksi) VALUES (?)");
        $stmt_history->bind_param("s", $aksi);
        $stmt_history->execute();
        $stmt_history->close();

        // Redirect dengan pesan sukses
        header("Location: musik.php?success=Lagu berhasil diperbarui");
        exit;
    } else {
        echo "Error saat memperbarui data.";
    }
} else {
    // Tampilkan form
    $id_musik = intval($_GET['id_musik']);
    $stmt = $conn->prepare("SELECT * FROM musik WHERE id_musik = ?");
    $stmt->bind_param("i", $id_musik);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Lagu tidak ditemukan.";
        exit;
    }

    $musik = $result->fetch_assoc();
    $stmt->close();

    $data_artis = $conn->query("SELECT * FROM artis")->fetch_all(MYSQLI_ASSOC);
    $data_album = $conn->query("SELECT * FROM album")->fetch_all(MYSQLI_ASSOC);

    $genres = ["Pop", "Rock", "Jazz", "Hip-hop", "Classical", "Country", "Electronic"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Lagu</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            padding: 20px;
        }

        .form-container {
            background-color: #181818;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
            color: #1db954;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #282828;
            color: #ffffff;
        }

        .form-buttons {
            display: flex;
            gap: 10px;
        }

        .submit-btn, .cancel-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .submit-btn {
            background: linear-gradient(45deg, #1db954, #1aa34a);
        }

        .submit-btn:hover {
            background: linear-gradient(45deg, #1aa34a, #178e3e);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            transform: translateY(-2px);
        }

        .cancel-btn {
            background: linear-gradient(45deg, #f44336, #d32f2f);
        }

        .cancel-btn:hover {
            background: linear-gradient(45deg, #d32f2f, #b71c1c);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Ubah Lagu</h1>
        <form action="ubah_lagu.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_musik" value="<?= $musik['id_musik']; ?>">
            <input type="text" name="judul_musik" placeholder="Judul Lagu" value="<?= htmlspecialchars($musik['judul_musik']); ?>" required>
            <select name="id_artis" required>
                <option value="">Pilih Artis</option>
                <?php foreach ($data_artis as $artis): ?>
                    <option value="<?= $artis['id_artis']; ?>" <?= $artis['id_artis'] == $musik['id_artis'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($artis['nama_artis']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="id_album" required>
                <option value="">Pilih Album</option>
                <?php foreach ($data_album as $album): ?>
                    <option value="<?= $album['id_album']; ?>" <?= $album['id_album'] == $musik['id_album'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($album['nama_album']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="genre" required>
                <option value="">Pilih Genre</option>
                <?php foreach ($genres as $available_genre): ?>
                    <option value="<?= $available_genre; ?>" <?= $available_genre == $musik['genre'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($available_genre); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="durasi" placeholder="Durasi" value="<?= htmlspecialchars($musik['durasi']); ?>" required>
            <input type="file" name="file_musik" accept="audio/*">
            <div class="form-buttons">
                <button type="submit" class="submit-btn">Simpan Perubahan</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='musik.php'">Batal</button>
            </div>
        </form>
    </div>
</body>

<script>
    // Cek apakah URL mengandung parameter success
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('success');

    if (successMessage) {
        alert(successMessage); // Menampilkan pesan sukses
        // Hapus parameter success dari URL setelah alert
        const cleanUrl = window.location.href.split('?')[0];
        window.history.replaceState(null, null, cleanUrl);
    }
</script>

</html>
<?php
}
?>
