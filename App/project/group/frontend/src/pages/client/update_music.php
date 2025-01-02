<?php
// Include your database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abogoboga";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: application/json');

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['id'])) {
    $id = intval($data['id']);

    // Update music_of_the_week in the database
    $sql = "UPDATE musik SET music_of_the_week = music_of_the_week + 1 WHERE id_musik = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Music of the week updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update music of the week.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

$conn->close();
?>
