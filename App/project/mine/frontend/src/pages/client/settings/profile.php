<?php
  session_start();
  if (!isset($_SESSION['token'])) {
    header("Location: /frontend/src/auth/login.php");
    exit();
  }
  require_once __DIR__ . "/../../../templates/header.php";
  require_once __DIR__ . "/../../../templates/footer.php";

  require_once __DIR__ . "/../../../api/client.php";
  $client = getClientDetails($_SESSION['token'])['data'];
  // var_dump($client);
?>

<?php headerTemplates("Edit Profile"); ?>

  <div class="container bg-black w-full h-screen">
    <div class="flex justify-around items-center w-full h-[68px]">
      <div class="title">
        <h1 class="text-white font-bold text-3xl">
          ABOGO<span class="text-sky-300">BOGA</span>
        </h1>
      </div>
      <div class="flex gap-2 items-center">
        <h1 class="text-white font-bold">
          <a href="premium.php">Premium</a>
        </h1>
        <h1 class="text-white font-bold">
          <a href="feedback.php">Feedback</a>
        </h1>
        <h1 class="text-white font-bold">
          <a href="settings.php">Settings</a>
        </h1>
        <span class="text-white font-bold text-3xl">|</span>
        <div class="dropdown dropdown-end">
          <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
            <div class="w-10 rounded-full">
              <img
                alt="Tailwind CSS Navbar component"
                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
            </div>
          </div>
          <ul
            tabindex="0"
            class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
            <li id="logout">
              <p>logout</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <hr>
    <div class="content">
      <div class="flex w-1/2 mx-auto mt-10 flex flex col">
        <h1 class="font-bold text-white p-2 text-3xl">Edit Profile</h1>
      </div>
      <form action="" id="editProfile">
        <div class="flex w-1/2 mx-auto mt-10 gap-5 flex flex-col rounded-md">
          <label for="email" class="text-white font-bold p-2">Email</label>
          <input type="email" name="email" id="email" value="<?= $client['email'] ?>" class="rounded-md p-2" autocomplete="off" placeholder="Email">
          <label for="username" class="text-white font-bold p-2">Username</label>
          <input type="text" name="username" id="username" value="<?= $client['username'] ?>" class="rounded-md p-2 " autocomplete="off" placeholder="Username">
          <label for="password" class="text-white font-bold p-2">Password</label>
          <input type="password" name="password" id="password" class="rounded-md p-2" autocomplete="off" placeholder="Password">
          <h1 class="text-white font-bold p-2">More
            <a href="details.php" class="text-sky-500">Settings</a>
          </h1>
          <button type="submit" class="bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script type="module">
    const formEditProfile = document.querySelector("#editProfile");
    formEditProfile.addEventListener("submit", async (e) => {
      e.preventDefault();
      const email = document.querySelector("#email").value;
      const username = document.querySelector("#username").value;
      const password = document.querySelector("#password").value;
      Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Save",
        denyButtonText: `Don't save`
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            const response = await axios.patch("http://localhost:3000/api/client/update", {
              email: email,
              username: username,
              password: password
            }, {
              headers: {
                'X-API-TOKEN': '<?= $_SESSION['token'] ?>'
              }
            }).then(data => data.data);
            console.log(response);
            if (response.status === 201) {
              // alert(response.message);
              Swal.fire({
                icon: "success",
                title: response.message,
              });
            }
          } catch (error) {
            // console.error(error.response.data.errors);
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

    const logout = document.querySelector("#logout");
    logout.addEventListener("click", async (e) => {
      e.preventDefault();
      const token = "<?= $_SESSION['token'] ?? ''; ?>";
      // console.log(token);
      if (!token) {
        alert("Token not found.");
        return;
      }
      try {
        const response = await axios.patch("http://localhost:3000/api/client/logout", {}, {
          headers: {
            'X-API-TOKEN': `${token}`
          }
        }).then(data => data.data);
        // console.log(response);
        if (response.status === 201) {
          // alert(response.message);
          Swal.fire({
            icon: "success",
            title: response.message,
          })
          setTimeout(() => {
            window.location.replace("http://abogoboga.test:8000/frontend/src/auth/destroy-token.php");
          }, 2000);
        }
      } catch (error) {
        // console.log("Error:", error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: error.response.data.errors,
        })
      }
    });
  </script>

<?php footerTemplates(); ?>