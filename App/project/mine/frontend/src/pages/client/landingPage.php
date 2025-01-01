<?php
  session_start();
  if (!isset($_SESSION['token'])) {
    header("Location: /frontend/src/auth/login.php");
    exit();
  }
  require_once __DIR__ . "/../../templates/header.php";
  require_once __DIR__ . "/../../templates/footer.php";

  require_once __DIR__ . "/../../api/client.php";
  $client = getClientDetails($_SESSION['token'])['data'];
  // var_dump($client);
?>

<?php headerTemplates("Dashboard"); ?>

  <div class="navbar bg-base-100">
    <div class="flex-1">
      <a class="btn btn-ghost text-xl">daisyUI</a>
    </div>
    <div class="flex-none gap-2">
      <div class="form-control">
        <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
      </div>
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
          <li>
            <a href="../client/settings/profile.php">User Profile</a>
          </li>
          <li>
            <a href="../client/settings/settings.php">User Settings</a>
          </li>
          <li>
            <a href="../client/settings/premium.php">Upgrade to Premium</a>
          </li>
          <hr>
          <li id="logout">
            <p>Logout</p>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <script type="module">
    const logout = document.querySelector("#logout");
    logout.addEventListener("click", async (e) => {
      e.preventDefault();
      const token = "<?= $_SESSION['token'] ?? ''; ?>";
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
        if (response.status === 201) {
          Swal.fire({
            icon: "success",
            title: response.message,
          })
          setTimeout(() => {
            window.location.replace("/frontend/src/auth/destroy-token.php");
          }, 2000);
        }
      } catch (error) {
        console.log(error.response.data.errors);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: error.response.data.errors,
        })
      }
    });
  </script>

<?php footerTemplates(); ?>