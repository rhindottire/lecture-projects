<?php
session_start();

require_once __DIR__ . "/../../templates/header.php";
headerTemplates("Dashboard");

require_once __DIR__ . "/../../templates/footer.php";

require_once __DIR__ . "/../../api/client.php";
$client = getClientDetails($_SESSION['token'])['data'];

// var_dump($client);
?>
<script>
//   console.log($client);
</script>
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
LIMIT 5
";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemutar Musik</title>
    <!-- Memuat CSS Bootstrap dari CDN -->
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <!-- Memuat Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <!-- <link rel="stylesheet" href="landingPage.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
  <style>
    /* Gaya dasar untuk body */
body {
    background-color: #121212; /* Warna latar belakang gelap */
    color: white; /* Warna teks putih */
    font-family: Arial, sans-serif; /* Font yang digunakan */
}
.background_search{
    width: 1500px; /* Lebar sidebar */
    background-color: #000; /* Warna latar belakang hitam */
    height: 15vh; /* Tinggi 100% viewport */
    position: fixed; /* Posisi tetap */
    top: 0;
    left: 10;
    display: flex;
    flex-direction: column; /* Susunan vertikal */
    align-items: center; /* Posisikan ikon di tengah */
    padding-top: 20px; /* Padding atas */
    z-index: 1; /* Agar selalu di atas elemen lain */
}
/* Gaya untuk bilah pencarian */
.search-bar {
    display: flex;
    align-items: center;
    background-color: #333; /* Warna latar belakang abu-abu gelap */
    padding: 10px;
    border-radius: 20px; /* Sudut membulat */
    position: fixed; /* Posisi tetap */
    top: 20px;
    left: 100px;
    right: 20px;
    z-index: 1; /* Agar selalu di atas elemen lain */
}

.search-bar input {
    background: none;
    border: none;
    color: white;
    outline: none;
    width: 100%;
    margin-left: 10px;
}

/* Gaya untuk input di bilah pencarian */
.search-bar input {
    background: none; /* Tanpa latar belakang */
    border: none; /* Tanpa border */
    color: white; /* Warna teks putih */
    outline: none; /* Tanpa outline saat fokus */
    width: 100%;
    margin-left: 10px;
}
/* Gaya untuk ikon pencarian */
.search-bar i {
    color: white;
}

.search-results {
position: absolute; /* Tetap di layar meskipun halaman digulir */
top: 10%; /* Posisikan di tengah layar secara vertikal */
left: 31%; /* Posisikan di tengah layar secara horizontal */
transform: translate(-50%, -0%); /* Pusatkan elemen secara sempurna */
width: 50%; /* Lebar elemen */
background-color: #1e1e1e; /* Warna latar belakang */
border-radius: 10px; /* Sudut membulat */
padding: 10px; /* Ruang di dalam elemen */
z-index: 1000; /* Pastikan elemen berada di atas konten lainnya */
box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Tambahkan bayangan untuk efek melayang */
}


.search-results .result-item {
display: flex;
align-items: center;
padding: 10px;
border-bottom: 1px solid #333;
cursor: pointer;
}

.search-results .result-item:last-child {
border-bottom: none;
}

.search-results img {
width: 40px;
height: 40px;
border-radius: 50%;
margin-right: 10px;
}

.search-results .details {
display: flex;
flex-direction: column;
}

.search-results .details .song-title {
font-size: 16px;
font-weight: bold;
}

.search-results .details .artist-name {
font-size: 14px;
color: #aaa;
}
/* Gaya untuk banner */
/* Container styling */
/* Container styling */
.banner {
    width: 100%;
    height: 350px;
    background-color: #111; /* Background color as fallback */
    border-radius: 15px;
    margin-bottom: 20px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Adding shadow for elegance */
}

/* Styling for images */
.banner img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the image covers the container */
    object-position: bottom; /* Centers the image */
    transition: transform 0.5s ease; /* Smooth zoom effect */
}

.carousel-item img:hover {
    transform: scale(1.05); /* Slight zoom on hover */
}

/* Carousel inner and items */
.carousel-inner {
    height: 100%;
}

.carousel-item {
    height: 100%;
}

/* Styling for carousel controls */
.carousel-control-prev,
.carousel-control-next {
    background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    top: 50%; /* Center vertically */
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    filter: invert(1); /* White color for icons */
}

/* Styling for the sponsored label */
.banner .sponsored {
    position: absolute;
    bottom: 15px;
    right: 15px;
    background: linear-gradient(45deg, rgba(255, 87, 34, 0.8), rgba(255, 165, 0, 0.8));
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}



