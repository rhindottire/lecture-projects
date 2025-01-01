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
require_once __DIR__ . "/../../api/admin.php";
require_once __DIR__ . "/../../api/feedback.php";
require_once __DIR__ . "/../../helper/helper.php";

$admin = getAdminDetails($_SESSION['token']);
$feedbacks = getFeedbacks($_SESSION['token']);
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
      <table class="w-full text-center mt-4 border-collapse border border-gray-300">
        <thead class="bg-black text-white">
          <tr class="hover:text-cyan-500">
            <th class="p-3 border border-gray-300">No</th>
            <th class="p-3 border border-gray-300">Email</th>
            <th class="p-3 border border-gray-300">Username</th>
            <th class="p-3 border border-gray-300">Criticism</th>
            <th class="p-3 border border-gray-300">Admin Reply</th>
            <th class="p-3 border border-gray-300">The Admin</th>
            <th class="p-3 border border-gray-300">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <?php foreach ($data['dataToShow'] as $index => $feedback) : ?>
            <tr class="hover:bg-gray-300">
              <td class="p-2 border border-gray-300"><?= $data['offset'] + $index + 1 ?></td>
              <td class="p-2 border border-gray-300"><?= htmlspecialchars($feedback['client']['user']['email'] ?? '-') ?></td>
              <td class="p-2 border border-gray-300"><?= htmlspecialchars($feedback['client']['user']['username'] ?? '-') ?></td>
              <td class="p-2 border border-gray-300"><?= htmlspecialchars($feedback['criticism'] ?? '-') ?></td>
              <td class="p-2 border border-gray-300"><?= htmlspecialchars($feedback['adminReply'] ?? '') ?></td>
              <td class="p-2 border border-gray-300">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-600 text-white">
                  <?= htmlspecialchars($feedback['admin']['user']['username'] ?? '') ?>
                </span>
              </td>
              <td class="p-2 border border-gray-300">
                <button class="btn btn-outline btn-success" onclick="document.getElementById('modal-reply-<?= $feedback['id'] ?>').showModal()">Reply</button>
                <button class="btn btn-outline btn-warning" onclick="showEditModal('<?= $feedback['id'] ?>')">Edit</button>
                <button class="btn btn-outline btn-error">Delete</button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php pagination($data["totalPages"], $data["currentPage"]); ?>
    </div>

    <!-- Modal dialogs -->
    <?php foreach ($feedbacks['data'] as $feedback) : ?>
      <!-- Reply Modal -->
      <dialog id="modal-reply-<?= $feedback['id'] ?>" class="modal">
        <div class="modal-box">
          <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
          </form>
          <h3 class="text-lg font-bold">Reply to Feedback</h3>
          <p class="py-4">Feedback: <?= htmlspecialchars($feedback['criticism'] ?? '-') ?></p>
          <textarea class="textarea textarea-bordered w-full" placeholder="Write your reply here"></textarea>
          <div class="modal-action">
            <button class="btn btn-success">Submit</button>
            <button class="btn btn-ghost" onclick="document.getElementById('modal-reply-<?= $feedback['id'] ?>').close()">Cancel</button>
          </div>
        </div>
      </dialog>

      <!-- Edit Modal -->
      <dialog id="modal-edit-<?= $feedback['id'] ?>" class="modal">
        <div class="modal-box">
          <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
          </form>
          <h3 class="text-lg font-bold">Edit Feedback</h3>
          <p class="py-4">Edit the details of this feedback:</p>
          <label class="block">
            <span class="label-text">Criticism</span>
            <textarea class="textarea textarea-bordered w-full"><?= htmlspecialchars($feedback['criticism'] ?? '-') ?></textarea>
          </label>
          <label class="block mt-4">
            <span class="label-text">Admin Reply</span>
            <textarea class="textarea textarea-bordered w-full"><?= htmlspecialchars($feedback['adminReply'] ?? '-') ?></textarea>
          </label>
          <div class="modal-action">
            <button class="btn btn-warning">Save Changes</button>
            <button class="btn btn-ghost" onclick="document.getElementById('modal-edit-<?= $feedback['id'] ?>').close()">Cancel</button>
          </div>
        </div>
      </dialog>
    <?php endforeach; ?>
  </div>
</div>

<script>
  function showEditModal(id) {
    const modal = document.getElementById(`modal-edit-${id}`);
    if (modal) {
      modal.showModal();
    } else {
      console.error('Modal not found for ID:', id);
    }
  }
</script>

<?php footerTemplates(); ?>