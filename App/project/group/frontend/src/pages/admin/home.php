<?php
session_start();
if (!isset($_SESSION['token'])) {
  header("Location: ../auth/login.php");
  exit();
}

require_once __DIR__ . "/../../templates/header.php";
require_once __DIR__ . "/../../templates/footer.php";
require_once __DIR__ . "/../../components/layouts/sidebar.php";
require_once __DIR__ . "/../../components/layouts/navbar.php";

require_once __DIR__ . "/../../templates/admin/dashboard.php";
require 'config.php';

$total_artis = query("SELECT COUNT(*) AS total FROM artis")[0]['total'];
$total_album = query("SELECT COUNT(*) AS total FROM album")[0]['total'];
$total_lagu = query("SELECT COUNT(*) AS total FROM musik")[0]['total'];

$data_history = query("SELECT aksi, tanggal FROM history ORDER BY tanggal DESC LIMIT 10");

require_once __DIR__ . "/../../api/admin.php";
$admins = getAdmins($_SESSION['token']);
$getAdminById = getAdminById($_SESSION['token']);
$admin = getAdminDetails($_SESSION['token']);

require_once __DIR__ . "../../../api/client.php";
$clients = getClients($_SESSION['token']);

$clients['icon'] = fn() => usersIcon("size-10");
$clients['text'] = "Total Client";

$subscriber['data'] = [];
$subscriber['icon'] = fn() => creditCardIcon("size-10");
$subscriber['text'] = "Total Subscriber";

$payments['data'] = [];
$payments['icon'] = fn() => currencyDollarIcon("size-10");
$payments['text'] = "Incoming Payments";
?>
<?php headerTemplates("Dashboard"); ?>

<!-- Tambahkan Font Awesome untuk ikon -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<style>
  /* Card Container */
  .stats-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    padding: 0;
    padding-left: 1.3rem;
    padding-right: 1.3rem;
  }

  /* Card Styles */
  .stat-card {
    background-color: black;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: left;
    display: flex;
    align-items: center;
    justify-content: flex-start;
  }

  .stat-card .icon {
    font-size: 2rem;
    color: rgb(255, 255, 255);
    margin-right: 1rem;
    margin-left: 1.3rem;
  }

  .stat-card h2 {
    font-size: 1rem;
    font-weight: 450;
    color: #fff;
    margin-bottom: 0.5rem;
    margin-top: 0.75rem;
  }

  .stat-card p {
    font-size: 1.1rem;
    font-weight: 450;
    color: #fff;
  }

  /* Hover effect for cards */
  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  /* History Section */
  .history-container {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    background: rgb(216, 212, 212);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 97.5%;
    /* Memastikan lebar penuh */
    margin: 0 auto;
    /* Menjaga agar berada di tengah */
    margin-top: 15px;
    margin-left: 1.3rem;
    margin-right: 1.3rem;
  }

  .history-container h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
    color: #333;
  }

  .history-container ul {
    list-style: none;
    padding: 0;
    margin: 0;
    width: 100%;
    /* Menjamin lebar penuh untuk list */
  }

  .history-container li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    padding: 10px 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    /* Memastikan lebar penuh untuk setiap item */
  }

  .history-container li span {
    flex-grow: 1;
    text-align: left;
    padding-left: 15px;
    font-size: 1.2rem;
    width: 100%;
    /* Pastikan span memanfaatkan lebar penuh */
  }

  .history-container ul li:last-child {
    border-bottom: none;
  }

  .history-container ul li:hover {
    background-color: #f1f1f1;
  }

  /* Gaya tombol delete */
  .delhistory {
    color: black;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
    margin-left: auto;
    margin-right: 10px;
    font-weight: bold;
  }

  .delhistory:hover {
    background-color:#c0392b;
  }

  .clear-history-btn {
    background-color: #1db954;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 10px;
  }

  .clear-history-btn:hover {
    background-color: #c0392b;
  }
</style>

<div id="container" x-data="{ open: false }"
  class="grid grid-cols-1 transform transition-transform duration-500 w-full"
  :class="{ 'grid-cols-[1fr_5fr]': open }">
  <?php sidebar($admin); ?>
  <div id="content" class="w-full">
    <?php navbar($admin); ?>
    <?php dashboard($clients, $subscriber, $payments); ?>
    <div class="stats-container">
      <!-- Total Artis Card -->
      <div class="stat-card">
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
        <div>
          <h2>Total Artis</h2>
          <p><?= htmlspecialchars($total_artis); ?></p>
        </div>
      </div>

      <!-- Total Album Card -->
      <div class="stat-card">
        <div class="icon">
          <i class="fas fa-music"></i>
        </div>
        <div>
          <h2>Total Album</h2>
          <p><?= htmlspecialchars($total_album); ?></p>
        </div>
      </div>

      <!-- Total Lagu Card -->
      <div class="stat-card">
        <div class="icon">
          <i class="fas fa-headphones-alt"></i>
        </div>
        <div>
          <h2>Total Lagu</h2>
          <p><?= htmlspecialchars($total_lagu); ?></p>
        </div>
      </div>
    </div>

    <div class="history-container">
      <h2>Riwayat Aktivitas</h2>
      <form method="POST" action="hapusfull_his.php">
        <button type="submit" class="clear-history-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus semua riwayat?')">Clear Riwayat</button>
      </form>
      <ul>
        <?php foreach ($data_history as $history): ?>
          <li>
            <span>
              <?= htmlspecialchars($history['aksi']); ?> pada <?= htmlspecialchars(date("d M Y H:i", strtotime($history['tanggal']))); ?>
            </span>
            <form method="POST" action="hapus_history.php" style="display:inline;">
              <input type="hidden" name="tanggal" value="<?= htmlspecialchars($history['tanggal']); ?>">
              <button type="submit" class="delhistory" onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?')">X</button>
            </form>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<?php footerTemplates(); ?>