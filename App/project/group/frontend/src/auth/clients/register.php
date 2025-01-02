<?php
  require_once __DIR__ . "/../../templates/header.php";
  require_once __DIR__ . "/../../templates/footer.php";
  require_once __DIR__ . "/../../templates/authTemplates.php";

  $formItems = [
    [
      "type" => "text",
      "id" => "email",
      "label" => "Email :",
      "placeholder" => "Enter your Email",
    ],
    [
      "type" => "text",
      "id" => "username",
      "label" => "Username :",
      "placeholder" => "Enter your Username",
    ],
    [
      "type" => "password",
      "id" => "password",
      "label" => "Password :",
      "placeholder" => "Enter your Password"
    ]
  ];
?>

<?php headerTemplates("Register Client"); ?>

<?php authTemplates(
  "Sign up your account",
  "register",
  $formItems,
  "Submit",
  "",
  "../login.php");
?>

<script type="module">
  const formRegister = document.querySelector("#register");
  formRegister.addEventListener("submit", async (e) => {
    e.preventDefault();
    const email = document.querySelector("#email").value;
    const username = document.querySelector("#username").value;
    const password = document.querySelector("#password").value;
    try {
      const response = await axios.post("http://localhost:3000/api/client/register", {
        email: email,
        username: username,
        password: password
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