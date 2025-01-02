<?php
session_start();

if (!isset($_SESSION['token'])) {
    header("Location: ../../auth/login.php");
    exit();
}

require 'config.php';

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Ambil ID terakhir
$result = $conn->query("SELECT MAX(id_album) AS last_id FROM album");
$last_id = 0;

if ($result && $row = $result->fetch_assoc()) {
    $last_id = $row['last_id'];
}

$new_id = $last_id + 1;  // ID baru adalah ID terakhir + 1

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_album'], $_POST['nama_album'], $_POST['id_artis'], $_FILES['gambar_sampul'])) {
        $id_album = (int)$_POST['id_album'];
        $nama_album = htmlspecialchars($_POST['nama_album'], ENT_QUOTES, 'UTF-8');
        $id_artis = (int)$_POST['id_artis'];

        if ($id_album < 1) {
            echo "ID Album harus berupa angka positif.";
            exit;
        }

        $gambar_sampul = $_FILES['gambar_sampul'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($gambar_sampul['type'], $allowedTypes)) {
            echo "File yang diunggah harus berupa gambar (JPEG, PNG, GIF).";
            exit;
        }

        if ($gambar_sampul['size'] > 5 * 1024 * 1024) {
            echo "Ukuran file terlalu besar. Maksimal 5MB.";
            exit;
        }

        if ($gambar_sampul['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($gambar_sampul['tmp_name']);

            $stmt = $conn->prepare("INSERT INTO album (id_album, nama_album, id_artis, gambar_sampul) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isis", $id_album, $nama_album, $id_artis, $imageData);

            if ($stmt->execute()) {
                $log_stmt = $conn->prepare("INSERT INTO history (aksi) VALUES (?)");
                $aksi = "Album dengan ID $id_album dan nama $nama_album ditambahkan oleh artis dengan ID $id_artis";
                $log_stmt->bind_param("s", $aksi);
                $log_stmt->execute();
                $log_stmt->close();

                $_SESSION['message'] = 'Album berhasil ditambahkan!';
                $_SESSION['message_type'] = 'add';
                header("Location: Album.php");
                exit;
            } else {
                echo "Gagal menambahkan data: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Harap isi semua field.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Album</title>

    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: #181818;
            padding: 25px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        .form-container h1 {
            margin-bottom: 15px;
            text-align: center;
            color: #1db954;
            font-size: 24px;
        }

        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: none;
            border-radius: 5px;
            background-color: #282828;
            color: #ffffff;
            font-size: 14px;
        }

        .form-buttons {
            display: flex;
            gap: 8px;
        }

        .submit-btn,
        .cancel-btn {
            flex: 1;
            padding: 10px;
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
        <h1>Tambah Album</h1>
        <form action="tambah_album.php" method="POST" enctype="multipart/form-data">
            <input type="number" name="id_album" placeholder="ID Album" value="<?= htmlspecialchars($new_id); ?>" readonly required>
            <input type="text" name="nama_album" placeholder="Nama Album" required>
            <select name="id_artis" required>
                <option value="">Pilih Artis</option>
                <?php
                // Fetch artists from the database
                $artists = $conn->query("SELECT id_artis, nama_artis FROM artis");
                while ($artist = $artists->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($artist['id_artis']) . '">' . htmlspecialchars($artist['nama_artis']) . '</option>';
                }
                ?>
            </select>
            <input type="file" name="gambar_sampul" accept="image/*" required>
            <div class="form-buttons">
                <button type="submit" class="submit-btn">Tambah Album</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='Album.php'">Batal</button>
            </div>
        </form>
    </div>
</body>

</html>
