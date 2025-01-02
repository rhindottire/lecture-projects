    <div id="editPlaylistPopup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Edit Playlist</h2>
            <form id="editPlaylistForm" action="./aksi/editPL.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="playlist_id" value="<?= $playlist[0]['id'] ?>">
                <div class="form-group">
                    <label for="edit_playlist_name">Nama Playlist</label>
                    <input type="text" id="edit_playlist_name" name="edit_playlist_name" value="<?= htmlspecialchars($playlist[0]['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="edit_cover_playlist">Upload Cover Playlist</label>
                    <input type="file" id="edit_cover_playlist" name="edit_cover_playlist" accept="image/*">
                    <div class="image-preview">
                        <img id="previewImage" alt="Preview" />
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-button" name="submit-button">Simpan Perubahan</button>
                    <button type="button" class="cancel-button" onclick="closePopup()">Batal</button>
                </div>
            </form>
        </div>
    </div>