/* Gaya untuk tombol filter */
.filter-buttons {
    display: flex;
    gap: 10px; /* Jarak antar tombol */
    margin-bottom: 20px;
}
/* Gaya untuk setiap tombol filter */
.filter-buttons button {
    background-color: #333;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 20px; /* Sudut membulat */
    cursor: pointer; /* Pointer saat hover */
}
/* Gaya untuk daftar putar */
.playlist {
    display: flex;
    flex-wrap: wrap; /* Membungkus elemen jika diperlukan */
    gap: 10px; /* Jarak antar item */
}
/* Gaya untuk setiap item dalam daftar putar */
.playlist-item {
    background-color: #333;
    padding: 10px;
    border-radius: 10px;
    width: calc(33.333% - 10px); /* Tiga kolom */
    display: flex;
    align-items: center;
    gap: 10px; /* Jarak antar elemen dalam item */
}
/* Gaya untuk gambar dalam item daftar putar */
.playlist-item img {
    width: 50px;
    height: 50px;
    border-radius: 5px;
}
/* Gaya untuk teks "Lebih banyak seperti ini" */
.more-like {
    margin-top: 20px;
    font-size: 1.2em;
}
/* Gaya untuk bilah pemutaran saat ini */
.now-playing-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #333;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 2;
}
/* Gaya untuk gambar album di bilah pemutaran */
.now-playing-bar img {
    width: 50px;
    height: 50px;
    border-radius: 5px;
}
/* Gaya untuk informasi lagu */
.now-playing-bar .song-info {
    display: flex;
    align-items: center;
    gap: 10px;
}
/* Gaya untuk kontrol pemutaran */
.now-playing-bar .controls {
    display: flex;
    align-items: center;
    gap: 10px;
}
/* Gaya untuk ikon kontrol */
.now-playing-bar .controls i {
    color: white;
    font-size: 1.5em;
    cursor: pointer; /* Pointer saat hover */
}
/* Gaya untuk bilah progres */
.now-playing-bar .progress-bar {
    flex-grow: 1;
    margin: 0 20px;
}
/* Gaya untuk input range pada bilah progres */
.now-playing-bar .progress-bar input {
    width: 100%;
}

/* styling untuk card */
/* styling untuk card */
/* styling untuk card */
/* styling untuk card */
/* styling untuk card */
/* styling untuk card */
/* styling untuk card */
/* styling untuk card */

