<?php
  require_once __DIR__ . "/../fragments/main-navigation.php";
  require_once __DIR__ . "/../fragments/hero-icon.php";
  require_once __DIR__ . "/../fragments/additional-settings.php";
?>

<?php function sidebar($admin) { ?>
  <div class="relative w-full">
    <div id="sidebar"
      class="w-full h-screen bg-black absolute top-0 left-0 transform transition-transform duration-500"
      :class="{ '-translate-x-full opacity-0': !open, 'translate-x-0 opacity-100': open }">
      <?php
        heroIcon($admin);
        mainNavigation();
        additionalSettings();
      ?>
    </div>
  </div>
<?php } ?>