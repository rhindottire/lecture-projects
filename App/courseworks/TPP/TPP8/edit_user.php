<?php
session_start();
include 'func.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit();
}

$error_username = $error_nama = $error_alamat = $error_telepon = $error_level = '';
$username = $nama = $alamat = $telepon = $level = '';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM user_ WHERE id_user = '$id'";
  $sql = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($sql);

  if ($user) {
    $username = $user['username'];
    $nama = $user['nama'];
    $alamat = $user['alamat'];
    $telepon = $user['hp'];
    $level = $user['level'];
  }
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $telepon = $_POST['telepon'];
  $level = isset($_POST['level']) ? $_POST['level'] : '';

  if (empty($username)) {
    $error_username = 'Username tidak boleh kosong!';
  }
  if (empty($nama)) {
    $error_nama = 'Nama tidak boleh kosong!';
  }
  if (empty($alamat)) {
    $error_alamat = 'Alamat tidak boleh kosong!';
  }
  if (empty($telepon)) {
    $error_telepon = 'Nomor telepon tidak boleh kosong!';
  }
  if (empty($level)) {
    $error_level = 'Jenis user tidak boleh kosong!';
  }

  $query = "UPDATE user_
            SET username = '$username',
                nama = '$nama',
                alamat = '$alamat',
                hp = '$telepon',
                level = '$level'
            WHERE id_user = '$id'";

  if (empty($error_username) && empty($error_nama) && empty($error_alamat) && empty($error_telepon) && empty($error_level)) {
    if (mysqli_query($conn, $query)) {
      header("Location: index.php");
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h4 class="mb-3 text-info">Edit User</h4>
    <form method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($username) ? $username : ''; ?>">
        <div class="text-danger"><?php echo $error_username; ?></div>
      </div>

      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo isset($nama) ? $nama : ''; ?>">
        <div class="text-danger"><?php echo $error_nama; ?></div>
      </div>

      <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" cols="5" rows="4" class="form-control"><?php echo isset($alamat) ? $alamat : ''; ?></textarea>
        <div class="text-danger"><?php echo $error_alamat; ?></div>
      </div>

      <div class="form-group">
        <label for="telepon">Telepon</label>
        <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Nomor HP" value="<?php echo isset($telepon) ? $telepon : ''; ?>">
        <div class="text-danger"><?php echo $error_telepon; ?></div>
      </div>

      <div class="form-group">
        <label for="level">Jenis User</label>
        <select name="level" id="level" class="form-select form-control">
          <option value="" selected disabled>--Pilih Jenis User--</option>
          <option value="1" <?php echo isset($level) && $level == '1' ? 'selected' : ''; ?>>Admin</option>
          <option value="2" <?php echo isset($level) && $level == '2' ? 'selected' : ''; ?>>User Biasa</option>
        </select>
        <div class="text-danger"><?php echo $error_level; ?></div>
      </div>

      <button type="submit" class="btn btn-primary" name="submit" id="submit">Simpan</button>
      <a href="index.php" class="btn btn-danger">Batal</a>
    </form>
  </div>
</body>
</html>