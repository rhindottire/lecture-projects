<?php
$servername = "127.0.0.1"; // Use IP address instead of hostname
$username = "root";
$password = "";
$dbname = "mydb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


function daftar($data)
{
  global $conn;

  $username = htmlspecialchars($data["username"]);
  $password = htmlspecialchars($data["password"]);
  $confirm_password = htmlspecialchars($data["password2"]);
  $dob = htmlspecialchars($data["dob"]);

  // Check if the password and confirmation password match
  if ($password !== $confirm_password) {
    echo "<script>alert('Password dan konfirmasi password tidak cocok.');</script>";
    return false;
  }

  // Check if the username already exists
  $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo "<script>alert('Username sudah digunakan.');</script>";
    return false;
  }

  // Hash the password before saving
  $password_hashed = password_hash($password, PASSWORD_DEFAULT);

  // Save the new user to the database
  $stmt = $conn->prepare("INSERT INTO user (username, password, dob, notif) VALUES (?, ?, ?, '[]')");
  $stmt->bind_param("sss", $username, $password_hashed, $dob);

  if ($stmt->execute()) {
    return true;
  } else {
    echo "<script>alert('Registrasi gagal. Silakan coba lagi.');</script>";
    return false;
  }

  $stmt->close();
}
function premium($data)
{
  global $conn;
  $premium = htmlspecialchars($data["premium"]);

  $query = "INSERT INTO user (premium) VALUES ('$premium')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}
