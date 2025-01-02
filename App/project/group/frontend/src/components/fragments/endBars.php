<?php require_once __DIR__ . "/../elements/path-to-icons.php"; ?>

<?php function endBars() { ?>
  <?php
    $items = [
      ["icon" => fn() => searchButtonIcon(), "text" => ""],
      ["icon" => fn() => notificationIcon(), "text" => ""],
    ];
  ?>
  <div class="flex gap-2 items-center">
    <div class="form-control">
      <input type="text" placeholder="Search" class="input input-bordered w-full" />
    </div>
    <?php foreach ($items as $item) : ?>
      <button class="btn btn-ghost btn-circle  text-white">
        <?= $item["icon"](); ?>
        <?= $item["text"]; ?>
      </button>
    <?php endforeach; ?>
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
          <p>Profile</p>
        </li>
        <li>
          <p>Settings</p>
        </li>
        <li id="logout">
          <p>Logout</p>
        </li>
      </ul>
    </div>
  </div>

  <script type="module">
    const logout = document.querySelector("#logout");
    logout.addEventListener("click", async (e) => {
      e.preventDefault();
      const token = "<?= $_SESSION['token'] ?? ''; ?>";
      if (!token) {
        alert("Token tidak ditemukan.");
        return;
      }
      Swal.fire({
        title: "Are you sure?",
        text: "You'll logout from this account?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, logout!"
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            const response = await axios.patch("http://localhost:3000/api/admin/logout", {}, {
              headers: {
                'X-API-TOKEN': `${token}`
              }
            }).then(data => data.data);

            if (response.status === 201) {
              Swal.fire({
                icon: "success",
                title: response.message,
              });

              setTimeout(() => {
                window.location.replace("/frontend/src/auth/destroy-token.php");
              }, 2000);
            }
          } catch (error) {
            console.error(error.response.data.errors);
            Swal.fire({
              icon: "error",
              title: "Logout Failed",
              text: error.response.data.message || "Something went wrong."
            });
          }
        } else {
          Swal.fire({
            title: "Cancelled",
            text: "You are still logged in.",
            icon: "info",
          });
        }
      });
    });
  </script>

<?php } ?>