<?php function authTemplates($name, $id, $items, $text, $recovery, $details) { ?>
  <div class="bg-gradient-to-b from-black via-black/50 to-transparent h-[100vh]">
    <div class="flex min-h-min flex-col justify-center px-6 py-8 lg:px-8 text-black">
      <div class="mt-10 w-[550px] mx-auto bg-neutral-50 p-7 rounded-lg shadow-2xl">
        <div class="w-full">
          <h2 class="mb-10 text-center text-2xl/9 font-bold tracking-tight">
            <?= $name; ?>
          </h2>
        </div>
        <form id="<?= $id ?>" class="space-y-6">
          <?php foreach ($items as $item) : ?>
            <?php if ($item['type'] == 'gender'): ?>
              <div class="flex flex-col gap-2">
                <h1><?= $item['label'] ?></h1>
                <div class="flex gap-2">
                  <label for="man">Man</label>
                  <input type="radio" id="man" name="gender" value="MAN">
                  <label for="woman">Woman</label>
                  <input type="radio" id="woman" name="gender" value="WOMAN">
                </div>
              </div>
            <?php else: ?>
              <div class="flex flex-col gap-2">
                <div class="flex justify-between">
                  <label for="<?= $item['id'] ?>">
                    <?= $item['label'] ?>
                  </label>
                  <?php if ($item['type'] == 'password' && $id == 'login'): ?>
                    <div class="text-sm">
                      <a href="<?= $recovery ?>"
                        class="font-semibold text-indigo-600 hover:text-indigo-500">
                          Forgot password?
                      </a>
                    </div>
                  <?php endif; ?>
                </div>
                <input id="<?= $item['id'] ?>"
                  name="<?= $item['id'] ?>"
                  type="<?= $item['type'] ?>"
                  placeholder="<?= $item['placeholder'] ?>"
                  autocomplete="off"
                  class="w-full p-3 border border-gray-400 rounded-md">
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
          <button type="submit"
            class="btn btn-outline bg-black text-white w-full p-3">
            <?= $text ?>
          </button>
          <?php if ($id == 'login') : ?>
            <div class="flex justify-center">
              <p class="text-sm">
                Don't have an account?
                <a href="<?= $details ?>"
                  class="font-semibold text-indigo-600 hover:text-indigo-500">Register
                </a>
              </p>
            </div>
          <?php elseif ($id == 'register') : ?>
            <div class="flex justify-center">
              <p class="text-sm">
                Already have an account?
                <a href="<?= $details ?>"
                  class="font-semibold text-indigo-600 hover:text-indigo-500">Login
                </a>
              </p>
            </div>
          <?php elseif ($id == 'recovery') : ?>
            <div class="flex justify-center">
              <p class="text-sm">
                Back to Sign In |
                <a href="<?= $details ?>"
                  class="font-semibold text-indigo-600 hover:text-indigo-500">Login
                </a>
              </p>
            </div>
          <?php elseif ($id == 'first-login') : ?>
            <div class="flex justify-center">
              <p class="text-sm">
                Not intrested in Editing your profile?
                <a href="<?= $details ?>"
                  class="font-semibold text-indigo-600 hover:text-indigo-500">Skip
                </a>
              </p>
            </div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
<?php } ?>