<?php
  require_once __DIR__ . "/../templates/header.php";
  require_once __DIR__ . "/../templates/footer.php";
  require_once __DIR__ . "/../templates/authTemplates.php";
  require_once __DIR__ . "/../components/elements/path-to-icons.php";

  $formItems = [
    [
      "type" => "text",
      "id" => "email",
      "label" => "Email Address :",
      "placeholder" => "Your Email",
    ],
    [
      "type" => "text",
      "id" => "username",
      "label" => "Username :",
      "placeholder" => "Your Username",
    ]
  ];
?>

<?php headerTemplates("Recovery User"); ?>

  <?php authTemplates(
    "Recovery your Password",
    "recovery",
    $formItems,
    "Submit",
    "",
    "login.php");
  ?>

  <script type="module">
    const formRecovery = document.querySelector("#recovery");
    formRecovery.addEventListener("submit", async (e) => {
      e.preventDefault();
      const email = document.querySelector("#email").value;
      const username = document.querySelector("#username").value;
      try {
        const response = await axios.post("http://localhost:3000/api/user/recovery", {
          email: email,
          username: username
        }).then(data => data.data);
        if (response.status === 201) {
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
              recoveryToken: response.data.recoveryToken
            })
          });
          setTimeout(() => {
            window.location.replace("/frontend/src/auth/reset.php");
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