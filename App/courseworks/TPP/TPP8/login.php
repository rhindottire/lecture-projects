<?php
session_start();
require 'func.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];
  $result = mysqli_query($conn, "SELECT username FROM user_ WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  if ($key === hash('md5', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

if (isset($_POST["login"])) {
  global $conn;
  $username = $_POST["username"];
  $password = md5($_POST["password"]);
  $result = mysqli_query($conn, "SELECT * FROM user_ WHERE username = '$username'");
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($password == $row["password"]) {
      $_SESSION["login"] = true;
      if (isset($_POST["remember"])) {
        setcookie('id', $row['id'], time() + 60);
        setcookie('key', hash('md5', $row['username']), time() + 60);
      }
      header("Location: index.php");
      exit;
    }
  }
  $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 400px;
      margin-top: 100px;
    }
    .form-label { font-weight: bold; }
    .alert {
      color: red;
      font-style: italic;
    }
    .btn-custom { width: 100%; }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center mb-4">Halaman Login</h2>

    <?php if (isset($error)) : ?>
      <p class="alert">Username / Password Salah!</p>
    <?php endif; ?>

    <form action="" method="post">
      <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <div class="form-group form-check">
        <input type="checkbox" name="remember" id="remember" class="form-check-input">
        <label for="remember" class="form-check-label">Remember me</label>
      </div>

      <button type="submit" name="login" class="btn btn-primary btn-custom">Login</button>
    </form>
  </div>
</body>
</html>