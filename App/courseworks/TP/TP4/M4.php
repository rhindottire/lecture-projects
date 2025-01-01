<?php
  $errors = [];
  $pattern_user = "/^[a-zA-Z0-9]{8,}$/";
  $pattern_pw = "/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];



    if (empty($username)) {
      $errors[] = "Username tidak boleh kosong.";
    }
    if (!preg_match($pattern_user, $username)) {
      $errors[] = "Username harus berisi minimal 8 karakter.";
    }


    
    if (empty($password)) {
      $errors[] = "Password tidak boleh kosong.";
    }
    if (!preg_match($pattern_pw, $password)) {
      $errors[] = "Password harus berisi minimal 8 karakter dengan kombinasi 4 huruf dan 4 angka.";
    }



    if (empty($errors)) {
        echo "form telah berhasil terkirim tanpa error";
    }
  }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
</head>
<body>
    <?php
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    }
    ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"><br><br>
        
        <label for="password">Password:</label>
        <input type="text" name="password" id="password"><br><br>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>