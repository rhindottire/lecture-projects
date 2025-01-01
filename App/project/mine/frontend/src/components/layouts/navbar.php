<?php
  require_once __DIR__ . "/../fragments/endBars.php";
  require_once __DIR__ . "/../fragments/startBars.php";
?>

<?php function navbar($admin) { ?>
  <div id="navbar" class="w-full h-[68px] p-5 bg-black flex justify-between">
    <?php
      startBars();
      endBars($admin);
    ?>
  </div>
<?php } ?>