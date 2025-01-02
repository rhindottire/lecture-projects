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

  require_once __DIR__ . "/../../api/feedback.php";
  $feedbacks = getFeedbacks($_SESSION['token']);
  $adminReply = adminReply($_SESSION['token'], $admin['data']['id']);

  require_once __DIR__ . "/../../helper/helper.php";
  $data = paginateData($feedbacks['data']);
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
            "client.user.email" => [ "header" => "Email" ],
            "client.user.username" => [ "header" => "Username" ],
            "criticism" => [ "header" => "Criticism", ],
            "adminReply" => [ "header" => "Admin Reply" ],
            "admin.user.username" => [
              "header" => "The Admin",
              "class" => "px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-600 text-white"
            ]
          ],
          $data["offset"],
          [
            [
              "label" => "Reply",
              "class" => "btn btn-outline btn-success"
            ],
            [
              "label" => "Edit",
              "class" => "btn btn-outline btn-warning"
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
        foreach ($feedbacks['data'] as $feedback) 
        { modal($feedback['id']); } ?>
    </div>
  </div>

<?php footerTemplates(); ?>