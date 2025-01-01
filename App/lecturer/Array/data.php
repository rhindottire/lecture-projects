<?php
$no_data = 1;

// Membuka file bukutamu.txt untuk dibaca
$pegangan = fopen("bukutamu.txt", "r");

if (!$pegangan) {
    die("File tidak dapat dibuka. Pastikan file bukutamu.txt ada di direktori yang benar.");
}

// Membaca file baris demi baris
while (!feof($pegangan)) {
    $nama = trim(fgets($pegangan));
    if ($nama === FALSE || empty($nama)) {
        break;
    }

    $kelamin = trim(fgets($pegangan));
    if ($kelamin == "p") {
        $kelamin = "Perempuan <br>";
    } else {
        $kelamin = "Laki-Laki <br>";
    }

    $email = trim(fgets($pegangan));
    $komentar = trim(fgets($pegangan));
    $kode_minat = trim(fgets($pegangan));
    fgets($pegangan); // Skip the empty line after each record

    // Menentukan minat yang dipilih berdasarkan kode minat
    $minat = "";
    if (substr($kode_minat, 0, 1) == 'v') {
        $minat .= "Pemrograman<br>";
    }
    if (substr($kode_minat, 1, 1) == 'v') {
        $minat .= "Manajemen<br>";
    }
    if (substr($kode_minat, 2, 1) == 'v') {
        $minat .= "Sosial<br>";
    }

    // Menampilkan data yang telah dibaca
    echo "<b>Data ke-$no_data :</b><br>";
    echo "Nama : $nama <br>";
    echo "Jenis Kelamin: $kelamin <br>";
    echo "E-mail: $email<br>";
    
    if (!empty($minat)) {
        echo "Minat: <br> $minat<br>";
    }

    echo "Komentar : $komentar <br><br>";
    
    $no_data++;
}

// Menutup file
fclose($pegangan);
?>
