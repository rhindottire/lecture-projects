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

require_once __DIR__ . "/../../api/client.php";
$clients = getClients($_SESSION['token']);
// var_dump($clients);
// $getClientById = getClientById($_SESSION['token'], $id);

require_once __DIR__ . "/../../helper/helper.php";
$data = paginateData($clients['data']);
?>

<?php headerTemplates("Client Dashboard"); ?>

<div id="container" x-data="{ open: false }"
  class="grid grid-cols-1 transform transition-transform duration-500 w-full"
  :class="{ 'grid-cols-[1fr_5fr]': open }">
  <?php sidebar($admin); ?>
  <div id="content" class="w-75">
    <?php navbar($admin); ?>
    <div class="container px-4">
      <?php tableContainer(
        $data["dataToShow"],
        [
          "email" => ["header" => "Email"],
          "username" => ["header" => "Username"],
          "createAt" => ["header" => "Created At"],
          "role" => ["header" => "Role"],
          "token" => ["header" => "Activity"],
        ],
        $data["offset"],
        [
          [
            "label" => "Details",
            "class" => "btn btn-outline btn-info",
            "onclick" => "my_modal_1.showModal()"
          ],
          [
            "label" => "Delete",
            "class" => "btn btn-outline btn-error",
            "onclick" => "my_modal_1.showModal()"
          ],
        ]
      ) ?>
      <?php pagination($data["totalPages"], $data["currentPage"]) ?>
    </div>
  </div>
</div>
<dialog id="my_modal_1" class="modal">
  <div class="modal-box">
    <h3 id="name" class="text-lg font-bold">Hello!</h3>
    <p class="py-4">Press ESC key or click the button below to close</p>
    <div class="modal-action">
      <form method="dialog">
        <!-- if there is a button in form, it will close the modal -->
        <button class="btn">Close</button>
      </form>
    </div>
  </div>
</dialog>
<script>
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn')) {
      let clients = <?= json_encode($clients); ?>;
      let clientId = e.target.id;
      let client;
      clients.data.map(client => {
        if (client.id == clientId) {
          client = client;
        }
      });
      console.log(client);
      if (e.target.classList.contains('btn-info')) {
        let name = document.getElementById('name');
        name.innerHTML = Hello, $ {
          client.username
        };
      } else if (e.target.classList.contains('btn-error')) {
        // alert("Delete");
      }
    }
  });
</script>

<?php footerTemplates();?>