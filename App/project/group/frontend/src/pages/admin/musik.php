<?php
session_start();
if (!isset($_SESSION['token'])) {
    header("Location: ../../auth/login.php");
    exit();
}

require_once __DIR__ . "/../../templates/header.php";
require_once __DIR__ . "/../../templates/footer.php";
require_once __DIR__ . "/../../components/layouts/sidebar.php";
require_once __DIR__ . "/../../components/layouts/navbar.php";
require_once __DIR__ . "/../../templates/admin/tabel.php";
require_once __DIR__ . "/../../templates/admin/pagination.php";
require_once __DIR__ . "/../../templates/modal.php";

require_once __DIR__ . "/../../api/admin.php";
$admins = getAdmins($_SESSION['token']);
$getAdminById = getAdminById($_SESSION['token']);
$admin = getAdminDetails($_SESSION['token']);
require 'config.php';

$data_lagu = query("SELECT l.id_musik, l.judul_musik, l.durasi, l.file_musik, ar.nama_artis, al.nama_album, l.genre, l.tanggal_ditambahkan 
                    FROM musik l 
                    JOIN artis ar ON l.id_artis = ar.id_artis 
                    JOIN album al ON l.id_album = al.id_album");

if (isset($_SESSION['message'])) {
    // Tampilkan alert berdasarkan tipe pesan (tambah atau hapus)
    if ($_SESSION['message_type'] == 'add') {
        echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    } elseif ($_SESSION['message_type'] == 'delete') {
        echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    }

    // Hapus pesan setelah ditampilkan
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<?php headerTemplates("Dashboard"); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    /* General Transition Styles */
    #content {
        transition: margin-left 0.3s ease;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        background-color: #1f2937;
        color: #ffffff;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 10;
        transition: transform 0.3s ease;
    }

    .sidebar-closed .sidebar {
        transform: translateX(-250px);
    }

    .sidebar-open #content {
        margin-left: 250px;
    }

    .sidebar-closed #content {
        margin-left: 0;
    }

    /* Page Content */
    .p-4 {
        padding: 16px;
    }

    .text-xl {
        font-size: 1.25rem;
        font-weight: 700;
    }

    .font-bold {
        font-weight: 700;
    }

    .search-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .search {
        flex-grow: 1;
        max-width: 100%;
        padding: 8px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
    }

    .add-lagu-link {
        white-space: nowrap;
        text-align: center;
        margin-left: 16px;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
    }

    .search:focus {
        outline: none;
        border-color: #181818;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #333;
        color: #181818;
    }

    th {
        background-color: #181818;
        color: #1db954;
        padding: 15px;
        text-align: center;
        vertical-align: middle;
        border-bottom: 1px solid #333;
    }

    .album-cover {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .action-buttons {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 5px;
        margin-right: 10px;
        flex-wrap: nowrap;
    }

    .edit-btn,
    .delete-btn {
        padding: 8px 12px;
        color: #ffffff;
        background-color: #333;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-right: 5px;
    }

    .delete-btn {
        background-color: #1db954;
    }

    .delete-btn:hover {
        background-color: #c0392b;
    }

    .edit-btn:hover {
        background-color: #555;
    }

    .aksi-buttons {
        display: flex;
        gap: 5px;
    }

    .navbar {
        padding: 0;
    }

    select {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background-color: #f8f8f8;
    }

    select:focus {
        border-color: #1db954;
        box-shadow: 0 0 5px rgba(29, 185, 84, 0.3);
    }

    .reset-filter-btn {
        margin-left: 16px;
        background-color: #181818;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
    }

    .reset-filter-btn:hover {
        background-color: #0056b3;
    }

    .search-genre {
        font-size: 14px;
        padding: 10px 10px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background-color: #f8f8f8;
        transition: border-color 0.3s, box-shadow 0.3s;
        margin-left: 5px;
    }

    .search-genre:focus {
        border-color: #1db954;
        box-shadow: 0 0 5px rgba(29, 185, 84, 0.3);
    }

    .search-genre option {
        color: #181818;
    }

    .search-genre option:disabled {
        color: #9ca3af;
    }

    .scroll-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #181818;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 24px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .scroll-to-top.hidden {
        opacity: 0;
        visibility: hidden;
    }

    .scroll-to-top:hover {
        background-color: #28a745;
    }
</style>

