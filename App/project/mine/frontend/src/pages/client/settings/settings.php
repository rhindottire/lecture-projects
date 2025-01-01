<?php
  session_start();
  if (!isset($_SESSION['token'])) {
    header("Location: /frontend/src/auth/login.php");
    exit();
  }
  require_once __DIR__ . "/../../../templates/header.php";
  require_once __DIR__ . "/../../../templates/footer.php";
  require_once __DIR__ . "/../../../components/elements/path-to-icons.php";

  require_once __DIR__ . "/../../../api/client.php";
  $client = getClientDetails($_SESSION['token'])['data'];
?>

<?php headerTemplates("User Settings"); ?>

  <div class="container bg-black w-full h-screen">

    <div class="flex justify-around items-center w-full h-[68px]">
      <div class="title">
        <h1 class="text-white font-bold text-3xl">
          ABOGO<span class="text-blue-400">BOGA</span>
        </h1>
      </div>
      <div class="flex gap-2 items-center">
        <a href="premium.php" class="text-white font-bold">Premium</a>
        <a href="feedback.php" class="text-white font-bold">Feedback</a>
        <a href="#" class="text-white font-bold">Settings</a></a>
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
            <li>
              <a href="../../auth/destroy-token.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <hr>
    <div class="content">
      <div class="w-1/2 mx-auto mt-10 gap-5 flex  bg-zinc-800 rounded-md">
        <div>
          <div class="m-2 rounded-md w-[150px] h-[100px]">
            <a href="https://www.instagram.com/rhindottire/">
              <img src="https://static-00.iconduck.com/assets.00/typescript-icon-icon-2048x2048-2rhh1z66.png" alt="" class="w-auto h-auto rounded-xl">
            </a>
          </div>
        </div>
        <div>
          <h1 class="font-bold text-white p-2 mt-2">Daily / Weekly / Monthly
            <span class="text-blue-400">Subscribtion</span>
          </h1>
          <p class="text-white p-2">Subscribe now and enjoy exclusive benefits! Get access to premium content, special offers, and so much more just for you.</p>
          <a href="premium.php" class="btn btn-outline btn-info mb-2">Subscribe Now!</a>
        </div>
      </div>
    </div>
    <div class="w-1/2 mx-auto mt-10 gap-2 flex flex-col bg-zinc-800 rounded-md">
      <h1 class="font-bold text-white p-4 text-3xl">Your History</h1>
      <hr>
      <div class="p-2">
        <h1 class="font-bold text-white">
          <a href="historyFeedback.php" class="flex gap-2 p-1">
            <?php pencilSquareIcon() ?>Feedback
          </a>
        </h1>
        <h1 class="font-bold text-white">
          <a href="historySubscribe.php" class="flex gap-2 p-1">
            <?php creditCardIcon() ?> Subscribe
          </a>
        </h1>
      </div>
    </div>
    <div class="w-1/2 mx-auto mt-10 gap-2 flex flex-col bg-zinc-800 rounded-md">
      <h1 class="font-bold text-white p-4 text-3xl">Account</h1>
      <hr>
      <div class="font-bold text-white p-2">
        <h1 class="font-bold text-white">
          <a href="profile.php" class=" flex gap-2 p-1">
            <?php userIcon() ?>Edit Profile
          </a>
        </h1>
        <h1 class="font-bold text-white">
          <a href="../../../auth/destroy-token.php" class="flex gap-2 p-1">
            <?php arrowUturnRightIcon() ?>Logout
          </a>
        </h1>
      </div>
    </div>
  </div>

  <script type="module">
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
            window.location.replace("/frontend/src/auth/destroy-token.php");
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