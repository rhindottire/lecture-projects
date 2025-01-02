<?php
  session_start();
  if (!isset($_SESSION['token'])) {
    header("Location: /frontend/src/auth/login.php");
    exit();
  }
  require_once __DIR__ . "/../templates/header.php";
  require_once __DIR__ . "/../templates/footer.php";
  require_once __DIR__ . "/../templates/authTemplates.php";

  require_once __DIR__ . "/../api/client.php";
  $client = getClientDetails($_SESSION['token'])['data'];

  $formItems = [
    [
      "type" => "text",
      "id" => "name",
      "label" => "Name :",
      "placeholder" => "Your Name",
    ],
    [
      "type" => "gender",
      "id" => "gender",
      "label" => "Gender :",
      "placeholder" => "Your Gender"
    ],
    [
      "type" => "date",
      "id" => "birth-date",
      "label" => "Birth Date :",
      "placeholder" => "Your Birth Date"
    ],
    [
      "type" => "text",
      "id" => "telephone",
      "label" => "Phone Number :",
      "placeholder" => "Your Phone Number"
    ],
    [
      "type" => "file",
      "id" => "profile",
      "label" => "Profile Picture :",
      "placeholder" => "Your Profile Picture"
    ]
  ];
?>

<?php headerTemplates("First Login"); ?>

<?php authTemplates(
  "Edit your Account?",
  "first-login",
  $formItems,
  "Submit",
  "",
  "/frontend/src/pages/client/landingPage.php"
); ?>

  <script type="module">
    const formFirstLogin = document.querySelector("#first-login");
    formFirstLogin.addEventListener("submit", async (e) => {
      e.preventDefault();
      const name = document.querySelector("#name").value;
      const gender = document.querySelector("input[name='gender']:checked").value;
      const birthDate = document.querySelector("#birth-date").value;
      const telephone = document.querySelector("#telephone").value;
      const profile = document.querySelector("#profile").files[0];
      if (telephone.length < 11) {
        Swal.fire({
          icon: "error",
          title: "telephone number must be at least 12 digits",
          text: "Something went wrong!",
        });
        return;
      }
      Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Save",
        denyButtonText: `Don't save`
      }).then( async (result) => {
        if (result.isConfirmed) {
          try {
            const response = await axios.post("http://localhost:3000/api/userFirstLogin", {
              name: name,
              gender: gender,
              birthDate: birthDate,
              telephone: telephone,
              profile: profile
            }, {
              headers: {
                'X-API-TOKEN': '<?= $_SESSION['token'] ?>'
              }
            }).then(data => data.data);
            if (response.status === 201) {
              Swal.fire({
                icon: "success",
                title: response.message,
                text: "Welcome " + response.data.username,
              });
              setTimeout(() => {
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
        } else if (result.isDenied) {
          Swal.fire("Changes are not saved", "", "info");
        }
      });
    });
  </script>

<?php footerTemplates(); ?>