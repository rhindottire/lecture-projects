<?php
include "./aksi/koneksi.php";

if (isset($_POST['submit-button'])) {
    // Tangkap data dari form
    $nama_playlist = $_POST['nama_playlist'];
    $created_at = date('Y-m-d');
    $cover_playlist = null;
    $id_client = $client['id'];
    // Periksa apakah file diunggah
    if (isset($_FILES['cover_playlist']) && $_FILES['cover_playlist']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['cover_playlist']['tmp_name'];
        $fileData = file_get_contents($fileTmpPath); // Baca file sebagai binary
        $cover_playlist = mysqli_real_escape_string($conn, $fileData); // Escape data binary
    } else {
        echo "File cover tidak valid atau tidak diunggah.";
        exit();
    }

    $sql = "INSERT INTO playlists (name, cover_playlist, created_at,user_id) 
            VALUES ('$nama_playlist', '$cover_playlist', '$created_at',$id_client)";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Playlist berhasil ditambahkan!'); window.location.href='index.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Playlist</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #FFFFFF;
        }

        .form-container {
            background-color: #181818;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            color: #FFFFFF;
            max-width: 600px;
            margin: auto;
            margin-top: 30px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: #FFFFFF;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
            color: #B3B3B3;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #333333;
            border-radius: 5px;
            background-color: #333333;
            color: #FFFFFF;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease-in-out;
        }

        .form-group input:focus {
            border-color: #0ea5e9;
        }

        /* File Input Styling */
        .form-group input[type="file"] {
            padding: 5px;
            background-color: #222222;
            cursor: pointer;
        }

        .form-group input[type="file"]::-webkit-file-upload-button {
            background-color: #0ea5e9;
            color: #FFFFFF;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .form-group input[type="file"]::-webkit-file-upload-button:hover {
            background-color:rgb(0, 124, 182);
        }

        /* Button Styling */
        .form-actions {
            text-align: center;
        }

        .submit-button {
            background-color: #0ea5e9;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .submit-button:hover {
            background-color:rgb(3, 122, 178);
        }

        .cancel-button {
            background-color: #333333;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s ease-in-out;
        }

        .cancel-button:hover {
            background-color: #444444;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="form-container">
            <h2>Tambah Playlist</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_playlist">Nama Playlist</label>
                    <input type="text" id="nama_playlist" name="nama_playlist" placeholder="Masukkan nama playlist" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="cover_playlist">Upload Cover Playlist</label>
                    <input type="file" id="cover_playlist" name="cover_playlist" accept="image/*" required>
                    <div class="image-preview" id="imagePreview">
                        <img id="previewImage" src="" alt="Preview" style="display:none; width: 250px; height: 250px; object-fit: cover; margin-top: 10px; border-radius: 10px;">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-button" name="submit-button">Tambah Playlist</button>
                    <button type="button" class="cancel-button" onclick="window.location.href='index.php'">Batal</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function previewImage(event) {
                const preview = document.getElementById('previewImage');
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            }

            // Pastikan fungsi previewImage dipanggil setelah dokumen dimuat
            document.getElementById('cover_playlist').addEventListener('change', previewImage);
        });
    </script>

</body>

</html>