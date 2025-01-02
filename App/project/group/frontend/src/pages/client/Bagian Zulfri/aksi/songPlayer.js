// Function to handle card click
function handleCardClick(title, artist, coverImage, filePath, musicId) {

    // Update music_of_the_week in the database
    updateMusicOfTheWeek(musicId);
    // Play the selected music
    showMusicCard(title, artist, coverImage, filePath);
    console.log(filePath);
}

// Function to update music_of_the_week
function updateMusicOfTheWeek(musicId) {
    fetch(`${BASE_PATH}/update_music.php`, {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify({
        id: musicId
        }),
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
function showMusicCard(title, artist, imageSrc, audioSrc) {
    document.getElementById('musicCardTitle').textContent = title;
    document.getElementById('musicCardArtist').textContent = artist;
    document.getElementById('musicCardImage').src = imageSrc;

    const audioPlayer = document.getElementById('audioPlayer');
    audioPlayer.querySelector('source').src = audioSrc;
    audioPlayer.load();
    audioPlayer.play();

    document.getElementById('musicCard').classList.add('active');
    document.getElementById('showButton').style.display = 'none';
}

function hideMusicCard() {
    document.getElementById('musicCard').classList.remove('active');
    document.getElementById('showButton').style.display = 'block';
}

function closeMusicCard() {
    const audioPlayer = document.getElementById('audioPlayer');
    document.getElementById('musicCard').classList.remove('active');
    audioPlayer.pause();
    audioPlayer.currentTime = 0;
    document.getElementById('showButton').style.display = 'block';
}

function showMusicCardAgain() {
    document.getElementById('musicCard').classList.add('active');
    document.getElementById('showButton').style.display = 'none';
}