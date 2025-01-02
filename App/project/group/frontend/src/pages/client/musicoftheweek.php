<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abogoboga";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan Music of the Week
$sql = "
    SELECT
        m.id_musik AS id,
        m.file_musik AS musik,
        m.judul_musik AS title, 
        a.nama_album AS album_name, 
        a.gambar_sampul AS cover_image, 
        ar.nama_artis AS artist_name,
        m.music_of_the_week
    FROM musik m
    JOIN album a ON m.id_album = a.id_album
    JOIN artis ar ON a.id_artis = ar.id_artis
    ORDER BY m.music_of_the_week DESC
    LIMIT 15
";



$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
        max-width: 1600px;
        margin: 0 auto;
        padding: 16px;
        margin-left: 90px; /* Pastikan konten tidak terhalang sidebar */
        padding: 16px;
      }
      .btn-group {
        display: flex;
        gap: 10px;
        margin-bottom: 24px;
      }
      .btn-group button {
        background-color: #4b5563;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 9999px;
        cursor: pointer;
      }
      .btn-group button:hover {
        background-color: #6b7280;
      }
      .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
      }
      .section-header h2 {
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0;
      }
      .section-header a {
        color: #9ca3af;
        text-decoration: none;
      }
      .section-header a:hover {
        color: white;
      }
      .grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 32px;
      }
      .card {
        background-color: #374151;
        padding: 16px;
        border-radius: 8px;
        text-align: center;
      }
      .card img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 12px;
      }
      .card h3 {
        font-size: 1.2rem;
        font-weight:lighter;
        color: #9ca3af;
        margin: 0;
      }
      .card p {
        color: #9ca3af;
        margin: 8px 0 0;
      }

      .break {
        height: 100px; /* Anda bisa menyesuaikan ukuran sesuai kebutuhan */
        width: 100%; /* Pastikan elemen mengambil seluruh lebar halaman */
        background-color: transparent; /* Transparan untuk memastikan tidak mengganggu desain */
        display: block; /* Pastikan elemen diperlakukan sebagai blok */
      }

      .music-card-container {
    display: none; /* Tersembunyi secara default */
    position: fixed;
    top: 50%;
    right: -40px; /* Mulai di luar layar */
    transform: translateY(-50%);
    width: 300px;
    background-color: white;
    box-shadow: 0 4px 80px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    padding: 15px;
    transition: right 0.3s ease-in-out;
    z-index: 1000;
    }
    

    .music-card-container.active {
        display: block;
        right: 200px; /* Muncul ke dalam layar */
    }

    

    

      /* body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: white;
      overflow: hidden;
    } */
      .card {
      width: 250px;
      margin: 20px auto;
      padding: 10px;
      background-color: #1c1c1c;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
      cursor: pointer;
      transition: transform 0.2s;
    }
    .card:hover {
      transform: scale(1.05);
    }
    .card img {
      width: 100%;
      border-radius: 10px;
    }
    .card h3, .card p {
      margin: 10px 0;
    }

    .music-card-container {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    width: 300px;
    background-color: #1c1c1c;
    border-radius: 10px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.5);
    text-align: center;
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.4s ease, transform 0.4s ease;
    border: 4px solid #ff4500; /* Garis tepi dengan warna mencolok */
    }

    .music-card-container.active {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }

    #musicCardTitle{
        color: #9ca3af;
    }
    #musicCardArtist{
        color: #9ca3af;
    }



        .music-card-container img {
            width: 100%;
            border-radius: 10px;
        }

        .song-info h2, .song-info p {
            margin: 10px 0;
        }

        audio {
            width: 100%;
            margin-top: 10px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }

        .overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .action-buttons {
            margin-top: 10px;
        }

        .action-buttons button {
            background-color: #4b5563;
            color: white;
            border: none;
            padding: 10px 16px;
            margin: 5px;
            border-radius: 9999px;
            cursor: pointer;
        }

        .action-buttons button:hover {
            background-color: #6b7280;
        }

        .show-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: #4b5563;
            color: white;
            border: none;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            display: none; /* Hidden by default */
            z-index: 1001;
            color: black;
        }

        .show-button:hover {
            background-color: #6b7280;
        }
    .music-card-container.active {
      opacity: 1;
      transform: translate(-50%, -50%) scale(1);
    }

    .music-card-container img {
      width: 100%;
      border-radius: 10px;
    }
    .song-info h2, .song-info p {
      margin: 10px 0;
    }
    audio {
      width: 100%;
      margin-top: 10px;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      z-index: 999;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.4s ease;
    }
    .overlay.active {
      opacity: 1;
      pointer-events: all;
    }
    </style>
