<?php
// $conn = mysqli_connect('localhost','root','','abogoboga');
// $prem = mysqli_query($conn,"SELECT 
//                     s.*,
//                     p.*,
//                     c.*,
//                     u.id
//                     FROM subscribe as s
//                     LEFT JOIN payments as p ON s.paymentId = p.id
//                     LEFT JOIN client as c ON p.clientId = c.id
//                     LEFT JOIN users as u ON u.id = c.userId
//                     WHERE ");


// $status = mysqli_fetch_assoc($prem);
// var_dump($status);
// die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- Menyertakan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Menambahkan CSS langsung di sini -->
    <style>
        /* Gaya Sidebar */
        .sidebar {
            width: 80px; /* Lebar sidebar */
            background-color: #2a2a2a; /* Warna latar belakang */
            height: 100vh; /* Tinggi 100% viewport */
            position: fixed; /* Tetap di posisi */
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column; /* Susunan vertikal */
            align-items: center; /* Posisikan elemen di tengah */
            padding-top: 20px; /* Jarak dari atas */
            z-index: 9999; /* Di atas elemen lain */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2); /* Bayangan */
        }

        /* Gaya untuk ikon di sidebar */
        .sidebar a i {
            color: #ffffff; /* Warna ikon */
            font-size: 35px; /* Ukuran ikon */
            margin-bottom: 20px; /* Jarak antar ikon */
        }

        /* Gaya untuk gambar di sidebar */
        .sidebar img {
            width: 50px; /* Lebar gambar */
            height: 50px; /* Tinggi gambar */
            margin-bottom: 20px; /* Jarak bawah gambar */
            border-radius: 5px; /* Sudut membulat */
        }

        /* Gaya untuk konten utama */
        .main-content {
            margin-left: 80px; /* Memberi ruang untuk sidebar */
            padding: 20px; /* Padding di sekitar konten */
        }

        /* Hover efek */
        .sidebar a:hover i {
            color: #ff9800; /* Warna oranye saat hover */
        }

        /* Dropdown menu */
        .dropdown-menu {
            display: none; /* Tidak terlihat secara default */
            position: absolute;
            top: 100px; /* Jarak dari ikon */
            left: 70px; /* Posisi horizontal */
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 9999; /* Di atas elemen lain */
        }

        .dropdown-menu a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            margin: 5px 0;
            border-radius: 3px;
        }

        .dropdown-menu a:hover {
            background-color: #ff9800;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px; /* Lebar sidebar lebih kecil pada layar kecil */
            }
            .main-content {
                margin-left: 60px; /* Sesuaikan margin dengan lebar sidebar */
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="project.php">
            <a href="landingPage.php"><i class="fas fa-home" aria-hidden="true"></i></a>
        </a>
        <div class="navbar-item" id="navbar-item">
            <a href="javascript:void(0);">
                <i class="fas fa-user icon" aria-hidden="true"></i>
            </a>
            <!-- Dropdown menu -->
            <div class="dropdown-menu" id="dropdown-menu">
                <a href="settings/profile.php">User Profile</a>
                <a href="settings/settings.php">User Setting</a>
                <a href="settings/premium.php">Premium</a>
                <a id="logout" href="">logout</a>
            </div>
        </div>
        <a href="punyazulfri/index.php"><img 
            alt="Ikon Sidebar 4" 
            src="https://storage.googleapis.com/a1aa/image/1eVen0dtxbsgxUxTfP6WDNWTVrw5Mpk8qfrwft7S3OJuhhMeE.jpg"
        /></a>
        </div>

    <!-- JavaScript -->
    <script>
        const navbarItem = document.getElementById('navbar-item');
        const dropdownMenu = document.getElementById('dropdown-menu');

        navbarItem.addEventListener('click', () => {
            // Toggle visibility
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            } else {
                dropdownMenu.style.display = 'block';
            }
        });

        // Optional: Klik di luar dropdown untuk menutupnya
        document.addEventListener('click', (event) => {
            if (!navbarItem.contains(event.target)) {
                dropdownMenu.style.display = 'none';
            }
        });
    </script>
</body>
</html>
