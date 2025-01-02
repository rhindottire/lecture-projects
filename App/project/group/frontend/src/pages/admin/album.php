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

require_once __DIR__ . "/../../api/admin.php";
$admins = getAdmins($_SESSION['token']);
$getAdminById = getAdminById($_SESSION['token']);
$admin = getAdminDetails($_SESSION['token']);

require 'config.php';

$data_album = query("SELECT a.id_album, a.nama_album, a.gambar_sampul, ar.nama_artis, a.tanggal_ditambahkan FROM album a JOIN artis ar ON a.id_artis = ar.id_artis");

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

    .add-album-link {
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

<div id="container" x-data="{ open: false }"
    :class="open ? 'sidebar-open' : 'sidebar-closed'"
    class="relative flex transition-all duration-500">
    <!-- Sidebar -->
    <div class="sidebar bg-gray-800 text-white h-screen fixed z-10">
        <?php sidebar($admin); ?>
    </div>

    <!-- Main Content -->
    <div id="content" class="w-full ml-0">
        <!-- Navbar -->
        <div class="navbar">
            <?php navbar($admin); ?>
        </div>

        <!-- Page Content -->
        <div class="p-4">
            <h1 class="text-xl font-bold mb-4">Daftar Album</h1>
            <div class="search-container mb-4">
                <input type="text" id="search" class="search" placeholder="Cari..." onkeyup="filterAlbums()">

                <button id="scrollToTop" class="scroll-to-top hidden">
                    <i class="fa fa-arrow-up"></i>
                </button>

                <a href="tambah_album.php" class="add-album-link">Tambah Album</a>
            </div>

            <table id="albumTable" class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-center">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Cover</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Nama Album</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Artis</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Tanggal Ditambahkan</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_album as $album): ?>
                        <tr class="album-item" data-id="<?= $album['id_album']; ?>">
                            <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars($album["id_album"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <img src="data:image/jpeg;base64,<?= base64_encode($album['gambar_sampul']); ?>" alt="Cover Album" class="album-cover">
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars($album["nama_album"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars($album["nama_artis"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars($album["tanggal_ditambahkan"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="ubah_album.php?id_album=<?= $album['id_album']; ?>" class="edit-btn text-blue-600 hover:underline">Edit</a>
                                <a href="hapus_album.php?id_album=<?= $album['id_album']; ?>" class="delete-btn text-red-600 hover:underline ml-2" onclick="return confirm('Apakah Anda yakin ingin menghapus album ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <script>
                function filterAlbums() {
                    const input = document.getElementById("search").value.toLowerCase();
                    const rows = document.querySelectorAll("#albumTable tbody tr.album-item");

                    rows.forEach(row => {
                        const cells = Array.from(row.querySelectorAll("td")).map(cell => cell.textContent.toLowerCase());
                        const isMatch = cells.some(cell => cell.includes(input));
                        row.style.display = isMatch ? "" : "none";
                    });
                }

                function clearSearch() {
                    const searchInput = document.getElementById('search');
                    searchInput.value = '';
                    document.querySelector('.search-clear').style.display = 'none';
                    filterAlbums();
                }

                document.getElementById('search').addEventListener('input', function() {
                    filterAlbums();
                    const clearButton = document.querySelector('.search-clear');
                    clearButton.style.display = this.value.trim() ? 'inline' : 'none';
                });

                const scrollToTopBtn = document.getElementById('scrollToTop');
                const addArtistLink = document.querySelector('.add-album-link');

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
        </div>
    </div>
</div>

<?php footerTemplates(); ?>
