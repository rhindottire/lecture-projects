<?php
session_start();
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['token'])) {
    $_SESSION['token'] = $input['token'];
    echo json_encode(["status" => "success", "message" => "Token saved to session."]);
} else {
    echo json_encode(["status" => "error", "message" => "Token not provided."]);
}

if (isset($input['recoveryToken'])) {
    $_SESSION['recoveryToken'] = $input['recoveryToken'];
    echo json_encode(["status" => "success", "message" => "Recovery Token saved to session."]);
} else {
    echo json_encode(["status" => "error", "message" => "Recovery Token not provided."]);
}
?>