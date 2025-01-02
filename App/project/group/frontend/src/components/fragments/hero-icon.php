<?php function heroIcon($admin) { ?>
  <h1 class="font-bold text-white p-5 text-center text-xl h-[68px]">
    ABOGO<span class="text-sky-300">BOGA</span>
  </h1>
  <hr>
  <div class="flex">
    <div class="dropdown dropdown-end">
      <div class="btn btn-ghost btn-circle avatar m-3">
        <div class="avatar w-36 rounded-full">
          <img
            alt="Tailwind CSS Navbar component"
            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
        </div>
      </div>
    </div>
    <div class="flex text-white gap-2 items-center">
      <div>
        <p><?= $admin["data"]["username"]; ?></p>
        <p>
          <span
            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-600 text-white">
            <?= $admin["data"]["role"]; ?>
          </span>
        </p>
      </div>
    </div>
  </div>
<?php } ?>