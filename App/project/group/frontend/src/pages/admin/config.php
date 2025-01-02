<?php
    // Koneksi menggunakan MySQLi
    $conn = mysqli_connect("localhost", "root", "", "abogoboga");

    // Fungsi untuk menampilkan data dari tabel
    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);

        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
?>

