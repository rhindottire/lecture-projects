<!DOCTYPE html>
<html>
<head>
    <title>Simpan</title>
</head>
<body>
<?php
// Mendapatkan data dari form POST
$nama = $_POST['nama'] ?? '';
$sex = $_POST['sex'] ?? '';
$email = $_POST['email'] ?? '';
$komentar = $_POST['komentar'] ?? '';
$minat1 = isset($_POST['minat1']) ? 'v' : '-';
$minat2 = isset($_POST['minat2']) ? 'v' : '-';
$minat3 = isset($_POST['minat3']) ? 'v' : '-';

// Validasi apakah semua field yang diperlukan terisi
if (empty($nama) || empty($email) || empty($komentar)) {
    echo "Data nama, email, dan komentar harus diisi!";
    exit;
}

// Gabungkan minat ke dalam satu string kode
$kode_minat = $minat1 . $minat2 . $minat3;

// Menyimpan data ke dalam file bukutamu.txt
$pegangan = fopen("bukutamu.txt", "a+");
if ($pegangan) {
    // Menulis data tanpa label tambahan "Nama:", "Email:", dan "Komentar:"
    fwrite($pegangan, "$nama\n");
    fwrite($pegangan, "$sex\n");
    fwrite($pegangan, "$email\n");
    fwrite($pegangan, "$komentar\n");
    fwrite($pegangan, "$kode_minat\n\n");
    fclose($pegangan);
    
    echo "Halo, $nama. Data Anda sudah disimpan.<br>";
    echo "Terima kasih.<br>";
} else {
    echo "Gagal membuka file untuk menyimpan data.";
}

// Form untuk menampilkan data yang sudah tersimpan
echo '<form name="bukutamu" method="post" action="data.php">';
echo '<input type="submit" value="Baca Data">';
echo '</form>';
?>
</body>
</html>