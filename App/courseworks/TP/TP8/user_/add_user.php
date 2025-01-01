<?php
  session_start();
  if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }
  require 'func.php';

  $successMessage = "";
  if (isset($_POST['submit'])) {
    if (addUser($_POST['username'],
                $_POST['password'],
                $_POST['nama'],
                $_POST['alamat'],
                $_POST['hp'],
                $_POST['level'])) {
      $successMessage = "User berhasil ditambahkan!";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add User</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 500px;
      margin-top: 50px;
    }
    .form-label { font-weight: bold; }
    .btn-custom { width: 100px; }
    .btn-cancel a {
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h4 class="mb-3 text-info text-center">Add New User</h4>
    
    <?php if ($successMessage): ?>
      <div class="alert alert-success" role="alert">
        <?= $successMessage ?>
      </div>
    <?php endif; ?>
    
    <form action="add_user.php" method="POST" class="border p-4 rounded">
      <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="nama" class="form-label">Nama User</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
      </div>

      <div class="form-group">
        <label for="hp" class="form-label">Nomor HP</label>
        <input type="text" name="hp" id="hp" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="level" class="form-label">Jenis User</label>
        <select name="level" id="level" class="form-control" required>
          <option value="0">-- Pilih Jenis User --</option>
          <option value="1">Admin</option>
          <option value="2">User Biasa</option>
        </select>
      </div>

      <div class="d-flex justify-content-between mt-3">
        <button type="submit" name="submit" id="submit" class="btn btn-success btn-custom">Simpan</button>
        <button type="button" id="cancel" class="btn btn-danger btn-custom btn-cancel">
          <a href="index.php">Batal</a>
        </button>
      </div>
    </form>
  </div>
</body>
</html>