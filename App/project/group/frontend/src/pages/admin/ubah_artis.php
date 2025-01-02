<?php
require 'config.php';

// Ambil ID artis dari query string
$id_artis = isset($_GET['id_artis']) ? intval($_GET['id_artis']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_artis = trim($_POST["nama_artis"]);
    $biodata_artis = trim($_POST["biodata_artis"]);
    $foto_artis = $_FILES["foto_artis"];

    // Validasi data
    if (empty($nama_artis) || empty($biodata_artis)) {
        echo "Semua field harus diisi!";
        exit;
    }

    // Cek jika ada gambar baru
    if (!empty($foto_artis["name"])) {
        // Validasi tipe dan ukuran file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($foto_artis['type'], $allowedTypes)) {
            echo "Hanya file gambar yang diperbolehkan!";
            exit;
        }
        if ($foto_artis['size'] > 5 * 1024 * 1024) { // 5MB
            echo "Ukuran file terlalu besar!";
            exit;
        }

        // Baca file gambar
        $gambar = file_get_contents($foto_artis["tmp_name"]);

        // Siapkan pernyataan untuk memperbarui data
        $stmt = $conn->prepare("UPDATE artis SET nama_artis = ?, biodata_artis = ?, foto_artis = ? WHERE id_artis = ?");
        $stmt->bind_param("sssi", $nama_artis, $biodata_artis, $gambar, $id_artis);
    } else {
        // Siapkan pernyataan tanpa mengubah gambar
        $stmt = $conn->prepare("UPDATE artis SET nama_artis = ?, biodata_artis = ? WHERE id_artis = ?");
        $stmt->bind_param("ssi", $nama_artis, $biodata_artis, $id_artis);
    }

    // Eksekusi pernyataan
    if ($stmt->execute()) {
        // Catat aksi ke history
        $aksi = "Memperbarui data artis dengan ID $id_artis";
        $stmt_history = $conn->prepare("INSERT INTO history (aksi) VALUES (?)");
        $stmt_history->bind_param("s", $aksi);
        $stmt_history->execute();
        $stmt_history->close();

        echo "Artis berhasil diperbarui!";
        // Redirect ke halaman artis
        header("Location: artist.php");
        exit;
    } else {
        echo "Gagal memperbarui artis: " . $stmt->error;
    }

    // Tutup pernyataan
    $stmt->close();
} else {
    // Ambil data artis untuk ditampilkan
    $stmt = $conn->prepare("SELECT * FROM artis WHERE id_artis = ?");
    $stmt->bind_param("i", $id_artis);
    $stmt->execute();
    $result = $stmt->get_result();
    $artis = $result->fetch_assoc();

    if (!$artis) {
        echo "Artis tidak ditemukan!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Artis</title>
    
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
        .form-container textarea {
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

        .form-container img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Ubah Artis</h1>
        <form action="ubah_artis.php?id_artis=<?= $id_artis; ?>" method="post" enctype="multipart/form-data">
            <input type="text" name="nama_artis" placeholder="Nama Artis" value="<?= htmlspecialchars($artis['nama_artis']); ?>" required>
            <textarea name="biodata_artis" placeholder="Biodata Artis" required><?= htmlspecialchars($artis['biodata_artis']); ?></textarea>
            <input type="file" name="foto_artis" accept="image/*">
            <img src="data:image/jpeg;base64,<?= base64_encode($artis['foto_artis']); ?>" alt="Foto Artis">
            <div class="form-buttons">
                <button type="submit" class="submit-btn">Simpan Perubahan</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='artist.php'">Batal</button>
            </div>
        </form>
    </div>
</body>

</html>
