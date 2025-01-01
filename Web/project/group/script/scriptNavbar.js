// set tema
let theme = localStorage.getItem("theme");

if (theme === null) {
  localStorage.setItem("theme", "dark");
  theme = "dark";
}

const uiButtonTheme = document.getElementById("uiButtonTheme");
const darkButton = document.getElementById("darkButton");
const lightButton = document.getElementById("lightButton");

darkButton.addEventListener("click", () => {
  document.documentElement.setAttribute("data-bs-theme", "dark");
  uiButtonTheme.innerHTML = "<i class='bi bi-moon-stars-fill'></i>";
  localStorage.setItem("theme", "dark");
});

lightButton.addEventListener("click", () => {
  document.documentElement.setAttribute("data-bs-theme", "light");
  uiButtonTheme.innerHTML = "<i class='bi bi-brightness-high-fill'></i>";
  localStorage.setItem("theme", "light");
});

function setTheme() {
  if (theme === "dark") {
    document.documentElement.setAttribute("data-bs-theme", "dark");
    uiButtonTheme.innerHTML = "<i class='bi bi-moon-stars-fill'></i>";
  } else {
    document.documentElement.setAttribute("data-bs-theme", "light");
    uiButtonTheme.innerHTML = "<i class='bi bi-brightness-high-fill'></i>";
  }
}
// -----------------------------------------------

// get user
async function getIdUser() {
  try {
    const response = await fetch(
      "http://localhost/Tugas%20Bu%20devie/filePremiumLoginRegister/getsessionId.php"
    );
    if (!response.ok) {
      throw new Error("Failed to fetch session ID");
    }
    const userId = await response.text();
    return userId;
  } catch (error) {
    console.error("Error fetching session ID:", error);
    return null;
  }
}

let user = null;
let username = null;

async function getUser(idUser) {
  try {
    const response = await fetch(`http://localhost:3000/user/${idUser}`);
    const userData = await response.json();

    return userData;
  } catch (error) {
    console.error("Error fetching data user:", error);
    return null;
  }
}

function checkUserId(userid) {
  try {
    return parseInt(userid) ? parseInt(userid) : null;
  } catch {
    return null;
  }
}

async function initializeUser() {
  try {
    let userId = await getIdUser();
    userId = checkUserId(userId);
    console.log(userId);
    if (userId) {
      const userData = await getUser(userId);
      getNotifUser(userId);
      user = userData[0];
      username = user.username;
    } else {
      user = null;
      username = null;
    }
    checkUser();
  } catch (error) {
    console.error("Failed to get session ID:", error);
  }
}
// ----------------------------------------

// logut
async function logout() {
  try {
    fetch(
      `http://localhost/Tugas%20Bu%20devie/filePremiumLoginRegister/logout.php`
    );
    user = null;
    username = null;
  } catch (error) {
    console.error("Error cannot logout:", error);
  }
}

// cek user login == true ? tampilkan nama user : tampilkan login dan register btn

// const premiumbtn1 = document.getElementById("premiumBtn1");
const premiumbtn2 = document.getElementById("premiumBtn2");
// const profilbtn1 = document.getElementById("profilBtn1");
const profilbtn2 = document.getElementById("profilBtn2");
const kritikbtn = document.getElementById("kritikBtn");
const notifbtn = document.getElementById("notifBtn");

function displayBtnOrName() {
  const parent = document.getElementById("displayBtnOrName");
  const child = parent.children[0];

  const div = document.createElement("div");
  div.innerHTML = `
    <div class="d-flex justify-content-between align-items-center teks">
        <span id="nameBlock">${username}</span>
        <btn class="btn border-0" id="logOutBtn">
            <i class="bi bi-box-arrow-right"></i>
        </btn>
    </div>`;

  parent.append(div.children[0]);
  child.classList.add("d-none");
  document.getElementById("logOutBtn").addEventListener("click", () => {
    logout();
    window.open("http://localhost/Tugas%20Bu%20devie/Home.html");
  });
}

