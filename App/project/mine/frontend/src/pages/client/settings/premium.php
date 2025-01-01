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
// var_dump($client);
?>

<?php headerTemplates("Subscribe Pages", "../../../global/css/style.css"); ?>
<div class="relative isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
  <!-- HEADER -->
  <div class="mx-auto max-w-4xl text-center">
    <p class="mt-2 text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-6xl">
      Unlock exclusive features with a Subscription
    </p>
    <p class="mx-auto mt-6 max-w-2xl text-pretty text-center text-lg font-medium text-gray-600 sm:text-xl/8">
      Select a cost-effective plan designed to captivate your audience, foster customer loyalty, and boost your sales.
    </p>
    <a href="../landingPage.php" class="inline-block rounded-lg bg-indigo-600 px-4 py-2 mt-4 text-white font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      Go Back
    </a>
  </div>
  <!-- Card Plans -->
  <div class="mx-auto mt-16 grid max-w-lg grid-cols-1 items-center gap-y-6 sm:mt-20 sm:gap-y-0 lg:max-w-4xl lg:grid-cols-3">
    <!-- BASIC Plan -->
    <div class="relative rounded-3xl bg-gray-200 p-8 shadow-2xl ring-1 ring-gray-900/10 sm:p-10">
      <form action="" id="basicForm">
        <input type="hidden" id="name" name="name" value="<?= $client['username'] . "_" . 'BASIC' ?>">
        <input type="hidden" id="gross_amount" name="gross_amount" value="5000">
        <input type="hidden" id="username" name="username" value="<?= $client['username'] ?>">
        <input type="hidden" id="email" name="email" value="<?= $client['email'] ?>">
        <input type="hidden" id="telephone" name="telephone" value="<?= $client['telephone'] ?? "-" ?>">>
        <h3 class="text-base/7 font-semibold text-indigo-600">BASIC</h3>
        <p class="mt-4 flex items-baseline gap-x-2">
          <span class="text-5xl font-semibold tracking-tight text-gray-900">IDR 5.000</span>
          <span class="text-base text-gray-500">/day</span>
        </p>
        <p class="mt-6 text-base/7 text-gray-600">The perfect plan if you're just getting started with our product.</p>
        <ul class="mt-8 space-y-3 text-sm/6 text-gray-600 sm:mt-10">
          <li class="flex gap-x-3">
            <?php checkListIcon() ?>
            12 Subscribers
          </li>
          <li class="flex gap-x-3">
            <?php checkListIcon() ?>
            Lyrics Display
          </li>
        </ul>
        <button
          type="submit"
          class="buyBasic mt-8 block rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:mt-10">
          Buy Now!
        </button>
      </form>
    </div>
    <!-- EXPERT Plan -->
    <div class="relative rounded-3xl bg-gray-200 p-8 shadow-2xl ring-1 ring-gray-900/10 sm:p-10">
      <form action="" id="expertForm">
        <input type="hidden" id="name" name="name" value="<?= $client['username'] . "_" . 'EXPERT' ?>">
        <input type="hidden" id="gross_amount" name="gross_amount" value="30000">
        <input type="hidden" id="username" name="username" value="<?= $client['username'] ?>">
        <input type="hidden" id="email" name="email" value="<?= $client['email'] ?>">
        <input type="hidden" id="telephone" name="telephone" value="<?= $client['telephone'] ?? "-" ?>">>
        <h3 class="text-base/7 font-semibold text-indigo-400">EXPERT</h3>
        <p class="mt-4 flex items-baseline gap-x-2">
          <span class="text-5xl font-semibold tracking-tight text-gray-900">IDR 30.000</span>
          <span class="text-base text-gray-500">/week</span>
        </p>
        <p class="mt-6 text-base/7 text-gray-600">The ideal plan for those who need more advanced features.</p>
        <ul class="mt-8 space-y-3 text-sm/6 text-gray-600 sm:mt-10">
          <li class="flex gap-x-3">
            <?php checkListIcon() ?>
            8 Subscribers
          </li>
          <li class="flex gap-x-3">
            <?php checkListIcon() ?>
            Lyrics Display
          </li>
          <li class="flex gap-x-3">
            <?php checkListIcon() ?>
            Create Playlist
          </li>
        </ul>
        <button
          type="submit"
          class="buyExpert mt-8 block rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:mt-10">
          Buy Now!
        </button>
      </form>
    </div>
    <!-- MASTER Plan -->
    <div class="relative rounded-3xl bg-gray-900 p-8 shadow-2xl ring-1 ring-gray-900/10 sm:p-10">
      <form action="" id="masterForm">
        <input type="hidden" id="name" name="name" value="<?= $client['username'] . "_" . 'MASTER' ?>">
        <input type="hidden" id="gross_amount" name="gross_amount" value="100000">
        <input type="hidden" id="username" name="username" value="<?= $client['username'] ?>">
        <input type="hidden" id="email" name="email" value="<?= $client['email'] ?>">
        <input type="hidden" id="telephone" name="telephone" value="<?= $client['telephone'] ?? "-" ?>">
        <h3 class="text-base/7 font-semibold text-indigo-400">MASTER</h3>
        <p class="mt-4 flex items-baseline gap-x-2">
          <span class="text-5xl font-semibold tracking-tight text-white">IDR 100.000</span>
          <span class="text-base text-gray-400">/month</span>
        </p>
        <p class="mt-6 text-base/7 text-gray-300">Admin Recomendation</p>
        <ul class="mt-8 space-y-3 text-sm/6 text-gray-300 sm:mt-10">
          <li class="flex gap-x-3">
            <?php checkListIcon() ?>
            22 Subscribers
          </li>
          <li class="flex gap-x-3">
            <?php checkListIcon() ?>
            Lyrics Display
          </li>
          <li class="flex gap-x-3">
            <?php checkListIcon() ?>
            Create Playlist
          </li>
          <li class="flex gap-x-3">
            <?php checkListIcon() ?>
            Download Lagu
          </li>
        </ul>
        <button
          type="submit"
          class="buyMaster mt-8 block rounded-md bg-indigo-500 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 sm:mt-10">
          Buy Now!
        </button>
      </form>
    </div>
  </div>
