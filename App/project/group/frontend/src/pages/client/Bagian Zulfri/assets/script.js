// Fungsi modular untuk AJAX Live Search
function sendAjaxRequest(url, params, callback) {
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            callback(xhr.responseText);
        }
    };

    // Gabungkan URL dengan parameter (jika ada)
    const queryString = new URLSearchParams(params).toString();
    xhr.open('GET', `${url}?${queryString}`, true);
    xhr.send();
}

// Fungsi untuk menginisialisasi Live Search
function initLiveSearch(searchBarId, resultsId, searchUrl, additionalParams = {}) {
    const searchBar = document.getElementById(searchBarId);
    const resultsContainer = document.getElementById(resultsId);

    searchBar.addEventListener('keyup', function () {
        const searchTerm = searchBar.value;

        // Tambahkan query ke parameter
        const params = { ...additionalParams, key: searchTerm };

        // Kirim AJAX request
        sendAjaxRequest(searchUrl, params, function (response) {
            resultsContainer.innerHTML = response;
        });
    });
}

// Fungsi untuk membuka popup edit playlist
function openPopup() {
    document.getElementById('editPlaylistPopup').style.display = 'flex';
}

// Fungsi untuk menutup popup edit playlist
function closePopup() {
    document.getElementById('editPlaylistPopup').style.display = 'none';
}

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
    document.getElementById('edit_cover_playlist').addEventListener('change', previewImage);
});

function openDeletePopup() {
    document.getElementById("deletePlaylistPopup").style.display = "flex";
}

// Fungsi untuk menutup popup
function closeDeletePopup() {
    document.getElementById("deletePlaylistPopup").style.display = "none";
}

