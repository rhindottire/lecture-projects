<?php
  session_start();
  if (isset($_SESSION['token'])) {
    header("Location: ./pages/home.php");
    exit();
  }
  require_once __DIR__ . "/../templates/header.php";
  require_once __DIR__ . "/../templates/footer.php";
  require_once __DIR__ . "/../templates/authTemplates.php";
  require_once __DIR__ . "/../components/elements/path-to-icons.php";

  $formItems = [
    [
      "type" => "text",
      "id" => "E_Name",
      "label" => "Email or Username :",
      "placeholder" => "Input Yours!",
    ],
    [
      "type" => "password",
      "id" => "password",
      "label" => "Password :",
      "placeholder" => "Password"
    ]
  ];
?>

<?php headerTemplates("Login User"); ?>

  <?php authTemplates(
    "Sign in to your account",
    "login",
    $formItems,
    "Submit",
    "recovery.php",
    "./clients/register.php");
  ?>

  <script type="module">
    const formLogin = document.querySelector("#login");
    formLogin.addEventListener("submit", async (e) => {
      e.preventDefault();
      const E_Name = document.querySelector("#E_Name").value;
      const password = document.querySelector("#password").value;
      try {
        const response = await axios.post("http://localhost:3000/api/user/login", {
          E_Name: E_Name,
          password: password
        }).then(data => data.data);
        if (response.status === 200) {
          Swal.fire({
            icon: "success",
            title: response.message,
            text: "Welcome " + response.data.username,
          });
          await fetch("/frontend/src/auth/save-token.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify({
              token: response.data.token
            })
          });
          const createAt = new Date(response.data.createAt);
          const now = new Date();
          const oneHourInMilliseconds = 1 * 60 * 60 * 1000;
          setTimeout(() => {
            if (now - createAt <= oneHourInMilliseconds) {
              window.location.replace("/frontend/src/pages/first-login.php");
              return;
            }
            if (response.data.role === "ADMIN") {
              window.location.replace("/frontend/src/pages/admin/home.php");
            }
            if (response.data.role === "CLIENT") {
              window.location.replace("/frontend/src/pages/client/landingPage.php");
            }
          }, 2000);
        }
      } catch (error) {
        Swal.fire({
          icon: "error",
          title: error.response.data.errors,
          text: "Something went wrong!",
        });
      }
    });
  </script>

<?php footerTemplates(); ?>