</div>

<div class="relative isolate overflow-hidden bg-gray-900 py-16 sm:py-24 lg:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2">
      <!-- Chat Admin -->
      <div class="form-container max-w-xl lg:max-w-lg">
        <form action="" id="chatAdminForm">
          <!-- berikan input tipe hidden untuk items -->
          <!-- JSON.stringify -->
          <input type="hidden" name="username" id="username" value="<?= $client['username'] ?>">
          <input type="hidden" name="email" id="email" value="<?= $client['email'] ?>">
          <input type="hidden" name="telephone" id="telephone" value="<?= $client['telephone'] ?? "-" ?>">
          <h2 class="text-4xl font-semibold tracking-tight text-white">
            Subscribe to unlock premium features.
          </h2>
          <p class="mt-4 text-lg text-gray-300">
            Having trouble with your payment? Our dedicated support team is here to help. Reach out to resolve any issues promptly and ensure a seamless payment experience
          </p>
          <div class="mt-6 flex max-w-md gap-x-4">
            <button
              type="submit"
              class="Contact-Admin disabled flex-none rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
              Contact Admin
            </button>
          </div>
        </form>
      </div>
      <!-- More Pages -->
      <div class="grid grid-cols-1 gap-x-8 gap-y-10 sm:grid-cols-2 lg:pt-2">
        <div class="flex flex-col items-start">
          <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
            <?php weeklyArticlesIcon() ?>
          </div>
          <h3 class="mt-4 text-base font-semibold text-white">Weekly Updates</h3>
          <p class="mt-2 text-base/7 text-gray-400">
            View your subscription history
            <a href="settings.php" class="text-blue-500 hover:underline">here</a>
          </p>
        </div>
        <div class="flex flex-col items-start">
          <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
            <?php noSpamIcon() ?>
          </div>
          <h3 class="mt-4 text-base font-semibold text-white">No Spam Policy</h3>
          <p class="mt-2 text-base/7 text-gray-400">
            Report bugs and issues
            <a href="feedback.php" class="text-blue-500 hover:underline">here</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Waves -->
  <div class="waves-container">
    <?php wavesIcon() ?>
  </div>
