<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abogoboga";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    http_response_code(500); // Kode status 500 untuk kesalahan server
    die(json_encode(["error" => "Koneksi ke database gagal: " . $conn->connect_error]));
}

// Periksa apakah parameter 'query' diterima
if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Escape query untuk mencegah SQL injection
    $query = $conn->real_escape_string($query);

    // Query pencarian
    $sql = "
        SELECT 
            musik.id_musik,
            musik.judul_musik,
            artis.nama_artis,
            musik.file_musik,
            artis.foto_artis,
            album.gambar_sampul
        FROM musik
        JOIN artis ON musik.id_artis = artis.id_artis
        LEFT JOIN album ON musik.id_album = album.id_album
        WHERE musik.judul_musik LIKE '%$query%'
    ";

    // Eksekusi query
    $result = $conn->query($sql);

    // Array untuk menyimpan hasil pencarian
    $songs = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $songs[] = [
                "id_musik" => $row['id_musik'],
                "judul_musik" => $row['judul_musik'],
                "gambar_sampul" => $row['gambar_sampul'],
                "nama_artis" => $row['nama_artis'],
                "file_musik" => $row['file_musik'], // Nama file musik
                "foto_artis" => $row['foto_artis']
                    ? 'data:image/jpeg;base64,' . base64_encode($row['foto_artis']) 
                    : null,
                "gambar_sampul" => $row['gambar_sampul']
                    ? 'data:image/jpeg;base64,' . base64_encode($row['gambar_sampul'])
                    : null
            ];
        }
    }

    // Kirim hasil dalam format JSON
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($songs);
} else {
    // Jika parameter 'query' tidak ada
    http_response_code(400); // Kode status 400 (Permintaan Tidak Valid)
    echo json_encode(["error" => "Parameter 'query' diperlukan untuk pencarian."]);
}

// Tutup koneksi database
$conn->close();
?>
