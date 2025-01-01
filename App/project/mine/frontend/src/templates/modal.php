<?php require_once __DIR__ . "../../api/feedback.php"; ?>

<?php function modal($id) { ?>
  <?php $feedback = getFeedbackById($_SESSION['token'], $id)['data']; ?>
  <dialog id="modal_<?= $id ?>" class="modal">
    <div class="modal-box relative">
      <!-- Close Button -->
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 bg-red-600 text-white">✕</button>
      </form>

      <!-- Modal Header -->
      <h3 id="modal-header" class="text-lg font-bold mb-4"></h3>

      <!-- Modal Form -->
      <form id="modal-form" method="POST">
        <div>
          <label for="<?= $feedback['client']['user']['username'] ?>">Username</label>
          <input type="text" id="<?= $feedback['client']['user']['username'] ?>" name="username" value="<?= $feedback['client']['user']['username'] ?>" readonly>
        </div>

        <div>
          <label for="<?= $feedback['client']['user']['email'] ?>">Email</label>
          <input type="email" id="<?= $feedback['client']['user']['email'] ?>" name="email" value="<?= $feedback['client']['user']['email'] ?>" readonly>
        </div>

        <div>
          <label for="criticism">Criticism</label>
          <input type="text" id="criticism" name="criticism" value="<?= $feedback['criticism'] ?>" readonly>
        </div>

        <div>
          <label for="adminReply">Admin Reply</label>
          <input type="text" id="adminReply" name="adminReply" value="<?= $feedback['adminReply'] ?? "" ?>">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-outline btn-success mt-4">
          Submit
        </button>
      </form>
    </div>
  </dialog>
<?php } ?>