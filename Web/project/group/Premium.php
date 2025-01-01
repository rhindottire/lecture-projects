<?php
session_start();
require "filePremiumLoginRegister/function.php";
// Ambil informasi pengguna dari database
$id = $_SESSION["id"];
$stmt = $conn->prepare("SELECT username FROM user WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Truno</title>
  <link rel="shortcut icon" href="assets/Global/TB.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="style/theme.css" />
  <style>
    .profil {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-left: -250px;
    }

    .profile-info {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      margin-left: 20px;
      /* Adjust as necessary */
    }

    .cancel-subscription {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-top: 50px;
      margin-left: -350px;
    }
  </style>
</head>

<body>
  <!-- NAVBAR START -->
  <nav class="navbar fixed-top head-foot-theme py-2 border-bottom border-3 border-primary">
    <div class="container-fluid d-flex justify-content-between">
      <div class="d-flex align-items-center">
        <button class="btn border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <span><i class="bi bi-list fs-5"></i></span>
        </button>
        <a class="navbar-brand d-lg-inline-block d-none" href="#">
          <h3>Boot<span class="text-primary">strap</span></h3>
        </a>
      </div>
      <div>
        <a class="navbar-brand m-0 d-lg-none d-inline-block" href="#">
          <h3>Boot<span class="text-primary">strap</span></h3>
        </a>

        <button class="btn bg-light text-dark p-0 border-3 border-primary search-button justify-content-between align-items-center d-lg-flex d-none" style="width: 300px" type="button" data-bs-toggle="modal" data-bs-target="#modalForSearch">
          <span class="mx-2">Search</span>
          <i class="bg-primary rounded-end-1 px-2 text-dark h-auto d-inline-block bi bi-search fs-5"></i>
        </button>
      </div>
      <div class="d-flex align-items-center">
        <div class="d-lg-none d-inline-block">
          <button type="button" class="btn border-0" data-bs-toggle="modal" data-bs-target="#modalForSearch">
            <i class="bi bi-search fs-5"></i>
          </button>
        </div>
        <a href="#" id="premiumBtn1" class="btn text-light badge bg-primary mx-2 p-2 d-md-block d-none">
          Premium <i class="bi bi-gem"></i>
        </a>

        <div class="dropdown">
          <button class="btn dropdown-toggle border-0 pe-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="uiButtonTheme">
            <i class="bi bi-moon-stars-fill"></i>
          </button>
          <ul class="dropdown-menu" style="min-width: 0px">
            <li class="dropdown-item">
              <button class="btn border-0" id="darkButton">
                <i class="bi bi-moon-stars-fill"></i>
              </button>
            </li>
            <li class="dropdown-item">
              <button class="btn border-0" id="lightButton">
                <i class="bi bi-brightness-high-fill"></i>
              </button>
            </li>
          </ul>
        </div>

        <a href="" id="profilBtn1" class="btn border-0 d-lg-block d-none">
          <i class="bi bi-person fs-5"></i>
        </a>
        <button id="notifBtn" class="btn border-0" data-bs-toggle="modal" data-bs-target="#modalNotification">
          <i class="bi bi-envelope fs-5"></i>
        </button>
      </div>

      <div class="offcanvas offcanvas-start" style="width: 300px" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h3 class="offcanvas-header p-0 m-0">
            Boot<span class="text-primary">strap</span>
          </h3>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr class="m-0" />
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-start flex-grow-1">
            <li class="nav-item my-auto" id="displayBtnOrName">
              <div class="">
                <a href="Login.php" class="bg-primary link-light rounded-5 py-0 w-100 mb-2 d-flex justify-content-center text-decoration-none" style="height: 35px">
                  <span>Login</span>
                </a>
                <a href="Register.php" class="bg-primary link-light rounded-5 py-0 w-100 d-flex justify-content-center text-decoration-none" style="height: 35px" type="submit">
                  <span>Register</span>
                </a>
              </div>
            </li>
            <hr />
            <li class="nav-item my-auto">
              <a class="teks nav-link link-primary" href="Home.html"><i class="bi bi-house-door"></i> Home</a>
            </li>
            <li class="nav-item my-auto">
              <a class="nav-link teks link-primary" href="#" id="profilBtn2">
                <i class="bi bi-person"></i> Profile
              </a>
            </li>
            <li class="nav-item my-auto">
              <a class="nav-link teks link-primary" href="#" id="premiumBtn2">
                <i class="bi bi-gem"></i> Premium
              </a>
            </li>
            <li class="nav-item my-auto">
              <a class="nav-link link-primary teks" href="Category.html"><i class="bi bi-grid"></i> Category</a>
            </li>
            <li class="nav-item my-auto">
              <a class="nav-link link-primary teks" href="#" id="kritikBtn"><i class="bi bi-card-text"></i> Feedback</a>
            </li>
          </ul>
        </div>
        <hr class="m-0" />
        <div class="mx-3 my-2">if it works don't touch it</div>
      </div>
    </div>
  </nav>
  <!-- NAVBAR END -->
  <div class="modal" id="modalForSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down d-flex justify-content-center">
      <div class="modal-content" style="min-height: 650px; width: 700px">
        <div class="modal-header">
          <div class="w-100">
            <input type="text" class="form-control" id="searchInput" placeholder="Search" />
          </div>
          <button type="button" class="btn-close boder-0" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalBody">
          <div class="container-fluid" id="searchContainer"></div>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>

  <div class="modal" id="modalNotification" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Notification</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0"></div>
      </div>
    </div>
  </div>
  <!-------------------------------------------- MAIN START ------------------------------------------------------>
  <!-- isi di bawah sini ya anak pintar -->

  <div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 col-md-6 d-flex justify-content-center mt-5">
        <div class="profil">
          <img src="assets/Announcement/miku.jpg" alt="profil" class="img-fluid rounded-circle" style="height: 100px; width: 100px" />
        </div>
        <div class="profile-info">
          <h3><?= htmlspecialchars($user['username']); ?></h3>
          <p>Silahkan Memilih Paket Premium Anda</p>
        </div>
      </div>
      <div class="col-12 col-md-6 d-flex justify-content-end mt-5 cancel-subscription">
        <p class="text-muted mt-5">
          <i class="fa-solid fa-arrow-right-arrow-left"></i> Batalkan
          Langganan
        </p>
      </div>
    </div>
  </div>
  <!-- pilih premium -->

  <div class="container mt-5 d-md-flex">
    <div class="row justify-content-center">
      <!-- Card 1 -->
      <div class="col-md-3 mb-4">
        <div class="card shadow">
          <h2 class="text-center mx-3">
            Fans <br />
            IDR 25,000/bulan
          </h2>
          <p class="text-center">TERMASUK PPN</p>
          <!-- <hr style="height:5px;border-width:0;color:gray;background-color:gray"> -->
          <div class="card-body text-center">
            <a href="payment.php" class="link-underline link-underline-opacity-0 btn btn-outline-warning">GRATIS TRIAL 7-HARI</a>
            <h5 class="card-title mt-3" style="font-size: 15px">
              <a href="payment.php" class="link-light link-offset-2 link-underline link-underline-opacity-0">Skip Gratisan</a>
            </h5>
            <p class="card-text">
              Streaming seluruh anime yang ada Truno bebas iklan dan tonton
              episode baru segera setelah Jepang
            </p>
            <hr style="
                  height: 5px;
                  border-width: 0;
                  color: gray;
                  background-color: gray;
                " />
            <p>PLUS</p>
            <p class="text-start" style="font-size: 12px">
              <i class="fa-solid fa-check" style="color: #63e6be"></i> -
              Streaming di 1 perangkat dalam satu waktu
            </p>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-md-3 mb-4">
        <div class="card shadow">
          <h2 class="text-center mx-3">
            Sultan<br />
            IDR 39,000/bulan
          </h2>
          <p class="text-center">TERMASUK PPN</p>
          <!-- <hr style="height:5px;border-width:0;color:gray;background-color:gray"> -->
          <div class="card-body text-center">
            <a href="payment.php" class="link-underline link-underline-opacity-0 btn btn-outline-warning">GRATIS TRIAL 7-HARI</a>
            <h5 class="card-title mt-3" style="font-size: 15px">
              <a href="payment.php" class="link-light link-offset-2 link-underline link-underline-opacity-0">Skip Gratisan</a>
            </h5>
            <p class="card-text">
              Streaming seluruh anime yang ada Truno bebas iklan dan tonton
              episode baru segera setelah Jepang
            </p>
            <hr style="
                  height: 5px;
                  border-width: 0;
                  color: gray;
                  background-color: gray;
                " />
            <p>PLUS</p>
            <p class="text-start" style="font-size: 12px">
              <i class="fa-solid fa-check" style="color: #63e6be"></i> -
              Streaming hingga 4 perangkat sekaligus
            </p>
            <p class="text-start" style="font-size: 12px">
              <i class="fa-solid fa-check" style="color: #63e6be"></i> -
              Menonton Saat Offline
            </p>
            <p class="text-start" style="font-size: 12px">
              <i class="fa-solid fa-check" style="color: #63e6be"></i> - Akses
              Resolusi 4K
            </p>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col-md-3 mb-4">
        <div class="card shadow">
          <h2 class="text-center mx-3">
            Sultan <br />
            IDR 390,000/thn
          </h2>
          <p class="text-center">TERMASUK PPN</p>
          <!-- <hr style="height:5px;border-width:0;color:gray;background-color:gray"> -->
          <div class="card-body text-center">
            <a href="payment.php" class="link-underline link-underline-opacity-0 btn btn-outline-warning">GRATIS TRIAL 7-HARI</a>
            <h5 class="card-title mt-3" style="font-size: 15px">
              <a href="payment.php" class="link-light link-offset-2 link-underline link-underline-opacity-0">Skip Gratisan</a>
            </h5>
            <p class="card-text">
              Streaming seluruh anime yang ada Truno bebas iklan dan tonton
              episode baru segera setelah Jepang
            </p>
            <hr style="
                  height: 5px;
                  border-width: 0;
                  color: gray;
                  background-color: gray;
                " />
            <p>PLUS</p>
            <p class="text-start" style="font-size: 12px">
              <i class="fa-solid fa-check" style="color: #63e6be"></i> -
              Streaming hingga 4 perangkat sekaligus
            </p>
            <p class="text-start" style="font-size: 12px">
              <i class="fa-solid fa-check" style="color: #63e6be"></i> -
              Menonton Saat Offline
            </p>
            <p class="text-start" style="font-size: 12px">
              <i class="fa-solid fa-check" style="color: #63e6be"></i> - Akses
              Resolusi 4K
            </p>
            <p class="text-start" style="font-size: 12px">
              <i class="fa-solid fa-check" style="color: #63e6be"></i> -
              Diskon 16% untuk Paket Bulanan
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-------------------------------------------- MAIN END -------------------------------------------------------->
  <div class="position-relative">
    <i class="bi bi-arrow-up-circle position-fixed bottom-0 end-0 m-4 fs-3" onclick="return document.documentElement.scrollTop = 0" style="cursor: pointer"></i>
  </div>

  <!-- FOOTER START -->
  <footer class="container-fluid border-top border-3 border-primary head-foot-theme" style="height: 50px">
    <p class="text-center my-auto">&copy; Lorem Ipsum Dolor Sit Amet</p>
  </footer>
  <!-- FOOTER END -->

  <!-- modal untuk menampilkan info lebih lanjut sebuah lagu -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script type="module" src="script/scriptNavbar.js"></script>
</body>

</html>