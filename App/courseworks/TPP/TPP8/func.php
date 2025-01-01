<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "store";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} else {
  echo "<script>console.log('Connected successfully');</script>";
}

function getUsers() {
  global $conn;
  $query = "SELECT * FROM user_";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
  }
  $rows = [];
  while($row = mysqli_fetch_assoc($result)) {
    $row['no'] = count($rows) + 1;
    $rows[] = $row;
  }
  return $rows;
}

function getUser($id) {
  global $conn;
  $query = "SELECT * FROM user_ WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
  }
  return mysqli_fetch_assoc($result);
}

function addUser($username, $password, $nama, $alamat, $hp, $level) {
  global $conn;
  $hashPassword = md5($password);
  $query = "INSERT INTO user_ (username, password, nama, alamat, hp, level)
            VALUES ('{$username}', '{$hashPassword}', '{$nama}', '{$alamat}', '{$hp}', '{$level}')";
  if (mysqli_query($conn, $query)) {
    return true;
  }
  return false;
}

function updateUser($id, $username, $password, $nama, $alamat, $hp, $level) {
  global $conn;
  $hashPassword = md5($password);
  $query = "UPDATE user_
            SET username = '{$username}',
                password = '{$hashPassword}',
                nama = '{$nama}',
                alamat = '{$alamat}',
                hp = '{$hp}',
                level = '{$level}'
            WHERE id = {$id}";
  if (mysqli_query($conn, $query)) {
    return true;
  }
  return false;
}

function deleteUser($id) {
  global $conn;
  $query = "DELETE FROM user_ WHERE id = {$id}";
  if (mysqli_query($conn, $query)) {
    return true;
  }
  return false;
}
?>