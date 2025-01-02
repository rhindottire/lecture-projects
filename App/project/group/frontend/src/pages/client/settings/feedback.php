<?php
session_start();
if (!isset($_SESSION['token'])) {
  header("Location: ../../auth/login.php");
  exit();
}
require_once "../../../templates/header.php";
headerTemplates("Feedback Page");

require_once __DIR__ . "/../../../api/client.php";
$client = getClientDetails($_SESSION['token']);
var_dump($client);

// require_once __DIR__ . "/../../../api/feedback.php";
// $createdFeedbacks = createFeedback($_SESSION['token'], $client['id']);
// var_dump($createdFeedbacks);
?>

<div class="container bg-black w-full h-screen">
  <div class="flex justify-around items-center w-full h-[68px]">
    <div class="title">
      <h1 class="text-white font-bold text-3xl">
        ABOGO<span class="text-sky-300">BOGA</span>
      </h1>
    </div>
    <div class="flex gap-2 items-center">
      <h1 class="text-white font-bold">
        <a href="premium.php">Premium</a>
      </h1>
      <h1 class="text-white font-bold">
        <a href="feedback.php">Feedback</a>
      </h1>
      <h1 class="text-white font-bold">
        <a href="settings.php">Settings</a>
      </h1>
      <span class="text-white font-bold text-3xl">|</span>
      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img
              alt="Tailwind CSS Navbar component"
              src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
          </div>
        </div>
        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
          <li>
            <a href="../../../auth/destroy-token.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <hr>
  <div class="content">
    <div class="flex w-1/2 mx-auto mt-10 flex flex col">
      <h1 class="font-bold text-white p-2 text-3xl">Feedback to Admin</h1>
    </div>
    <form action="" id="formCriticism">
      <div class="flex w-1/2 mx-auto mt-10 gap-5 flex flex-col rounded-md">
        <label for="criticism" class="text-white font-bold p-2">Criticism</label>
        <input type="text" name="criticism" id="criticism" class="rounded-md p-2" placeholder="Maximum 100 characters">
        <label for="suggestion" class="text-white font-bold p-2">Suggestion
          <span class="text-sky-500">(Optional)</span>
        </label>
        <input type="text" name="suggestion" id="suggestion" class="rounded-md p-2 " placeholder="Maximum 100 characters">
        <label for="rating" class="text-white font-bold p-2">Rating
          <span class="text-sky-500">(Optional)</span>
        </label>
        <select name="rating" id="rating" class="rounded-md p-2">
          <option value="0">No rating</option>
          <option value="1">Bad rating</option>
          <option value="2">Low rating</option>
          <option value="3">Mid rating</option>
          <option value="4">High rating</option>
          <option value="5">Great rating</option>
        </select>
        <h1 class="text-white font-bold p-2">Back
          <a href="../landingPage.php" class="text-sky-500">Home</a>
        </h1>
        <button type="submit" class="bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded">Send</button>
      </div>
    </form>
  </div>
</div>

<script>
  const formCriticism = document.querySelector("#formCriticism");
  formCriticism.addEventListener("submit", async (e) => {
    e.preventDefault();
    const criticism = e.target.criticism.value;
    const suggestion = e.target.suggestion.value;
    const rating = e.target.rating.value;
    try {
      const token = "<?= $_SESSION['token'] ?>";
      console.log(token);
      console.log(criticism);
      const response = await axios.post("http://localhost:3000/api/createFeedback", {
        criticism: criticism,
        suggestion: suggestion,
        rating: parseInt(rating),
      }, {
        headers: {
          "X-API-TOKEN": `${token}`
        },
      }).then((response) => response.data);
      // console.log(response);
      if (response.status == 201) {
        Swal.fire ({
          icon: "success",
          title: "Send message Successfully",
          text: response.message
        })
      }
      setTimeout(() => {
        window.location.href = "../landingPage.php";
      })
    } catch (error) {
      // alert(error.response.data.errors);
      Swal.fire ({
        icon: "error",
        title: "Error",
        text: error.response.data.errors
      })
    }
  });
</script>

<?php
require_once "../../../templates/footer.php";
footerTemplates();
?>