<?php
$conn = mysqli_connect("localhost","root","","abogoboga");

function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// session_start();
// $client = $_SESSION['client_data'];
// var_dump($client)


session_start();
require_once __DIR__ . "../../../../../api/client.php";
$client = getClientDetails($_SESSION['token'])['data'];

// Debugging: lihat path absolut
// echo "Current Directory: " . __DIR__ . "<br>";
// echo "Trying to load: " . realpath(__DIR__ . "../../../api/client.php") . "<br>";

// require_once __DIR__ . "/../../../api/client.php";

// // Lanjutkan dengan kode Anda
// session_start();
// $client = getClientDetails($_SESSION['token'])['data'];
// var_dump($client);
?>
