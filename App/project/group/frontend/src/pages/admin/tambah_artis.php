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
$result = $conn->query("SELECT MAX(id_artis) AS last_id FROM artis");
$last_id = 0;

if ($result && $row = $result->fetch_assoc()) {
    $last_id = $row['last_id'];
}

$new_id = $last_id + 1;  // ID baru adalah ID terakhir + 1

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_artis'], $_POST['nama_artis'], $_POST['biodata_artis'], $_FILES['foto_artis'])) {
        $id_artis = (int)$_POST['id_artis'];
        $nama_artis = htmlspecialchars($_POST['nama_artis'], ENT_QUOTES, 'UTF-8');
        $biodata_artis = htmlspecialchars($_POST['biodata_artis'], ENT_QUOTES, 'UTF-8');

        if ($id_artis < 1) {
            $_SESSION['error_message'] = "ID Artis Harus Berupa Angka Positif.";
            header("Location: tambah_artis.php");
            exit;
        }

        // Cek apakah ID artis sudah ada
        $result = $conn->query("SELECT id_artis FROM artis WHERE id_artis = $id_artis");
        if ($result->num_rows > 0) {
            $_SESSION['error_message'] = "ID Artis Sudah Digunakan.";
            header("Location: tambah_artis.php");
            exit;
        }

        // Cek apakah nama artis sudah ada
        $result = $conn->query("SELECT id_artis FROM artis WHERE nama_artis = '$nama_artis'");
        if ($result->num_rows > 0) {
            $_SESSION['error_message'] = "Nama Artis Sudah Digunakan.";
            header("Location: tambah_artis.php");
            exit;
        }

        $foto_artis = $_FILES['foto_artis'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        // Cek apakah file yang diunggah adalah gambar
        if (!in_array($foto_artis['type'], $allowedTypes)) {
            $_SESSION['error_message'] = "File yang diunggah harus berupa gambar (JPEG, PNG, GIF).";
            header("Location: tambah_artis.php");
            exit;
        }

        if ($foto_artis['size'] > 2 * 1024 * 1024) { // Maksimal 2MB
            $_SESSION['error_message'] = "Ukuran file terlalu besar. Maksimal 2MB.";
            header("Location: tambah_artis.php");
            exit;
        }

        if ($foto_artis['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($foto_artis['tmp_name']);

            $stmt = $conn->prepare("INSERT INTO artis (id_artis, nama_artis, biodata_artis, foto_artis) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $id_artis, $nama_artis, $biodata_artis, $imageData);

            if ($stmt->execute()) {
                $log_stmt = $conn->prepare("INSERT INTO history (aksi) VALUES (?)");
                $aksi = "Artis dengan ID $id_artis dan nama $nama_artis ditambahkan";
                $log_stmt->bind_param("s", $aksi);
                $log_stmt->execute();
                $log_stmt->close();

                // Set session untuk menampilkan alert setelah redirect
                $_SESSION['message'] = 'Artis Berhasil Ditambahkan!';
                $_SESSION['message_type'] = 'add'; // Menambahkan tipe pesan
                header("Location: artist.php");
                exit;
            } else {
                $_SESSION['error_message'] = "Gagal menambahkan data: " . $stmt->error;
                header("Location: tambah_artis.php");
                exit;
            }
            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Error uploading file.";
            header("Location: tambah_artis.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Harap isi semua field.";
        header("Location: tambah_artis.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artis</title>

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
        .form-container textarea {
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

        /* Modal Style */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #121212;
            color: #000000;
            padding: 30px;
            border-radius: 15px;
            width: 450px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .modal-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #1db954;
            font-weight: bold;
        }

        .modal-content p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #1db954;
        }

        .close {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #ffffff;
            color: #f44336;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .close:hover {
            background-color: #f44336;
            color: white;
            transform: scale(1.05);
        }
    </style>

    <script>
        window.onload = function() {
            <?php
            if (isset($_SESSION['error_message'])) {
                echo 'document.getElementById("errorModal").style.display = "flex";';
                echo 'document.getElementById("errorMessage").innerText = "' . $_SESSION['error_message'] . '";';
                unset($_SESSION['error_message']); // Hapus pesan setelah ditampilkan
            }
            ?>

            // Close the modal when the user clicks on <span> (x)
            document.getElementsByClassName("close")[0].onclick = function() {
                document.getElementById("errorModal").style.display = "none";
            }

            // Close the modal if the user clicks anywhere outside of the modal
            window.onclick = function(event) {
                if (event.target == document.getElementById("errorModal")) {
                    document.getElementById("errorModal").style.display = "none";
                }
            }
        }
    </script>
</head>

<body>
    <div class="form-container">
        <h1>Tambah Artis</h1>

        <form method="POST" enctype="multipart/form-data">
            <input type="number" name="id_artis" value="<?= $new_id ?>" readonly><br>
            <input type="text" name="nama_artis" placeholder="Nama Artis" required><br>
            <textarea name="biodata_artis" placeholder="Biodata Artis" required></textarea><br>
            <input type="file" name="foto_artis" accept="image/*" required><br>
            <div class="form-buttons">
                <button type="submit" class="submit-btn">Tambah</button>
                <a href="artist.php" class="cancel-btn">Batal</a>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <h2>Pesan Kesalahan</h2>
            <p id="errorMessage"></p>
            <button class="close">Tutup</button>
        </div>
    </div>
</body>

</html>