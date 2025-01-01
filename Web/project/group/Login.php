<?php
session_start();
require "filePremiumLoginRegister/function.php";

if (isset($_POST["login"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    // Menggunakan prepared statements untuk mencegah SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Verifikasi password dengan hash
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: http://localhost/Tugas%20Bu%20devie/Home.html");
            exit();
        } else {
            // Password salah
            echo "Password salah.";
        }
    } else {
        // Username tidak ditemukan
        echo "Username tidak ditemukan.";
    }

    $stmt->close();
}

// cek username
//     if (mysqli_num_rows($result) === 1) {
//         $row = mysqli_fetch_assoc($result);
//         if (password_verify($password, $row["password"])) {
//             header("Location: index.php");
//             exit;
//         } else {
//             $error = true;
//         }
//     } else {
//         $error = true;
//     }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Log-In</title>
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,600&display=swap" rel="stylesheet">
</head>

<body style="background-color:black;">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="http://localhost/Tugas%20Bu%20devie/Home.html" class="btn btn-link font-weight-bold">Kembali</a>
                                <img src="assets/PremiumLoginRegister/global.jpg" alt="" style="max-width: 100%;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-5" style="color: #475CFD">Log-In</h1>
                                    </div>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control mt-5 rounded-pill gradien" id="username" placeholder="Masukkan Username Anda">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control rounded-pill gradien" id="password" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login" style="margin-bottom:-14px;" class="btn btn-success btn-block rounded-pill">Log-In</button><br>
                                        <div class="text-center mb-3">
                                            <p style="font-size:16px ;">Or Log-in With</p>
                                            <button type="button" class="btn btn-primary" style="width:120px;">Facebook</button> <button type="button" class="btn btn-danger mx-2" style="width:100px;">Google</button> <button type="button" class="btn btn-info" style="width:100px;">Twitter</button>
                                        </div>
                                        <p>Belum Memiliki Akun? <a href="registrasi.php">Register</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>