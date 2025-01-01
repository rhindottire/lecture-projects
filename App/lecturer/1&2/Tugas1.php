<!DOCTYPE html>
<html>
<head>
    <title>Pemilihan Tampilan Teks</title>
</head>
<body>
    <h2>Pemilihan Tampilan Text</h2>
    <form method="post" action="">
        Teks: <input type="text" name="teks" value="devie"><br>
        Ditampilkan sebanyak: 
        <select name="jumlah">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
        </select><br>
        Lakukan: 
        <input type="radio" name="tindakan" value="Break" checked>Break
        <input type="radio" name="tindakan" value="Continue">Continue<br>
        Pada Hitungan ke: 
        <input type="number" name="hentikan_ke" min="1" max="15" value="2"><br>
        <input type="submit" value="Proses"><br><br>
    </form>

    <?php
    // Memeriksa apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Mengambil nilai dari form
        $text = $_POST['teks'];
        $jumlah = $_POST['jumlah'];
        $tindakan = $_POST['tindakan'];
        $hentikan_ke = $_POST['hentikan_ke'];

        // Proses perulangan sesuai dengan pilihan
        for ($i = 1; $i <= $jumlah; $i++) {
            if ($i == $hentikan_ke && $tindakan == "Break") {
                echo "Hitungan ke-$i : break<br>"; // Menampilkan "break" pada hitungan yang dipilih
                break; // Menghentikan perulangan
            } else {
                echo "Hitungan ke-$i : $text<br>"; // Menampilkan teks biasa
            }
        }
    }
    ?>
</body>
</html>