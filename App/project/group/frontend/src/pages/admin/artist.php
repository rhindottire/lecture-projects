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

$data_artis = query("SELECT id_artis, nama_artis, foto_artis, biodata_artis, tanggal_ditambahkan FROM artis");

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
        /* Sidebar width */
        background-color: #1f2937;
        /* Gray-800 */
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
        /* Hide sidebar */
    }

    /* Content Wrapper (adjusts based on sidebar state) */
    .sidebar-open #content {
        margin-left: 250px;
        /* Adjust to sidebar width */
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
        /* Tailwind text-xl */
    }

    .font-bold {
        font-weight: 700;
    }

    .search-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .search {
        flex-grow: 1;
        max-width: 100%;
    }

    .add-artist-link {
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
        /* Blue-500 */
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        /* Blue focus shadow */
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
        /* Memusatkan teks secara horizontal */
        vertical-align: middle;
        /* Memusatkan teks secara vertikal */
        border-bottom: 1px solid #333;
    }

    .artist-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin: 0 auto;
    }

    /* Fixed width for the Biodata column header */
    th.biodata-header {
        width: 40%;
        /* You can adjust this value as needed */
        text-align: left;
        padding: 15px;
    }

    /* Fixed width and text wrapping for the Biodata column */
    td.biodata {
        width: 200px;
        /* Same width as header to ensure alignment */
        max-width: 200px;
        /* Set a fixed height */
        overflow-y: auto;
        /* Enable vertical scrolling */
        white-space: normal;
        word-wrap: break-word;
        text-align: justify;
        font-size: 14px;
        line-height: 1.5;
    }

    .add-artist-link:hover {
        background-color: #1db954;
        /* Blue-600 */
    }

    .navbar {
        padding: 0;
    }

    /* Action Buttons */
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
        /* Jarak antar tombol */
    }

    select {
        width: 200px;
        /* Atur lebar dropdown */
        font-size: 14px;
        /* Atur ukuran font */
        padding: 5px 10px;
        /* Atur padding agar lebih nyaman dipilih */
        border-radius: 8px;
        /* Membuat sudut lebih bulat */
        border: 1px solid #ccc;
        /* Warna border yang lebih lembut */
        background-color: #f8f8f8;
        /* Warna latar belakang yang lebih cerah */
    }

    select:focus {
        border-color: #1db954;
        /* Fokus border menjadi hijau */
        box-shadow: 0 0 5px rgba(29, 185, 84, 0.3);
        /* Menambahkan efek saat fokus */
    }

    .reset-filter-btn {
        margin-left: 16px;
        background-color: #181818;
        color: white;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
        height: 2.5rem;
        width: 10rem;
    }

    .reset-filter-btn:hover {
        background-color: #0056b3;
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
            <h1 class="text-xl font-bold mb-4">Daftar Artis</h1>
            <div class="search-container mb-4">
                <input type="text" id="search" class="search border rounded-lg px-4 py-2 w-full md:w-1/2" placeholder="Cari...">

                <!-- Filter Huruf -->
                <input type="text" id="filterByLetter" class="border rounded-lg px-4 py-2 ml-4" placeholder="Masukkan Huruf">

                <!-- Filter Tanggal dengan Kalender -->
                <input type="date" id="filterByDate" class="border rounded-lg px-4 py-2 ml-4">

                <!-- Filter ID -->
                <select id="filterById" class="border rounded-lg px-4 py-2 ml-4">
                    <option value="">Pilih ID</option>
                    <option value="odd">Ganjil</option>
                    <option value="even">Genap</option>
                </select>

                <button id="reset-filter" class="reset-filter-btn" onclick="resetFilter()">Semua Data</button>

                <button id="scrollToTop" class="scroll-to-top hidden">
                    <i class="fa fa-arrow-up"></i>
                </button>

                <a href="tambah_artis.php" class="add-artist-link">
                    Tambah Artis
                </a>
            </div>

            <table id="artistTable" class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-center">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Foto</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Nama Artis</th>
                        <th class="border border-gray-300 px-4 py-2 biodata-header text-center">Biodata</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Tanggal Ditambahkan</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_artis as $artis): ?>
                        <tr class="artist-item" data-id="<?= $artis['id_artis']; ?>">
                            <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars($artis["id_artis"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <img src="data:image/jpeg;base64,<?= base64_encode($artis['foto_artis']); ?>" alt="Foto Artis" class="artist-img">
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars($artis["nama_artis"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2 biodata">
                                <div class="biodata"><?= nl2br(htmlspecialchars($artis["biodata_artis"])); ?></div>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center"><?= htmlspecialchars($artis["tanggal_ditambahkan"]); ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="ubah_artis.php?id_artis=<?= $artis['id_artis']; ?>" class="edit-btn text-blue-600 hover:underline">Edit</a>
                                <a href="hapus_artis.php?id_artis=<?= $artis['id_artis']; ?>" class="delete-btn text-red-600 hover:underline ml-2" onclick="return confirm('Apakah Anda yakin ingin menghapus artis ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <script>
                // Fungsi pencarian Artis
                function filterArtists() {
                    const searchInput = document.getElementById("search").value.toLowerCase();
                    const letterFilter = document.getElementById("filterByLetter").value.toLowerCase();
                    const dateFilter = document.getElementById("filterByDate").value;
                    const idFilter = document.getElementById("filterById").value;
                    const rows = document.querySelectorAll("#artistTable tbody tr.artist-item");

                    rows.forEach(row => {
                        const cells = Array.from(row.querySelectorAll("td"));
                        const name = cells[2].textContent.toLowerCase();
                        const biodata = cells[3].textContent.toLowerCase(); // Ambil biodata artis
                        const dateAdded = cells[4].textContent;
                        const id = cells[0].textContent;

                        const matchesSearch = name.includes(searchInput) || biodata.includes(searchInput); // Tambahkan biodata pada pencarian
                        const matchesLetter = letterFilter ? name.startsWith(letterFilter) : true;
                        const matchesDate = dateFilter ? dateAdded.includes(dateFilter) : true;
                        const matchesId = idFilter === 'odd' ? id % 2 !== 0 : idFilter === 'even' ? id % 2 === 0 : true;

                        const isMatch = matchesSearch && matchesLetter && matchesDate && matchesId;
                        row.style.display = isMatch ? "" : "none";
                    });
                }

                // Event listener untuk memantau perubahan input pencarian
                document.getElementById('search').addEventListener('input', filterArtists);
                document.getElementById('filterByLetter').addEventListener('input', filterArtists);
                document.getElementById('filterByDate').addEventListener('change', filterArtists);
                document.getElementById('filterById').addEventListener('change', filterArtists);

                // Fungsi untuk menghapus pencarian
                function clearSearch() {
                    const searchInput = document.getElementById('search');
                    searchInput.value = ''; // Hapus nilai input
                    document.querySelector('.search-clear').style.display = 'none'; // Sembunyikan ikon silang
                    filterArtists(); // Perbarui tampilan tabel
                }

                function resetFilter() {
                    // Menghapus nilai dari dropdown
                    document.getElementById("filterByLetter").value = "";
                    document.getElementById("filterByDate").value = "";
                    document.getElementById("filterById").value = "";

                    // Menghapus nilai dari input pencarian
                    document.getElementById("search").value = "";

                    // Menampilkan semua baris lagu
                    const rows = document.querySelectorAll(".artist-item");
                    rows.forEach(row => {
                        row.style.display = "";
                    });
                }

                const scrollToTopBtn = document.getElementById('scrollToTop');
                const addArtistLink = document.querySelector('.add-artist-link');

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