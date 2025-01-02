<?php function pagination(&$totalPages, &$currentPage) { ?>
  <div class="flex justify-center mt-4">
    <ul class="flex pagination gap-2">
      <?php if ($currentPage > 1) : ?>
        <li><a href="?page=<?= $currentPage - 1 ?>" class="btn btn-outline">Prev</a></li>
      <?php endif; ?>
      <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
        <li>
          <a href="?page=<?= $page ?>" class="btn btn-outline <?= $page == $currentPage ? 'btn-primary' : '' ?>">
            <?= $page ?>
          </a>
        </li>
      <?php endfor; ?>
      <?php if ($currentPage < $totalPages) : ?>
        <li><a href="?page=<?= $currentPage + 1 ?>" class="btn btn-outline">Next</a></li>
      <?php endif; ?>
    </ul>
  </div>
<?php } ?>