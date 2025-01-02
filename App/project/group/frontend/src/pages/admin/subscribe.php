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

  require_once __DIR__ . "/../../api/subscribe.php";
  $subscribes = getSubscribes($_SESSION['token']);

  require_once __DIR__ . "/../../helper/helper.php";
  $data = paginateData($subscribes['data']);
?>

<?php headerTemplates("Feedback Dashboard"); ?>

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
            "payment.client.user.username" => [ "header" => "Subscriber" ],
            "jenis" => [ "header" => "Premium Type" ],
            "startDate" => [ "header" => "Start Date", ],
            "endDate" => [ "header" => "End Date" ],
            "premium" => [ "header" => "Premium" ],
          ],
          $data["offset"],
          [
            [
              "label" => "Details",
              "class" => "btn btn-outline btn-info"
            ],
            [
              "label" => "Delete",
              "class" => "btn btn-outline btn-error"
            ],
          ]
        ) ?>
        <?php pagination($data["totalPages"], $data["currentPage"]); ?>
      </div>
      <?php require_once __DIR__ . "/../../templates/modal.php";
        foreach ($subscribes['data'] as $subscribe)
        { modal($subscribe['id']); } ?>
    </div>
  </div>

<?php footerTemplates(); ?>