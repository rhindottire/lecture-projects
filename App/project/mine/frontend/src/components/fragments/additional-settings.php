<?php require_once __DIR__ . "/../elements/path-to-icons.php"; ?>

<?php function additionalSettings() { ?>
  <?php
    $items = [
      ["icon" => fn() => cog6ToothIcon(), "text" => "Setting", "href" => "./settings.php"],
      ["icon" => fn() => arrowUturnRightIcon(), "text" => "Logout", "href" => "#"],
    ];
  ?>
  <div class="font-bold text-black p-2 bg-white">ADDITIONAL SETTINGS</div>
  <ul>
    <?php foreach ($items as $item) { ?>
      <li class="font-bold text-white p-2 flex gap-1 cursor-pointer <?= $item["text"] ?>">
        <a href="<?= $item["href"]; ?>" class="flex gap-1 items-center text-sm">
          <?= $item["icon"](); ?>
          <?= $item["text"]; ?>
        </a>
      </li>
    <?php } ?>
  </ul>

  <script type="module">
    const logout = document.querySelector(".Logout");
    logout.addEventListener("click", async (e) => {
      e.preventDefault();
      const token = "<?= $_SESSION['token'] ?? ''; ?>";
      // console.log(token);
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