<?php
session_start();
if (!isset($_SESSION['token'])) {
  header("Location: /frontend/src/auth/login.php");
  exit();
}
require_once __DIR__ . "/../../templates/header.php";
require_once __DIR__ . "/../../templates/footer.php";
require_once __DIR__ . "/../../components/layouts/sidebar.php";
require_once __DIR__ . "/../../components/layouts/navbar.php";
require_once __DIR__ . "/../../templates/admin/pagination.php";
require_once __DIR__ . "/../../templates/admin/tabel.php";

require_once __DIR__ . "/../../api/admin.php";
$admin = getAdminDetails($_SESSION['token']);
$admins = getAdmins($_SESSION['token']);
$getAdminById = getAdminById($_SESSION['token']);

require_once __DIR__ . "/../../helper/helper.php";
$data = paginateData($admins['data']);

$conn = mysqli_connect("localhost", "root", "", "abogoboga");
$getServerStatus = mysqli_query($conn, "SELECT * FROM server");
$serverStatus = mysqli_fetch_assoc($getServerStatus);

if (isset($_POST['onButton'])) {
  mysqli_query($conn, "UPDATE server SET status = 'ONLINE'");
  header("Location: /frontend/src/pages/admin/settings.php");
}

if (isset($_POST['offButton'])) {
  // var_dump("OFF");die;
  mysqli_query($conn, "UPDATE server SET status = 'OFFLINE'");
  header("Location: /frontend/src/pages/admin/settings.php");
}
?>

<?php headerTemplates("Admin Dashboard"); ?>

<div id="container" x-data="{ open: false }"
  class="grid grid-cols-1 transform transition-transform duration-500 w-full"
  :class="{ 'grid-cols-[1fr_5fr]': open }">
  <?php sidebar($admin); ?>
  <div id="content" class="w-75">
    <?php navbar($admin); ?>
    <div class="container px-4">
      <table class="table-auto border-collapse border border-gray-300 w-full mt-4 text-left text-xl">
        <thead class="bg-black text-white">
          <tr>
            <th class="border border-gray-300 px-4 py-2">Server Name</th>
            <th class="border border-gray-300 px-4 py-2">Server Status</th>
            <th class="border border-gray-300 px-4 py-2">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="hover:bg-gray-50">
            <td class="border border-gray-300 px-4 py-2 font-bold text-black h-[68px]">
              ABOGO<span class="text-sky-400">BOGA</span>
            </td>
            <td class="border border-gray-300 px-4 py-2">
              <?php if ($serverStatus['status'] == "OFFLINE") : ?>
                <span class="p-2 inline-flex leading-5 font-semibold rounded-md bg-red-600 text-white">
                  Offline
                </span>
              <?php else : ?>
                <span class="p-2 inline-flex leading-5 font-semibold rounded-md bg-green-600 text-white">
                  Online
                </span>
              <?php endif ?>
            </td>
            <td class="border border-gray-300 px-4 py-2">
              <?php if ($serverStatus['status'] == "OFFLINE") : ?>
                <form action="" method="post" id="onButton">
                  <button type="submit" name="onButton" class="btn btn-success text-white">ON</button>
                </form>
              <?php else : ?>
                <form action="" method="post" id="offButton">
                  <button type="submit" name="offButton" class="btn btn-error text-white">OFF</button>
                </form>
              <?php endif ?>
            </td>
          </tr>
        </tbody>
        <tfoot class="bg-gray-100 text-black">
          <tr>
            <td colspan="3" class="border border-gray-300 px-4 py-2 text-center">
              230411100197@student.trunojoyo.ac.id
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<!-- <script>
  const onButton = document.querySelector("#onButton");
  onButton.addEventListener("click", async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post("http://localhost:3000/api/serverOnline", {
        headers: {
          'X-API-TOKEN': '<?= $_SESSION['token'] ?>'
        },
      });
      const data = await response.json();
      console.log(data);
    } catch (error) {
      console.error(error);
    }
  });

  const offButton = document.querySelector("#offButton");
  offButton.addEventListener("click", async (e) => {
    e.preventDefault();
    const response = await fetch("http://localhost:3000/api/serverOffline", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.json();
    console.log(data);
  });
</script> -->

<?php footerTemplates(); ?>