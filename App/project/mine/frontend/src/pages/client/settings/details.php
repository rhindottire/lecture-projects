<?php
  session_start();
  if (!isset($_SESSION['token'])) {
    header("Location: /frontend/src/auth/login.php");
    exit();
  }
  require_once __DIR__ . "/../../../templates/header.php";
  require_once __DIR__ . "/../../../templates/footer.php";

  require_once __DIR__ . "/../../../api/client.php";
  $client = getClientDetails($_SESSION['token'])['data'];
  // var_dump($client);
?>

<?php headerTemplates("Edit Profile"); ?>

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
      <div class="w-1/2 mx-auto mt-10 flex flex-col">
        <h1 class="font-bold text-white p-2 text-3xl">Edit Details</h1>
      </div>
      <form action="" id="editProfile">
        <div class="flex gap-2 w-1/2 mx-auto mt-10 gap-5 flex-col rounded-md 
            scrollbar scrollbar-thin scrollbar-thumb-white
            max-h-[400px] overflow-y-auto 
            [&::-webkit-scrollbar]:w-2
            [&::-webkit-scrollbar-track]:bg-white
            [&::-webkit-scrollbar-thumb]:bg-white
            dark:[&::-webkit-scrollbar-track]:bg-white
            dark:[&::-webkit-scrollbar-thumb]:bg-white">
          <label for="name" class="text-white font-bold">Name</label>
          <input type="text" name="name" id="name" class="rounded-md p-2" value="<?= $client['name'] ?>">
          <h1 class="text-white font-bold">Gender</h1>
          <div class="flex gap-2">
            <label for="man" class="text-white font-bold pl-2">MAN</label>
            <input type="radio" name="gender" id="man" value="MAN" checked="<?= $client['gender'] == 'MAN' ? 'checked' : '' ?>">
            <label for="woman" class="text-white font-bold pl-2">WOMAN</label>
            <input type="radio" name="gender" id="woman" value="WOMAN" checked="<?= $client['gender'] == 'WOMAN' ? 'checked' : '' ?>">
          </div>
          <label for="birthDate" class="text-white font-bold">Birth Date</label>
          <input type="date" name="birthDate" id="birthDate" class="rounded-md p-2" value="<?= $client['birthDate'] ?? '' ?>">
          <label for="telephone" class="text-white font-bold">Phone Number</label>
          <input type="text" name="telephone" id="telephone" class="rounded-md p-2" placeholder="Enter your phone number" value="<?= $client['phoneNumber'] ?? '' ?>">
          <label for="profilePicture" class="text-white font-bold">Profile Picture</label>
          <input type="file" name="profilePicture" id="profilePicture" class="rounded-md p-2 text-white" value="<?= $client['profilePicture'] ?? '' ?>">
          <button type="submit" class="bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script type="module">
    const formEditProfile = document.querySelector("#editProfile");
    formEditProfile.addEventListener("submit", async (e) => {
      e.preventDefault();
      const name = document.querySelector("#name").value;
      const gender = document.querySelector("input[name='gender']:checked").value;
      const birthDate = document.querySelector("#birthDate").value;
      const telephone = document.querySelector("#telephone").value;
      const profilePicture = document.querySelector("#profilePicture").files[0];

      if (telephone.length < 11) {
        Swal.fire({
          icon: "error",
          title: "Phone number must be at least 12 digits",
          text: "Something went wrong!",
        });
        return;
      }

      Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Save",
        denyButtonText: `Don't save`
      }).then( async(result) => {
        if (result.isConfirmed) {
          try {
            const response = await axios.patch("http://localhost:3000/api/client/update", {
              name: name,
              gender: gender,
              birthDate: birthDate,
              telephone: telephone,
              profilePicture: profilePicture
            }, {
              headers: {
                'X-API-TOKEN': '<?= $_SESSION['token'] ?>'
              }
            }).then(data => data.data);
            // console.log(response);
            if (response.status === 201) {
              // alert(response.message);
              Swal.fire({
                icon: "success",
                title: response.message,
              });
            }
          } catch (error) {
            // console.error(error);
            Swal.fire({
              icon: "error",
              title: error.response.data.errors,
              text: "Something went wrong!",
            });
          }
        } else if (result.isDenied) {
          Swal.fire("Changes are not saved", "", "info");
        }
      });
    });

    const logout = document.querySelector("#logout");
    logout.addEventListener("click", async (e) => {
      e.preventDefault();
      const token = "<?= $_SESSION['token'] ?? ''; ?>";
      // console.log(token);
      if (!token) {
        alert("Token not found.");
        return;
      }
      try {
        const response = await axios.patch("http://localhost:3000/api/client/logout", {}, {
          headers: {
            'X-API-TOKEN': `${token}`
          }
        }).then(data => data.data);
        // console.log(response);
        if (response.status === 201) {
          // alert(response.message);
          Swal.fire({
            icon: "success",
            title: response.message,
          })
          setTimeout(() => {
            window.location.replace("http://abogoboga.test:8000/frontend/src/auth/destroy-token.php");
          }, 2000);
        }
      } catch (error) {
        // console.log("Error:", error);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: error.response.data.errors,
        })
      }
    });
  </script>

<?php footerTemplates(); ?>