<?php require_once __DIR__ . "/../elements/path-to-icons.php"; ?>

<?php function startBars() { ?>
  <div @click="open = !open" id="hamburger" class="w-36 flex flex-col gap-1">
    <span class="w-8 h-2 bg-white block transition-all duration-500 origin-top-left"></span>
    <span class="w-8 h-2 bg-white block transition-all duration-500"></span>
    <span class="w-8 h-2 bg-white block transition-all duration-500 origin-top-left"></span>
  </div>
  <div>
    <h1 class="font-bold text-white pb-6 text-xl">DASHBOARD</h1>
  </div>
  <script>
    const hamburger = document.querySelector("#hamburger");
    hamburger.addEventListener("click", () => {
      const span1 = hamburger.children[0];
      const span2 = hamburger.children[1];
      const span3 = hamburger.children[2];
      span1.classList.toggle("rotate-45");
      span2.classList.toggle("opacity-0");
      span3.classList.toggle("-rotate-45");
    });
  </script>
<?php } ?>