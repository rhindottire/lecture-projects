<div id="deletePlaylistPopup" class="popup-container">
    <div class="popup-box">
        <span class="popup-close-btn" onclick="closeDeletePopup()">&times;</span>
        <h2>Hapus Playlist</h2>
        <p>Apakah Anda yakin ingin menghapus playlist ini?</p>
        <form action="./aksi/hapusPL.php" method="POST">
            <input type="hidden" name="playlist_id" value="<?= $playlistID; ?>">
            <div class="popup-actions">
                <button type="submit" class="action-confirm-btn" name="hapus-playlist">Hapus</button>
                <button type="button" class="action-cancel-btn" onclick="closeDeletePopup()">Batal</button>
            </div>
        </form>
    </div>
</div>