body {
font-family: 'Roboto', sans-serif;
background-color: black;
margin: 0;
padding: 0;
}
.container {
max-width: 1600px;
margin: 0 auto;
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

.action-buttons {
position: absolute; /* Membuat elemen ini posisinya relatif terhadap container induknya */
top: 20px; /* Jarak dari atas */
right: 20px; /* Jarak dari kanan */
display: flex; /* Mengatur tata letak internal untuk ikon */
gap: 10px; /* Jarak antar ikon */
}

/* Styling untuk ikon di dalam .action-buttons */
.action-buttons i {
font-size: 20px; /* Ukuran ikon */
color: #333; /* Warna default ikon */
cursor: pointer; /* Mengubah kursor saat hover */
transition: color 0.3s ease; /* Animasi transisi warna */
}

/* Efek hover pada ikon */
.action-buttons i:hover {
color: #ff0000; /* Warna ikon saat di-hover */
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
}

.music-card-container .hide-close i {
    color: white;
    font-size: 25px;
    cursor: pointer;
}

.hide-close {
display: flex; /* Gunakan Flexbox */
justify-content: flex-end; /* Rata kiri */
gap: 10px; /* Jarak antar ikon */
}

.hide-close i {
cursor: pointer; /* Pointer cursor saat di hover */
}


.music-card-container.active {
opacity: 1;
transform: translate(-50%, -50%) scale(1);
}

.music-card-container img {
width: 100%;
border-radius: 10px;
}

/* show button */
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
    <?php include 'sidebar.php'; ?>

    <!-- Konten utama halaman -->
    <div class="main-content">
        <!-- Bilah pencarian -->
        <div class="background_search">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search for music..." />
            </div>
        </div>
        
        <div class="search-results" id="searchResults"></div>

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

        <!-- Banner promosi -->
        <div class="banner">
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="gambar/photo-1692796226663-dd49d738f43c.avif" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="gambar/photo-1698711864784-8ffe1a98b6b2.avif" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="gambar/photo-1713785746969-664f9495373f.avif" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <!-- Tombol navigasi untuk carousel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="sponsored">
        Disponsori
    </div>
</div>



    <!-- Bilah pemutaran saat ini -->
    <div class="now-playing-bar" id="nowPlayingBar" style="display: none;">
        <!-- Informasi lagu yang sedang diputar -->
        <div class="song-info">
            <img id="nowPlayingImage" alt="Sampul Album" height="50" src="" width="50"/>
            <div>
                <div id="nowPlayingTitle">Lagu Tidak Diputar</div>
                <div id="nowPlayingArtist">-</div>
            </div>
        </div>
        <!-- Kontrol pemutaran -->
        <div class="controls">
            <i class="fas fa-random" title="Acak"></i>
            <i class="fas fa-step-backward" title="Lewati ke belakang"></i>
            <i class="fas fa-play" id="playPauseButton" title="Mainkan"></i>
            <i class="fas fa-step-forward" title="Lewati ke depan"></i>
            <i class="fas fa-redo" title="Ulangi"></i>
        </div>
        <!-- Bilah progres lagu -->
        <div class="progress-bar">
            <input id="progressBar" max="100" min="0" type="range" value="0"/>
        </div>
        <!-- Waktu lagu -->
        <div id="nowPlayingDuration">0:00</div>
        <!-- Tombol Close -->
        <button id="closeBar" style="font-size: 10px;">Close</button>
        </div>

    <div class="container">
        <div class="section-header">
            <h2>Top Music</h2>
                <a href="musicoftheweek.php">Show all</a>
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
        <div class="action-buttons">
            <i onclick="hideMusicCard()" class="fas fa-minus"></i>
            <i onclick="closeMusicCard()" class="fas fa-times"></i>
        </div>
        <img src="" alt="Album Cover" id="musicCardImage">
        <div class="song-info">
            <h2 id="musicCardTitle">Song Title</h2>
            <p id="musicCardArtist">Artist Name</p>
        </div>
        <audio id="audioPlayer" controls>
            <source src="" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>

        <!-- Tombol untuk memunculkan kembali -->
        <button class="show-button" id="showButton" onclick="showMusicCardAgain()">+</button>


        </div>
      <div class="section-header">
        <h2>Recently played</h2>
        <a href="recently.php">Show all</a>
      </div>
      <div class="grid">
        <div class="card">
          <img
            src="https://storage.googleapis.com/a1aa/image/nWheHWfKbhlOckyDL7smomz8Nv9IAHf4JR126vWkZVy4IggnA.jpg"
            alt="Recently played 1"
          />
          <h3>Chill Mix</h3>
          <p>SZA, Trinidad Cardona, Kali Uchis...</p>
        </div>
        <div class="card">
          <img
            src="https://storage.googleapis.com/a1aa/image/SvOSHIrIZYISMtMPZh3dnn607Qx5Wef6znTo2YxBNvrYEQwTA.jpg"
            alt="Recently played 2"
          />
          <h3>Chill Mix</h3>
          <p>SZA, Trinidad Cardona, Kali Uchis...</p>
        </div>
        <div class="card">
          <img
            src="https://storage.googleapis.com/a1aa/image/Yib9BQdXj5JeJa2SO6nLnHPy1fnw6PW282KbBEF4b5VaEQwTA.jpg"
            alt="Recently played 3"
          />
          <h3>Chill Mix</h3>
          <p>SZA, Trinidad Cardona, Kali Uchis...</p>
        </div>
        <div class="card">
          <img
            src="https://storage.googleapis.com/a1aa/image/yptNGcx2s2bhA5hLnbXpVcobZLmUov1jtNwKVvDwGyGEBE8E.jpg"
            alt="Recently played 4"
          />
          <h3>Chill Mix</h3>
          <p>SZA, Trinidad Cardona, Kali Uchis...</p>
        </div>
        <div class="card">
          <img
            src="https://storage.googleapis.com/a1aa/image/tV7AmNjTcNLICNtc90J2CsyyvcHVAwybpQ6zGJiTAqNFBE8E.jpg"
            alt="Recently played 5"
          />
          <h3>Chill Mix</h3>
          <p>SZA, Trinidad Cardona, Kali Uchis...</p>
        </div>
      </div>
    </div>
    <div class="break">

    </div>
    <!-- Overlay -->
  <div class="overlay" id="overlay"></div>

<!-- Card Musik -->
<!-- <div class="music-card-container" id="musicCard">
  <img src="alexandra/alexandra.jpg" alt="Album Cover">
  <div class="song-info">
    <h2>Alexandra</h2>
    <p>Reality Club</p>
  </div>
  <audio id="audioPlayer" controls>
    <source src="alexandra/Alexandra - Reality Club (Official Lyric Video).mp3" type="audio/mp3">
    Your browser does not support the audio element.
  </audio>
</div> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>

  // Elemen HTML
  const card = document.getElementById('realityClubCard');
  const musicCard = document.getElementById('musicCard');
  const overlay = document.getElementById('overlay');
  const audioPlayer = document.getElementById('audioPlayer');

  document.getElementById('searchInput').addEventListener('input', function () {
            const query = this.value.trim();

            if (query.length > 0) {
                fetch(`search.php?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        const resultsContainer = document.getElementById('searchResults');
                        resultsContainer.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(item => {
                                const resultItem = document.createElement('div');
                                resultItem.classList.add('result-item');
                                resultItem.onclick = () => {
                                    // Panggil fungsi untuk menampilkan music card
                                    showMusicCard(
                                        item.judul_musik,
                                        item.nama_artis,
                                        item.gambar_sampul || 'default-artist.jpg',
                                        `../admin/uploads/lagu/${item.file_musik}`
                                    );

                                    // Panggil fungsi untuk memperbarui music_of_the_week
                                    updateMusicOfTheWeek(item.id_musik); // Pastikan item.id_musik berisi ID musik
                                };


                                const image = document.createElement('img');
                                image.src = item.gambar_sampul || 'default-artist.jpg';
                                image.alt = item.nama_artis || 'Unknown Artist';

                                const details = document.createElement('div');
                                details.classList.add('details');

                                const songTitle = document.createElement('div');
                                songTitle.classList.add('song-title');
                                songTitle.textContent = item.judul_musik;

                                const artistName = document.createElement('div');
                                artistName.classList.add('artist-name');
                                artistName.textContent = item.nama_artis || 'Unknown Artist';

                                details.appendChild(songTitle);
                                details.appendChild(artistName);
                                resultItem.appendChild(image);
                                resultItem.appendChild(details);
                                resultsContainer.appendChild(resultItem);
                            });
                        } else {
                            resultsContainer.textContent = 'No songs found';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('searchResults').innerHTML = '';
            }
        });

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

  // Event listener pada klik card
  card.addEventListener('click', () => {
    overlay.classList.add('active');  // Tampilkan overlay
    musicCard.classList.add('active');  // Tampilkan card musik

    // Mulai memutar audio
    audioPlayer.play().then(() => {
      console.log("Audio berhasil diputar");
    }).catch(error => {
      console.error("Audio gagal diputar. Penyebab:", error);
    });
  });

  // Menangani klik pada overlay untuk menutup card musik
  overlay.addEventListener('click', () => {
    overlay.classList.remove('active');
    musicCard.classList.remove('active');
    audioPlayer.pause();  // Jeda musik
    audioPlayer.currentTime = 0;  // Reset musik ke awal
  });

  function showMusicCard(title, artist, imageSrc, audioSrc) {
    // Update content of the music card
    document.getElementById('musicCardTitle').textContent = title;
    document.getElementById('musicCardArtist').textContent = artist;
    document.getElementById('musicCardImage').src = imageSrc;

    const audioPlayer = document.getElementById('audioPlayer');
    audioPlayer.querySelector('source').src = audioSrc;
    audioPlayer.load(); // Reload the audio source
    audioPlayer.play(); // Automatically play the audio

    // Show the music card
    const musicCard = document.getElementById('musicCard');
    musicCard.classList.add('active'); // Pastikan ini sesuai dengan animasi CSS-mu
}


  
</script>
</body>
</html>





<script type="module">
  const logout = document.querySelector("#logout");
  logout.addEventListener("click", async (e) => {
    e.preventDefault();
    const token = "<?= $_SESSION['token'] ?? ''; ?>";
    // console.log(token);

    if (!token) {
      alert("Token not found.");
      return;
    }
    try {
      const response = await axios.patch("http://localhost:3000/api/client/logout", {}, {
        headers: {
          'X-API-TOKEN': `${token}`
        }
      }).then(data => data.data);
      // console.log(response);

      if (response.status === 201) {
        // alert(response.message);
        Swal.fire({
          icon: "success",
          title: response.message,
        })
        setTimeout(() => {
          window.location.replace("http://abogoboga.test:8000/frontend/src/auth/destroy-token.php");
        }, 2000);
      }
    } catch (error) {
      // console.log("Error:", error);
      Swal.fire({
        icon: "error",
        title: "Error",
        text: error.response.data.errors,
      })
    }
  });
</script>

<?php footerTemplates(); ?>