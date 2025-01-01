<?php
session_start();
require 'filePremiumLoginRegister/function.php'; // Ensure you have a separate file to handle database connection


if (isset($_POST["register"])) {
    if (daftar($_POST) > 0) {
        echo "<script>alert('Berhasil Registrasi');</script>";
        header("Location: login.php");
        exit();
    } else {
        echo "<script>alert('Registrasi gagal. Silakan coba lagi.');</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Registrasi</title>
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
                                        <h1 class="h4 text-gray-900 mb-4" style="color: #475CFD">Registrasi Akun Baru!!</h1>
                                    </div>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control rounded-pill gradien" id="username" placeholder="Masukkan Username Anda" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control rounded-pill gradien" id="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password2" class="form-control rounded-pill gradien" id="password2" placeholder="Konfirmasi Password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="date" name="dob" class="form-control rounded-pill gradien" id="dob" required>
                                        </div>
                                        <button type="submit" name="register" class="btn btn-success btn-block rounded-pill">Buat Akun Baru</button>
                                    </form>
                                    <br>
                                    <p>Sudah Memiliki Akun? <a href="login.php">Log-In</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>