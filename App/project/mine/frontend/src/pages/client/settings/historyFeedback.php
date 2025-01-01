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
  // var_dump($client['id']);die;
  $conn = mysqli_connect('localhost','root','','abogoboga');
  $userFeedback = mysqli_query($conn, "SELECT * FROM feedback
  JOIN clients ON feedback.clientId = clients.id
  JOIN users ON users.id = clients.userId
  WHERE clients.userId = {$client['id']}");
  // var_dump($client['id']);
  // var_dump(mysqli_num_rows($userFeedback));die;
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
        <a href="settings.php" class="text-white font-bold">Settings</a></a>
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
    <div class="w-1/2 mx-auto mt-10 gap-2 flex flex-col bg-zinc-800 rounded-md">
      <h1 class="font-bold text-white p-4 text-3xl">Feedback History</h1>
      <hr>
      <div class="overflow-x-auto">
        <?php if(mysqli_num_rows($userFeedback) == 0) : ?>
          <h1 class="text-white text-center my-5">No feedback given yet.</h1>
        <?php else : ?>
        <table class="table">
          <thead>
            <tr class="border-0">
              <th class="text-white">No.</th>
              <th class="text-white">Kritik</th>
              <th class="text-white">Saran</th>
              <th class="text-white">Rating</th>
              <th class="text-white">Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php if(mysqli_num_rows($userFeedback) == 0) : ?>
              <h1 class="text-white text-center mt-5">No feedback given yet.</h1>
            <?php else : ?>
              <?php foreach(mysqli_fetch_all($userFeedback, MYSQLI_ASSOC) as $no => $data) : ?>
              <tr class="border-0">
                <td class="text-white"><?= $no + 1 ?></td>
                <td class="text-white"><?= $data['criticism'] ?></td>
                <td class="text-white"><?= $data['suggestion'] ?></td>
                <td class="text-white"><?= $data['rating'] ?></td>
                <td class="text-white">
                  <button class="btn btn-warning">Edit</button>
                </td>
              </tr>
              <?php endforeach ?>
            <?php endif ?>
          </tbody>
        </table>
        <?php endif ?>
      </div>
    </div>
    </div>
  </div>

<?php footerTemplates(); ?> 