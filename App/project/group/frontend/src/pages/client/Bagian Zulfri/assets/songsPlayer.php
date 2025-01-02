<?php

// Query untuk mendapatkan Music of the Week
// $music_of_the_week = query("
//     SELECT
//         m.id_musik,
//         m.file_musik,
//         m.judul_musik, 
//         a.nama_album, 
//         ar.foto_artis AS cover_image, 
//         ar.nama_artis AS artist_name,
//         m.music_of_the_week
//     FROM musik m
//     JOIN album a ON m.id_album = a.id_album
//     JOIN artis ar ON a.id_artis = ar.id_artis
//     ORDER BY m.music_of_the_week DESC
//     LIMIT 15");
?>
    <!-- Kontainer Musik -->
    <div class="music-card-container" id="musicCard">
      <img src="" alt="Album Cover" id="musicCardImage" style="aspect-ratio: 1/1; object-fit: cover;">
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
