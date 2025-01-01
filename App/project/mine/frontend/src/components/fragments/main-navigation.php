<?php require_once __DIR__ . "/../elements/path-to-icons.php"; ?>

<?php function mainNavigation() { ?>
  <?php
  $items = [
    ["icon" => fn() => homeIcon(), "text" => "Home", "href" => "./home.php"],
    [
      "text" => "User",
      "icon" => fn() => folderOpenIcon(),
      "subItems" => [
        ["icon" => fn() => userIcon(), "text" => "Admin", "href" => "./admin.php"],
        ["icon" => fn() => usersIcon(), "text" => "Client", "href" => "./client.php"],
      ],
    ],
    [
      "text" => "Crud",
      "icon" => fn() => folderIcon(),
      "subItems" => [
        ["icon" => fn() => userGroupIcon(), "text" => "Artist", "href" => "./artist.php"],
        ["icon" => fn() => archiveBoxIcon(), "text" => "Album", "href" => "./album.php"],
        ["icon" => fn() => musicalNoteIcon(), "text" => "Song", "href" => "./song.php"],
      ],
    ],
    ["icon" => fn() => pencilSquareIcon(), "text" => "Feedback", "href" => "./feedback.php"],
    ["icon" => fn() => creditCardIcon(), "text" => "Subscribe", "href" => "./subscribe.php"],
    ["icon" => fn() => currencyDollarIcon(), "text" => "Premium", "href" => "./premium.php"],
  ];
  ?>
  <div class="font-bold text-black p-2 bg-white">MAIN NAVIGATION</div>
  <ul class="w-full">
    <?php foreach ($items as $item) : ?>
      <li class="font-bold text-white p-2">
        <?php if (isset($item["subItems"])) : ?>
          <div x-data="{ open: false }" class="w-full">
            <button @click="open = !open" class="flex items-center justify-between w-full text-left">
              <span class="flex gap-1 items-center">
                <?= $item["icon"](); ?>
                <?= $item["text"]; ?>
              </span>
              <span x-text="open ? '-' : '+'"></span>
            </button>
            <ul x-show="open" class="pl-4 mt-2 space-y-2 transition-all duration-300">
              <?php foreach ($item["subItems"] as $subItem) : ?>
                <li>
                  <a href="<?= $subItem["href"]; ?>" class="flex gap-1 items-center text-sm">
                    <?= $subItem["icon"](); ?>
                    <?= $subItem["text"]; ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php else : ?>
          <a href="<?= $item["href"] ?? '#'; ?>" class="flex gap-1">
            <?= $item["icon"](); ?>
            <?= $item["text"]; ?>
          </a>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php } ?>