function checkUser() {
  if (user) {
    // premiumbtn1.setAttribute("href", "Premium.php");
    premiumbtn2.setAttribute("href", "Premium.php");
    // profilbtn1.setAttribute("href", "Profil.html");
    profilbtn2.setAttribute("href", "Profil.html");
    kritikbtn.setAttribute("href", "SurveyForm.html");
    notifbtn.removeAttribute("disabled");
    displayBtnOrName();
  } else {
    // premiumbtn1.setAttribute("href", "Login.php");
    premiumbtn2.setAttribute("href", "Login.php");
    // profilbtn1.setAttribute("href", "Login.php");
    profilbtn2.setAttribute("href", "Login.php");
    kritikbtn.setAttribute("href", "Login.php");
    notifbtn.setAttribute("disabled", true);
  }
}
// -------------------------------------------------

// search
const getData = async () => {
  try {
    const response = await fetch("http://localhost:3000/data");
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(`Error fetching users: ${error}`);
  }
};
let collection = null;

getData().then((data) => {
  collection = data;
});

const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", function () {
  const key = searchInput.value.toLowerCase();
  const searchContainer = document.createElement("div");
  for (const i in collection) {
    if (collection[i].title.toLowerCase().includes(key)) {
      const element = displaySearchItem(collection[i]);
      searchContainer.appendChild(element);
      searchContainer.appendChild(document.createElement("hr"));
    }
  }
  modalBody.replaceChildren(searchContainer);
});

function displaySearchItem(Obj) {
  const { title, img } = Obj;
  const searchItemRow = document.createElement("div");
  searchItemRow.classList.add("row");
  searchItemRow.style.cursor = "pointer";
  searchItemRow.setAttribute("data-bs-dismiss", "#modalForSearch");

  searchItemRow.addEventListener("mouseenter", function () {
    searchItemRow.style.backgroundColor = "rgba(255,2555,255,0.1)";
  });

  searchItemRow.addEventListener("mouseleave", function () {
    searchItemRow.style.backgroundColor = "rgba(255,255,255,0)";
  });

  const searchItemCol1 = document.createElement("div");
  searchItemCol1.classList.add("col-3", "p-2");

  const imgCover = document.createElement("img");
  imgCover.classList.add("img-fluid");
  imgCover.src = img;
  imgCover.alt = title;

  const searchItemCol2 = document.createElement("div");
  searchItemCol2.classList.add("col-9", "d-flex", "align-items-center");
  searchItemCol2.innerHTML = title;

  searchItemCol1.appendChild(imgCover);
  searchItemRow.appendChild(searchItemCol1);
  searchItemRow.appendChild(searchItemCol2);

  return searchItemRow;
}
// -------------------------------------------------------------

// menampilkan notif
async function getNotifUser(idUser) {
  try {
    const response = await fetch(`http://localhost:3000/user/${idUser}`);
    const data = await response.json();
    const notifs = JSON.parse(data[0].notif);
    for (const i of notifs) {
      displayNotif(i);
    }
  } catch (error) {
    console.log(error);
  }
}

function displayNotif(data) {
  const { header, body, date } = data;
  const modalBody = document.querySelector("#modalNotification .modal-body");

  const notifElement = document.createElement("div");
  notifElement.style.cursor = "pointer";
  notifElement.addEventListener("mouseenter", () => {
    notifElement.style.backgroundColor = "rgba(115,115,155,0.1)";
  });
  notifElement.addEventListener("mouseleave", () => {
    notifElement.style.backgroundColor = "rgba(115,115, 155, 0.0)";
  });
  notifElement.innerHTML = `
            <div class="p-3">
              <p class="m-0 fw-bold" style="font-size: small">
                ${header}
              </p>
              <p class="m-0" style="font-size: x-small; text-align: justify">
                ${body}
              </p>
              <p class="my-2" style="font-size: x-small">${date}</p>
            </div>
            <hr class="my-2" />`;
  modalBody.insertBefore(notifElement, modalBody.firstChild);
}
// -------------------------------------------------------------

window.addEventListener("load", () => {
  setTheme();
  initializeUser();
  // checkUser();
});
