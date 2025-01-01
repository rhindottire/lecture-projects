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
  require_once __DIR__ . "/../../templates/admin/dashboard.php";

  require_once __DIR__ . "/../../api/admin.php";
  $admins = getAdmins($_SESSION['token']);
  $getAdminById = getAdminById($_SESSION['token']);
  $admin = getAdminDetails($_SESSION['token']);

  require_once __DIR__ . "../../../api/client.php";
  $clients = getClients($_SESSION['token']);
  $clients += [
    'icon' => fn() => usersIcon("size-10"),
    'text' => "ABOGOBOGA Client",
  ];

  require_once __DIR__ . "/../../api/subscribe.php";
  $subscribes = getSubscribes($_SESSION['token']);
  $subscribes += [
    'icon' => fn() => creditCardIcon("size-10"),
    'text' => "ABOGOBOGA Subscriber",
  ];

  require_once __DIR__ . "/../../api/payment.php";
  $payments = getPayments($_SESSION['token']);
  $payments += [
    'icon' => fn() => currencyDollarIcon("size-10"),
    'text' => "Incoming Payments",
  ];

  $artists = [
    'data' => [],
    'icon' => fn() => userGroupIcon("size-10"),
    'text' => "Artists in Application",
  ];
  $albums = [
    'data' => [],
    'icon' => fn() => archiveBoxIcon("size-10"),
    'text' => "Albums in Application",
  ];
  $songs = [
    'data' => [],
    'icon' => fn() => musicalNoteIcon("size-10"),
    'text' => "Songs in Application",
  ];
?>

<?php headerTemplates("Dashboard"); ?>

  <div id="container" x-data="{ open: false }"
    class="grid grid-cols-1 transform transition-transform duration-500 w-full"
    :class="{ 'grid-cols-[1fr_5fr]': open }">
    <?php sidebar($admin); ?>
    <div id="content" class="w-full">
      <?php navbar($admin); ?>
      <?php dashboard($clients, $subscribes, $payments, $artists, $albums, $songs); ?>
    </div>
  </div>

<?php footerTemplates(); ?>