<?php
session_start();
require "filePremiumLoginRegister/function.php";

$id = $_SESSION["id"];
$stmt = $conn->prepare("SELECT username FROM user WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
if (isset($_POST["submit"])) {
  $premium = isset($_POST["premium"]) ? $_POST["premium"] : ''; // Update thepremium status in the database 
  $stmt = $conn->prepare("UPDATE user SET premium =
? WHERE id = ?");
  $stmt->bind_param("si", $premium, $id);
  $stmt->execute();
  $stmt->close(); // Redirect to a success page or display a success message
  header("Location: index.php");
  exit();
} ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Truno</title>
  <link rel="shortcut icon" href="img/TB.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="style/theme.css" />
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
                <a href="Login.html" class="bg-primary link-light rounded-5 py-0 w-100 mb-2 d-flex justify-content-center text-decoration-none" style="height: 35px">
                  <span>Login</span>
                </a>
                <a href="Register.html" class="bg-primary link-light rounded-5 py-0 w-100 d-flex justify-content-center text-decoration-none" style="height: 35px" type="submit">
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
  <div class="container">
    <div class="form-container">
      <h2 class="mb-4">Payment Form</h2>
      <h2 class="mb-4 mt-5">Payment Form</h2>
      <form action="" method="post">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="Masukkan cardholder name" />
          <label for="floatingInput">Nama Kartu</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="Masukkan card number" />
          <label for="floatingInput">Nomor Kartu</label>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" class="form-control" id="expirationMonth" placeholder="MM" />
              <label for="expirationMonth">Expiration Month</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" class="form-control" id="expirationYear" placeholder="YYYY" />
              <label for="expirationYear">Expiration Year</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" class="form-control" id="cvv" placeholder="CVV" />
              <label for="cvv">CVV</label>
            </div>
          </div>
        </div>
        <div class="form-floating mb-3">
          <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
            <option selected disabled value="">Choose...</option>
            <option value="AF">Afghanistan</option>
            <option value="AX">Åland Islands</option>
            <option value="AL">Albania</option>
            <option value="DZ">Algeria</option>
            <option value="AS">American Samoa</option>
            <option value="AD">Andorra</option>
            <option value="AO">Angola</option>
            <option value="AI">Anguilla</option>
            <option value="AQ">Antarctica</option>
            <option value="AG">Antigua &amp; Barbuda</option>
            <option value="AR">Argentina</option>
            <option value="AM">Armenia</option>
            <option value="AW">Aruba</option>
            <option value="AU">Australia</option>
            <option value="AT">Austria</option>
            <option value="AZ">Azerbaijan</option>
            <option value="BS">Bahamas</option>
            <option value="BH">Bahrain</option>
            <option value="BD">Bangladesh</option>
            <option value="BB">Barbados</option>
            <option value="BY">Belarus</option>
            <option value="BE">Belgium</option>
            <option value="BZ">Belize</option>
            <option value="BJ">Benin</option>
            <option value="BM">Bermuda</option>
            <option value="BT">Bhutan</option>
            <option value="BO">Bolivia</option>
            <option value="BA">Bosnia &amp; Herzegovina</option>
            <option value="BW">Botswana</option>
            <option value="BV">Bouvet Island</option>
            <option value="BR">Brazil</option>
            <option value="IO">British Indian Ocean Territory</option>
            <option value="VG">British Virgin Islands</option>
            <option value="BN">Brunei</option>
            <option value="BG">Bulgaria</option>
            <option value="BF">Burkina Faso</option>
            <option value="BI">Burundi</option>
            <option value="KH">Cambodia</option>
            <option value="CM">Cameroon</option>
            <option value="CA">Canada</option>
            <option value="CV">Cape Verde</option>
            <option value="BQ">Caribbean Netherlands</option>
            <option value="KY">Cayman Islands</option>
            <option value="CF">Central African Republic</option>
            <option value="TD">Chad</option>
            <option value="CL">Chile</option>
            <option value="CN">China</option>
            <option value="CX">Christmas Island</option>
            <option value="CC">Cocos (Keeling) Islands</option>
            <option value="CO">Colombia</option>
            <option value="KM">Comoros</option>
            <option value="CG">Congo - Brazzaville</option>
            <option value="CD">Congo - Kinshasa</option>
            <option value="CK">Cook Islands</option>
            <option value="CR">Costa Rica</option>
            <option value="CI">Côte d’Ivoire</option>
            <option value="HR">Croatia</option>
            <option value="CW">Curaçao</option>
            <option value="CY">Cyprus</option>
            <option value="CZ">Czechia</option>
            <option value="DK">Denmark</option>
            <option value="DJ">Djibouti</option>
            <option value="DM">Dominica</option>
            <option value="DO">Dominican Republic</option>
            <option value="EC">Ecuador</option>
            <option value="EG">Egypt</option>
            <option value="SV">El Salvador</option>
            <option value="GQ">Equatorial Guinea</option>
            <option value="ER">Eritrea</option>
            <option value="EE">Estonia</option>
            <option value="SZ">Eswatini</option>
            <option value="ET">Ethiopia</option>
            <option value="FK">Falkland Islands</option>
            <option value="FO">Faroe Islands</option>
            <option value="FJ">Fiji</option>
            <option value="FI">Finland</option>
            <option value="FR">France</option>
            <option value="GF">French Guiana</option>
            <option value="PF">French Polynesia</option>
            <option value="TF">French Southern Territories</option>
            <option value="GA">Gabon</option>
            <option value="GM">Gambia</option>
            <option value="GE">Georgia</option>
            <option value="DE">Germany</option>
            <option value="GH">Ghana</option>
            <option value="GI">Gibraltar</option>
            <option value="GR">Greece</option>
            <option value="GL">Greenland</option>
            <option value="GD">Grenada</option>
            <option value="GP">Guadeloupe</option>
            <option value="GU">Guam</option>
            <option value="GT">Guatemala</option>
            <option value="GG">Guernsey</option>
            <option value="GN">Guinea</option>
            <option value="GW">Guinea-Bissau</option>
            <option value="GY">Guyana</option>
            <option value="HT">Haiti</option>
            <option value="HM">Heard &amp; McDonald Islands</option>
            <option value="HN">Honduras</option>
            <option value="HK">Hong Kong SAR China</option>
            <option value="HU">Hungary</option>
            <option value="IS">Iceland</option>
            <option value="IN">India</option>
            <option value="ID" selected="selected">Indonesia</option>
            <option value="IQ">Iraq</option>
            <option value="IE">Ireland</option>
            <option value="IM">Isle of Man</option>
            <option value="IL">Israel</option>
            <option value="IT">Italy</option>
            <option value="JM">Jamaica</option>
            <option value="JP">Japan</option>
            <option value="JE">Jersey</option>
            <option value="JO">Jordan</option>
            <option value="KZ">Kazakhstan</option>
            <option value="KE">Kenya</option>
            <option value="KI">Kiribati</option>
            <option value="KW">Kuwait</option>
            <option value="KG">Kyrgyzstan</option>
            <option value="LA">Laos</option>
            <option value="LV">Latvia</option>
            <option value="LB">Lebanon</option>
            <option value="LS">Lesotho</option>
            <option value="LR">Liberia</option>
            <option value="LY">Libya</option>
            <option value="LI">Liechtenstein</option>
            <option value="LT">Lithuania</option>
            <option value="LU">Luxembourg</option>
            <option value="MO">Macao SAR China</option>
            <option value="MG">Madagascar</option>
            <option value="MW">Malawi</option>
            <option value="MY">Malaysia</option>
            <option value="MV">Maldives</option>
            <option value="ML">Mali</option>
            <option value="MT">Malta</option>
            <option value="MH">Marshall Islands</option>
            <option value="MQ">Martinique</option>
            <option value="MR">Mauritania</option>
            <option value="MU">Mauritius</option>
            <option value="YT">Mayotte</option>
            <option value="MX">Mexico</option>
            <option value="FM">Micronesia</option>
            <option value="MD">Moldova</option>
            <option value="MC">Monaco</option>
            <option value="MN">Mongolia</option>
            <option value="ME">Montenegro</option>
            <option value="MS">Montserrat</option>
            <option value="MA">Morocco</option>
            <option value="MZ">Mozambique</option>
            <option value="MM">Myanmar (Burma)</option>
            <option value="NA">Namibia</option>
            <option value="NR">Nauru</option>
            <option value="NP">Nepal</option>
            <option value="NL">Netherlands</option>
            <option value="NC">New Caledonia</option>
            <option value="NZ">New Zealand</option>
            <option value="NI">Nicaragua</option>
            <option value="NE">Niger</option>
            <option value="NG">Nigeria</option>
            <option value="NU">Niue</option>
            <option value="NF">Norfolk Island</option>
            <option value="MP">Northern Mariana Islands</option>
            <option value="KP">North Korea</option>
            <option value="NO">Norway</option>
            <option value="OM">Oman</option>
            <option value="PK">Pakistan</option>
            <option value="PW">Palau</option>
            <option value="PS">Palestinian Territories</option>
            <option value="PA">Panama</option>
            <option value="PG">Papua New Guinea</option>
            <option value="PY">Paraguay</option>
            <option value="PE">Peru</option>
            <option value="PH">Philippines</option>
            <option value="PN">Pitcairn Islands</option>
            <option value="PL">Poland</option>
            <option value="PT">Portugal</option>
            <option value="PR">Puerto Rico</option>
            <option value="QA">Qatar</option>
            <option value="MK">North Macedonia</option>
            <option value="RO">Romania</option>
            <option value="RU">Russia</option>
            <option value="RW">Rwanda</option>
            <option value="RE">Réunion</option>
            <option value="WS">Samoa</option>
            <option value="SM">San Marino</option>
            <option value="ST">São Tomé &amp; Príncipe</option>
            <option value="SA">Saudi Arabia</option>
            <option value="SN">Senegal</option>
            <option value="RS">Serbia</option>
            <option value="SC">Seychelles</option>
            <option value="SL">Sierra Leone</option>
            <option value="SG">Singapore</option>
            <option value="SX">Sint Maarten</option>
            <option value="SK">Slovakia</option>
            <option value="SI">Slovenia</option>
            <option value="SB">Solomon Islands</option>
            <option value="SO">Somalia</option>
            <option value="ZA">South Africa</option>
            <option value="GS">
              South Georgia &amp; South Sandwich Islands
            </option>
            <option value="KR">South Korea</option>
            <option value="SS">South Sudan</option>
            <option value="ES">Spain</option>
            <option value="LK">Sri Lanka</option>
            <option value="BL">St. Barthélemy</option>
            <option value="SH">St. Helena</option>
            <option value="KN">St. Kitts &amp; Nevis</option>
            <option value="LC">St. Lucia</option>
            <option value="MF">St. Martin</option>
            <option value="PM">St. Pierre &amp; Miquelon</option>
            <option value="VC">St. Vincent &amp; Grenadines</option>
            <option value="SD">Sudan</option>
            <option value="SR">Suriname</option>
            <option value="SJ">Svalbard &amp; Jan Mayen</option>
            <option value="SE">Sweden</option>
            <option value="CH">Switzerland</option>
            <option value="SY">Syria</option>
            <option value="TW">Taiwan</option>
            <option value="TJ">Tajikistan</option>
            <option value="TZ">Tanzania</option>
            <option value="TH">Thailand</option>
            <option value="TL">Timor-Leste</option>
            <option value="TG">Togo</option>
            <option value="TK">Tokelau</option>
            <option value="TO">Tonga</option>
            <option value="TT">Trinidad &amp; Tobago</option>
            <option value="TN">Tunisia</option>
            <option value="TR">Turkey</option>
            <option value="TM">Turkmenistan</option>
            <option value="TC">Turks &amp; Caicos Islands</option>
            <option value="TV">Tuvalu</option>
            <option value="UG">Uganda</option>
            <option value="UA">Ukraine</option>
            <option value="AE">United Arab Emirates</option>
            <option value="GB">United Kingdom</option>
            <option value="US">United States</option>
            <option value="UY">Uruguay</option>
            <option value="UZ">Uzbekistan</option>
            <option value="VU">Vanuatu</option>
            <option value="VA">Vatican City</option>
            <option value="VE">Venezuela</option>
            <option value="VN">Vietnam</option>
            <option value="WF">Wallis &amp; Futuna</option>
            <option value="EH">Western Sahara</option>
            <option value="YE">Yemen</option>
            <option value="ZM">Zambia</option>
            <option value="ZW">Zimbabwe</option>
          </select>
          <label for="floatingSelect">Pilih Negara Anda</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="Masukkan State/Province/Region" />
          <label for="floatingInput">Provinsi/Kecamatan</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="Masukkan Kode Pos" />
          <label for="floatingInput">Kode Pos</label>
          <input type="hidden" name="premium" value="true" />
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100 mb-5 mt-5">
          Submit Payment
        </button>
      </form>
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
  <script type="module" src="script/scriptCategory.js"></script>
</body>

</html>