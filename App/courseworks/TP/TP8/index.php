<?php
  session_start();
  if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }
  include "func.php";

  $users = getUsers();
  $no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Data</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .navbar-brand { font-weight: bold; }
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }
    .table th {
      background-color: #89CFEF;
      color: black;
    }
    .table tbody tr:nth-child(odd) { background-color: #f9f9f9; }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">DODO's Store</a>
    <div>
      <a href="#" class="text-white mx-2">Supplier</a>
      <a href="#" class="text-white mx-2">Barang</a>
      <a href="#" class="text-white mx-2">Transaksi</a>
      <a href="#" class="text-white mx-2">User</a>
      <a href="https://md5hashgenerator.com/">Click this!</a>
      <a href="logout.php" class="text-white mx-2">LOGOUT!!!</a>
    </div>
  </nav>

  <div class="container mt-4">
    <h4 class="mb-1 page-title text-info">List of User</h4>
    <div class="d-flex justify-content-end mb-3">
      <a href="add_user.php" class="btn btn-success">Add User</a>
    </div>

    <table class="table table-bordered">
      <thead>
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Name</th>
            <th>Level</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $indx => $user): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['nama'] ?></td>
            <td><?= $user['level'] == 1 ? "Admin" : "User Biasa" ?></td>
            <td>
              <button class="btn btn-warning">
                <a href="edit_user.php?id=<?= $user['id_user'] ?>">Edit</a>
              </button>
              <button class="btn btn-danger" onclick="deleteUser(<?= $user['id_user'] ?>)">Hapus</button>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <script>
    function deleteUser(id) {
      if (confirm("Are you sure you want to delete this user?")) {
        window.location.href = "delete_user.php?id=" + id;
      }
    }
  </script>
</body>
</html>