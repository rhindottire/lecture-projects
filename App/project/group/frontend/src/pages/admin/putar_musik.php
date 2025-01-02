<?php
require 'config.php';

// Check if id_musik is set
if (isset($_GET['id_musik'])) {
    $id_musik = intval($_GET['id_musik']);

    // Prepare a SQL statement to retrieve the music file
    $stmt = $pdo->prepare("SELECT file_musik FROM musik WHERE id_musik = ?");
    $stmt->execute([$id_musik]);

    // Fetch the file data
    $musicFile = $stmt->fetchColumn();

    if ($musicFile) {
        // Set the headers for audio streaming
        header("Content-Type: audio/mpeg");
        header("Content-Length: " . strlen($musicFile));
        echo $musicFile; // Output the binary data
    } else {
        http_response_code(404); // Not Found
        echo "File not found.";
    }
} else {
    http_response_code(400); // Bad Request
    echo "Invalid request.";
}
?>
