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

<?php headerTemplates("Register Admin"); ?>

<?php authTemplates(
  "Sign Up new Admin",
  "register",
  $formItems,
  "Submit",
  "",
  "");
?>

<script type="module">
  const formRegister = document.querySelector("#register");
  formRegister.addEventListener("submit", async (e) => {
    e.preventDefault();
    const email = document.querySelector("#email").value;
    const username = document.querySelector("#username").value;
    const password = document.querySelector("#password").value;
    try {
      const response = await axios.post("http://localhost:3000/api/adminFirstRegister", {
        email: email,
        username: username,
        password: password
      }).then(data => data.data);
      if (response.status === 201) {
        alert(response.message);
        await axios.post("/frontend/src/auth/save-token.php", {
          token: response.data.token
        });
      }
    } catch (error) {
      alert(error.response.data.errors);
    }
  });
</script>

<?php footerTemplates(); ?>