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

// Ambil ID terakhir dari tabel musik
$result = $conn->query("SELECT MAX(id_musik) AS last_id FROM musik");
$last_id = 0;

if ($result && $row = $result->fetch_assoc()) {
    $last_id = $row['last_id'];
}

$new_id = $last_id + 1; // ID baru adalah ID terakhir + 1

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_musik'], $_POST['id_artis'], $_POST['id_album'], $_POST['genre'], $_POST['durasi'], $_POST['judul_musik'], $_FILES['file_musik'])) {
        $id_musik = (int)$_POST['id_musik'];
        $id_artis = (int)$_POST['id_artis'];
        $id_album = (int)$_POST['id_album'];
        $genre = htmlspecialchars($_POST['genre'], ENT_QUOTES, 'UTF-8');
        $durasi = htmlspecialchars($_POST['durasi'], ENT_QUOTES, 'UTF-8');
        $judul_musik = htmlspecialchars($_POST['judul_musik'], ENT_QUOTES, 'UTF-8');

        // Ambil nama file musik
        $file_musik = $_FILES['file_musik'];
        $allowedTypes = ['audio/mpeg', 'audio/wav', 'audio/ogg', 'audio/mp3'];

        if (!in_array($file_musik['type'], $allowedTypes)) {
            echo "File yang diunggah harus berupa format audio (MP3, WAV, OGG).";
            exit;
        }

        if ($file_musik['size'] > 20 * 1024 * 1024) {
            echo "Ukuran file terlalu besar. Maksimal 20MB.";
            exit;
        }

        if ($file_musik['error'] === UPLOAD_ERR_OK) {
            $fileExtension = pathinfo($file_musik['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid("musik-", true) . '.' . $fileExtension;
            $fileUploadPath = 'uploads/lagu/' . $newFileName;

            if (move_uploaded_file($file_musik['tmp_name'], $fileUploadPath)) {
                // Proses penyimpanan ke database
                $stmt = $conn->prepare("INSERT INTO musik (id_musik, judul_musik, id_artis, id_album, genre, durasi, file_musik) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issssss", $id_musik, $judul_musik, $id_artis, $id_album, $genre, $durasi, $newFileName);

                if ($stmt->execute()) {
                    $log_stmt = $conn->prepare("INSERT INTO history (aksi) VALUES (?)");
                    $aksi = "Lagu dengan ID $id_musik dan judul $judul_musik ditambahkan.";
                    $log_stmt->bind_param("s", $aksi);
                    $log_stmt->execute();
                    $log_stmt->close();

                    $_SESSION['message'] = 'Lagu berhasil ditambahkan!';
                    $_SESSION['message_type'] = 'add';
                    header("Location: musik.php");
                    exit;
                } else {
                    echo "Gagal menambahkan data: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error saat mengunggah file.";
            }
        } else {
            echo "Error saat mengunggah file.";
        }
    } else {
        echo "Harap isi semua field.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lagu</title>
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
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Tambah Lagu</h1>
        <form action="tambah_lagu.php" method="POST" enctype="multipart/form-data">
            <input type="number" name="id_musik" placeholder="ID Musik" value="<?= htmlspecialchars($new_id); ?>" readonly required>
            <input type="text" name="judul_musik" placeholder="Judul Musik" required>
            <input type="text" name="durasi" id="durasi" placeholder="Durasi (MM:SS)" pattern="\d{2}:\d{2}" title="Gunakan format MM:SS" required readonly>
            <select name="id_artis" required>
                <option value="">Pilih Artis</option>
                <?php
                $artists = $conn->query("SELECT id_artis, nama_artis FROM artis");
                while ($artist = $artists->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($artist['id_artis']) . '">' . htmlspecialchars($artist['nama_artis']) . '</option>';
                }
                ?>
            </select>
            <select name="id_album" required>
                <option value="">Pilih Album</option>
                <?php
                $albums = $conn->query("SELECT id_album, nama_album FROM album");
                while ($album = $albums->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($album['id_album']) . '">' . htmlspecialchars($album['nama_album']) . '</option>';
                }
                ?>
            </select>
            <select name="genre" required>
                <option value="">Pilih Genre</option>
                <?php
                $genres = ['Pop', 'Rock', 'Jazz', 'Hip-Hop', 'Classical', 'Reggae', 'Blues', 'Country', 'RnB', 'Punk', 'K-pop'];
                foreach ($genres as $genre) {
                    echo '<option value="' . htmlspecialchars($genre) . '">' . htmlspecialchars($genre) . '</option>';
                }
                ?>
            </select>
            <input type="file" name="file_musik" accept="audio/*" required id="file_musik">
            <div class="form-buttons">
                <button type="submit" class="submit-btn">Tambah Lagu</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='musik.php'">Batal</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('file_musik').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('audio')) {
                const audio = new Audio(URL.createObjectURL(file));
                audio.addEventListener('loadedmetadata', function() {
                    // Ambil durasi lagu
                    const durasi = audio.duration;
                    const menit = Math.floor(durasi / 60);
                    const detik = Math.floor(durasi % 60);
                    const durasiLagu = `${menit}:${detik < 10 ? '0' : ''}${detik}`;

                    // Update durasi input field
                    document.getElementById('durasi').value = durasiLagu;

                    // Ambil nama file tanpa ekstensi untuk judul musik
                    const namaFile = file.name.split('.')[0]; // Ambil nama file tanpa ekstensi

                    // Update judul musik input field
                    document.querySelector('input[name="judul_musik"]').value = namaFile;
                });
            }
        });
    </script>
</body>

</html>