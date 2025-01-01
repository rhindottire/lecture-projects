<?php
  session_start();
  if (!isset($_SESSION["recoveryToken"])) {
    header("Location: /frontend/src/auth/login.php");
    exit();
  }
  require_once __DIR__ . "/../templates/header.php";
  require_once __DIR__ . "/../templates/footer.php";
  require_once __DIR__ . "/../templates/authTemplates.php";
  require_once __DIR__ . "/../components/elements/path-to-icons.php";

  $formItems = [
    [
      "type" => "password",
      "id" => "password",
      "label" => "New Password :",
      "placeholder" => "Enter your New Password"
    ],
    [
      "type" => "password",
      "id" => "newPassword",
      "label" => "Confirm Password :",
      "placeholder" => "Confirm Password"
    ]
  ];
?>

<?php headerTemplates("Reset User"); ?>

  <?php authTemplates(
    "Reset your Password",
    "reset",
    $formItems,
    "Submit",
    "",
    "");
  ?>

  <script type="module">
    const formReset = document.querySelector("#reset");
    formReset.addEventListener("submit", async (e) => {
      e.preventDefault();
      const password = document.querySelector("#password").value;
      const newPassword = document.querySelector("#newPassword").value;
      const recoveryToken = "<?= $_SESSION['recoveryToken'] ?? ""; ?>";
      try {
        const response = await axios.post("http://localhost:3000/api/user/reset", {
          password: password,
          newPassword: newPassword,
          recoveryToken: recoveryToken
        }).then(data => data.data);
        if (response.status === 201) {
          Swal.fire({
            icon: "success",
            title: response.message,
            text: "Welcome " + response.data.username,
          });
          setTimeout(() => {
            window.location.replace("/frontend/src/auth/login.php");
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