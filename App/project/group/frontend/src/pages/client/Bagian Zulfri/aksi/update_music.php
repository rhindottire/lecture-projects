<?php
// Koneksi database
require_once "koneksi.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = intval($data['id']);

    // Update music_of_the_week di database
    $sql = "UPDATE musik SET music_of_the_week = music_of_the_week + 1 WHERE id_musik = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Music of the week updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update music of the week.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