<div id="container" x-data="{ open: false }" :class="open ? 'sidebar-open' : 'sidebar-closed'" class="relative flex transition-all duration-500">
    <!-- Sidebar -->
    <div class="sidebar">
        <?php sidebar($admin); ?>
    </div>

    <!-- Konten Utama -->
    <div id="content" class="w-full ml-0">
        <!-- Navbar -->
        <div class="navbar">
            <?php navbar($admin); ?>
        </div>

        <!-- Konten Halaman -->
        <div class="p-4">
            <h1 class="text-xl font-bold mb-4">Daftar Lagu</h1>

            <!-- Pencarian lagu -->
            <div class="search-container mb-4">
                <input type="text" id="search-lagu" class="search" placeholder="Cari..." onkeyup="filterLagu()">

                <!-- Filter Genre -->
                <select id="filter-genre" class="search-genre" onchange="filterLagu()">
                    <option value="">Filter Genre</option>
                    <?php
                    // Ambil data genre dari database
                    $genres = query("SELECT DISTINCT genre FROM musik WHERE genre IS NOT NULL AND genre != ''");
                    foreach ($genres as $genre) {
                        echo "<option value='" . htmlspecialchars($genre['genre']) . "'>" . htmlspecialchars($genre['genre']) . "</option>";
                    }
                    ?>
                </select>

                <!-- Filter ID Ganjil/Genap -->
                <select id="filter-id" class="search-genre" onchange="filterLagu()">
                    <option value="">Filter ID</option>
                    <option value="odd">ID Ganjil</option>
                    <option value="even">ID Genap</option>
                </select>

                <!-- Tombol untuk menghapus filter dan menampilkan semua data -->
                <button id="reset-filter" class="reset-filter-btn" onclick="resetFilter()">Tampilkan Semua Data</button>

                <button id="scrollToTop" class="scroll-to-top hidden">
                    <i class="fa fa-arrow-up"></i>
                </button>

                <a href="tambah_lagu.php" class="add-lagu-link">
                    Tambah Lagu
                </a>
            </div>

            <!-- Tabel untuk menampilkan data lagu -->
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Judul Musik</th>
                        <th class="border border-gray-300 px-4 py-2">Artis</th>
                        <th class="border border-gray-300 px-4 py-2">Album</th>
                        <th class="border border-gray-300 px-4 py-2">Genre</th>
                        <th class="border border-gray-300 px-4 py-2">Durasi</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Ditambahkan</th>
                        <th class="border border-gray-300 px-4 py-2">Putar Musik</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_lagu as $lagu): ?>
                        <tr class="lagu-item" data-id="<?= $lagu['id_musik']; ?>">
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($lagu["id_musik"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($lagu["judul_musik"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($lagu["nama_artis"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($lagu["nama_album"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($lagu["genre"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($lagu["durasi"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($lagu["tanggal_ditambahkan"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <audio controls>
                                    <source src="uploads/lagu/<?= htmlspecialchars($lagu['file_musik']); ?>" type="audio/<?= pathinfo($lagu['file_musik'], PATHINFO_EXTENSION); ?>">
                                    Your browser does not support the audio element.
                                </audio>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <div class="aksi-buttons">
                                    <a href="ubah_lagu.php?id_musik=<?= $lagu['id_musik']; ?>" class="edit-btn">Edit</a>
                                    <a href="hapus_lagu.php?id_musik=<?= $lagu['id_musik']; ?>" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus lagu ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function filterLagu() {
        const input = document.getElementById("search-lagu").value.toLowerCase();
        const genreFilter = document.getElementById("filter-genre").value.toLowerCase();
        const idFilter = document.getElementById("filter-id").value.toLowerCase();
        const rows = document.querySelectorAll(".lagu-item");

        rows.forEach(row => {
            const title = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
            const artist = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
            const genre = row.querySelector("td:nth-child(5)").textContent.toLowerCase();
            const id = row.querySelector("td:nth-child(1)").textContent.trim();
            const duration = row.querySelector("td:nth-child(6)").textContent.toLowerCase();

            // Filter berdasarkan judul dan artis
            const matchesSearch = title.includes(input) || artist.includes(input) || duration.includes(input);

            // Filter berdasarkan genre
            const matchesGenre = genreFilter ? genre === genreFilter : true;

            // Filter berdasarkan ID ganjil/genap
            const matchesId = idFilter === 'odd' ? id % 2 !== 0 : (idFilter === 'even' ? id % 2 === 0 : true);

            // Tampilkan atau sembunyikan baris berdasarkan filter
            if (matchesSearch && matchesGenre && matchesId) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function resetFilter() {
        // Menghapus nilai dari dropdown
        document.getElementById("filter-genre").value = "";
        document.getElementById("filter-id").value = "";

        // Menghapus nilai dari input pencarian
        document.getElementById("search-lagu").value = "";

        // Menampilkan semua baris lagu
        const rows = document.querySelectorAll(".lagu-item");
        rows.forEach(row => {
            row.style.display = "";
        });
    }

    function clearSearchLagu() {
        document.getElementById("search-lagu").value = "";
        filterLagu();
    }

    document.addEventListener('DOMContentLoaded', () => {
        const audioPlayers = document.querySelectorAll('audio');

        audioPlayers.forEach(audio => {
            audio.addEventListener('play', () => {
                // Pause all other audio elements
                audioPlayers.forEach(otherAudio => {
                    if (otherAudio !== audio) {
                        otherAudio.pause();
                    }
                });
            });
        });
    });

    const scrollToTopBtn = document.getElementById('scrollToTop');
    const addArtistLink = document.querySelector('.add-lagu-link');

    // Event listener untuk memantau scroll
    window.addEventListener('scroll', () => {
        const addArtistPosition = addArtistLink.getBoundingClientRect().top;
        const viewportHeight = window.innerHeight;

        // Tampilkan tombol jika "Tambah Artis" tidak terlihat
        if (addArtistPosition > viewportHeight || addArtistPosition < 0) {
            scrollToTopBtn.classList.remove('hidden');
        } else {
            scrollToTopBtn.classList.add('hidden');
        }
    });

    // Event listener untuk klik tombol kembali ke atas
    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

<?php footerTemplates(); ?>