</div>

<script>
  async function handleFormSubmit(form, paymentType) {
    const formData = new FormData(form);
    const data = new URLSearchParams(formData);
    try {
      const response = await fetch("/frontend/php/placeOrder.php", {
        method: "POST",
        body: data
      });
      const token = await response.text();
      const payment = await axios.post('http://localhost:3000/api/payment', {
        nominal: parseInt(form.gross_amount.value)
      }, {
        headers: {
          'X-API-TOKEN': '<?= $_SESSION['token'] ?>'
        }
      }).then(res => res.data);
      window.snap.pay(token, {
        onSuccess: async function(result) {
          // create
          try {
            await axios.post('http://localhost:3000/api/subscribe', {
              paymentId: parseInt(payment.data.id),
              jenis: paymentType,
            }, {
              headers: {
                "X-API-TOKEN": "<?= $_SESSION['token'] ?>"
              }
            });
            Swal.fire({
              icon: "success",
              title: "Payment Success",
              text: "Thank you for your payment",
              showConfirmButton: false,
              timer: 1500,
            });
          } catch (error) {
            console.log(error.response.data.errors);
          }
        },
        onPending: function(result) {
          // deleted
          Swal.fire({
            icon: "info",
            title: "Payment Pending",
            text: "The payment wasn't completed",
            showConfirmButton: false,
            timer: 1500,
          });
        },
        onError: function(result) {
          // failed
          Swal.fire({
            icon: "error",
            title: "Payment Failed",
            text: "The payment couldn't be completed because the time limit was exceeded",
            showConfirmButton: false,
            timer: 1500,
          });
        },
        onClose: function() {
          // deleted
          Swal.fire({
            icon: "question",
            title: "Payment Session Closed",
            text: "You exited the payment page. Please try again to complete the transaction.",
            showConfirmButton: false,
            timer: 1500,
          });
        },
      });
    } catch (error) {
      console.log(error);
    }
  }
  document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const formId = form.id;
      const paymentType = formId === "basicForm" ? "BASIC" :
        formId === "expertForm" ? "EXPERT" :
        "MASTER";
      handleFormSubmit(form, paymentType);
    });
  });

  const chatAdminForm = document.querySelector("#chatAdminForm");
  const contactAdmin = document.querySelector(".Contact-Admin");
  chatAdminForm.addEventListener("submit", (e) => {
    e.preventDefault();
    formData = new FormData(chatAdminForm);
    const data = new URLSearchParams(formData);
    const objData = Object.fromEntries(data);
    console.log(objData);
    const phoneNumber = "6281233261246";
    const message = formatMessage(objData);
    const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
    window.open(url, '_blank');
  });
  const formatMessage = (obj) => {
    return `Hello Admin RIDHO,\n\n` +
      `I am a client from the ABOGOBOGA application. Please find my details below:\n\n` +
      `• Username: ${obj.username}\n` +
      `• Email: ${obj.email}\n` +
      `• Phone Number: ${obj.telephone}\n\n` +
      `I need assistance with subscribing to the Premium plan. Looking forward to your support.\n\n` +
      `Best regards,\n` +
      `${obj.username}`;
  };
  // ${JSON.parse(obj.items).map((item) => {
  //   return `- ${item.name} (${item.quantity})}`
  // }).join("\n")}
</script>


<?php footerTemplates(); ?>