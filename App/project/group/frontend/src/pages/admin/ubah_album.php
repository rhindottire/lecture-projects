<?php
require 'config.php';

// Ambil ID album dari query string jika metode adalah GET
$id_album = isset($_GET['id_album']) ? intval($_GET['id_album']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_album = intval($_POST['id_album']);
    $nama_album = trim($_POST['nama_album']);
    $id_artis = intval($_POST['id_artis']);
    $gambar_sampul = $_FILES["gambar_sampul"];

    // Validasi data
    if (empty($nama_album) || empty($id_artis)) {
        echo "Nama Album dan Artis harus diisi!";
        exit;
    }

    // Cek jika ada gambar sampul baru
    if (!empty($gambar_sampul["name"])) {
        // Validasi tipe dan ukuran file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($gambar_sampul['type'], $allowedTypes)) {
            echo "Hanya file gambar yang diperbolehkan!";
            exit;
        }
        if ($gambar_sampul['size'] > 5 * 1024 * 1024) { // Maksimal 5MB
            echo "Ukuran file terlalu besar!";
            exit;
        }

        // Baca file gambar
        $gambar = file_get_contents($gambar_sampul["tmp_name"]);

        // Siapkan pernyataan untuk memperbarui data dengan gambar sampul baru
        $stmt = $conn->prepare("UPDATE album SET nama_album = ?, id_artis = ?, gambar_sampul = ? WHERE id_album = ?");
        $stmt->bind_param("sisi", $nama_album, $id_artis, $gambar, $id_album);
    } else {
        // Siapkan pernyataan tanpa mengubah gambar sampul
        $stmt = $conn->prepare("UPDATE album SET nama_album = ?, id_artis = ? WHERE id_album = ?");
        $stmt->bind_param("sii", $nama_album, $id_artis, $id_album);
    }

    // Eksekusi pernyataan
    if ($stmt->execute()) {
        // Catat perubahan di tabel history
        $aksi = "Album dengan ID $id_album diubah menjadi '$nama_album' oleh artis dengan ID $id_artis";
        $log_stmt = $conn->prepare("INSERT INTO history (aksi) VALUES (?)");
        $log_stmt->bind_param("s", $aksi);
        $log_stmt->execute();
        $log_stmt->close();

        // Redirect ke dashboard
        header("Location: album.php");
        exit;
    } else {
        echo "Gagal memperbarui album: " . $stmt->error;
    }

    // Tutup pernyataan
    $stmt->close();
    $conn->close();
} else {
    // Ambil data album untuk ditampilkan
    $stmt = $conn->prepare("SELECT * FROM album WHERE id_album = ?");
    $stmt->bind_param("i", $id_album);
    $stmt->execute();
    $result = $stmt->get_result();
    $album = $result->fetch_assoc();

    // Jika album tidak ditemukan
    if (!$album) {
        echo "Album tidak ditemukan!";
        exit;
    }

    // Ambil data artis untuk dropdown
    $result_artis = $conn->query("SELECT * FROM artis");
    $data_artis = $result_artis->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Album</title>
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
            border-radius: 5px;
            width: 400px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
            color: #1db954;
        }

        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #282828;
            color: #ffffff;
        }

        .form-buttons {
            display: flex;
            gap: 10px;
        }

        .submit-btn,
        .cancel-btn {
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
        }

        .cancel-btn {
            background: linear-gradient(45deg, #f44336, #d32f2f);
        }

        .cancel-btn:hover {
            background: linear-gradient(45deg, #d32f2f, #b71c1c);
        }

        .form-container img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Ubah Album</h1>
        <form action="ubah_album.php?id_album=<?= $id_album; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_album" value="<?= $album['id_album']; ?>">
            <input type="text" name="nama_album" placeholder="Nama Album" value="<?= htmlspecialchars($album['nama_album']); ?>" required>
            <select name="id_artis" required>
                <option value="">Pilih Artis</option>
                <?php foreach ($data_artis as $artis): ?>
                    <option value="<?= $artis['id_artis']; ?>" <?= $artis['id_artis'] == $album['id_artis'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($artis['nama_artis']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="file" name="gambar_sampul" accept="image/*">
            <img src="data:image/jpeg;base64,<?= base64_encode($album['gambar_sampul']); ?>" alt="Cover Album">
            <div class="form-buttons">
                <button type="submit" class="submit-btn">Simpan Perubahan</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='album.php'">Batal</button>
            </div>
        </form>
    </div>
</body>

</html>