</head>
<body>
  <?php include 'sidebar.php'; ?>
  <div class="container">
        <div class="section-header">
            <h2>Top Music</h2>
        </div>
        <div class="grid">
    <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cover_image = 'data:image/jpeg;base64,' . base64_encode($row['cover_image']);
                $file_path = '../admin/uploads/lagu/' . htmlspecialchars($row['musik']);
                $id = htmlspecialchars($row['id']); // ID untuk update music_of_the_week

                echo '
                <div class="card" onclick="handleCardClick(
                    \'' . htmlspecialchars($row['title']) . '\', 
                    \'' . htmlspecialchars($row['artist_name']) . '\', 
                    \'' . $cover_image . '\', 
                    \'' . $file_path . '\', 
                    ' . $id . '
                )">
                    <img src="' . $cover_image . '" alt="' . htmlspecialchars($row['title']) . '">
                    <h3>' . htmlspecialchars($row['title']) . '</h3>
                    <p>' . htmlspecialchars($row['artist_name']) . ' - ' . htmlspecialchars($row['album_name']) . '</p>
                </div>';
            }
        } else {
            echo '<p>No top music of the week available.</p>';
        }
    ?>
</div>
        <!-- Kontainer Musik -->
    <div class="music-card-container" id="musicCard">
        <img src="" alt="Album Cover" id="musicCardImage">
        <div class="song-info">
            <h2 id="musicCardTitle">Song Title</h2>
            <p id="musicCardArtist">Artist Name</p>
        </div>
        <audio id="audioPlayer" controls>
            <source src="" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <div class="action-buttons">
            <button onclick="hideMusicCard()">Hide</button>
            <button onclick="closeMusicCard()">Close</button>
        </div>
    </div>

    <!-- Tombol untuk memunculkan kembali -->
    <button class="show-button" id="showButton" onclick="showMusicCardAgain()">+</button>
    </div>
</div>
<script>
        // Function to handle card click
    function handleCardClick(title, artist, coverImage, filePath, musicId) {
        // Update music_of_the_week in the database
        updateMusicOfTheWeek(musicId);

        // Play the selected music
        showMusicCard(title, artist, coverImage, filePath);
    }

    // Function to update music_of_the_week
    function updateMusicOfTheWeek(musicId) {
        // Use fetch to send an asynchronous request to update the database
        fetch('update_music.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: musicId }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Music of the week updated:', data);
        })
        .catch(error => {
            console.error('Error updating music of the week:', error);
        });
    }

    // Function to show and play the selected music
    function showMusicCard(title, artist, coverImage, filePath) {
        // Your existing logic for playing music, e.g., updating UI and audio player
        console.log('Playing music:', { title, artist, coverImage, filePath });
    }


            
        //////////////////////////////////////////
        function showMusicCard(title, artist, imageSrc, audioSrc) {
            // Update konten music card
            document.getElementById('musicCardTitle').textContent = title;
            document.getElementById('musicCardArtist').textContent = artist;
            document.getElementById('musicCardImage').src = imageSrc;
            
            const audioPlayer = document.getElementById('audioPlayer');
            audioPlayer.querySelector('source').src = audioSrc;
            audioPlayer.load(); // Reload audio
            audioPlayer.play(); // Putar audio

            // Tampilkan music card
            const musicCard = document.getElementById('musicCard');
            musicCard.classList.add('active');

            // Sembunyikan tombol "show"
            document.getElementById('showButton').style.display = 'none';
        }

        // Fungsi untuk menyembunyikan music card tanpa menghentikan audio
        function hideMusicCard() {
            const musicCard = document.getElementById('musicCard');
            musicCard.classList.remove('active');

            // Tampilkan tombol kecil untuk memunculkan kembali
            document.getElementById('showButton').style.display = 'block';
        }

        // Fungsi untuk menutup music card dan menghentikan audio
        function closeMusicCard() {
            const musicCard = document.getElementById('musicCard');
            const audioPlayer = document.getElementById('audioPlayer');

            musicCard.classList.remove('active');
            audioPlayer.pause(); // Hentikan audio
            audioPlayer.currentTime = 0; // Reset audio ke awal

            // Tampilkan tombol kecil untuk memunculkan kembali
            document.getElementById('showButton').style.display = 'block';
        }

        // Fungsi untuk memunculkan kembali music card
        function showMusicCardAgain() {
            const musicCard = document.getElementById('musicCard');
            musicCard.classList.add('active');

            // Sembunyikan tombol kecil
            document.getElementById('showButton').style.display = 'none';
        }
    </script>
</body>
</html>
