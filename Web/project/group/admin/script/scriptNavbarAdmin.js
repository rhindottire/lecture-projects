// set tema
let theme = localStorage.getItem("theme");

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
    if (userId) {
      const userData = await getUser(userId);
      user = userData[0];
      username = user.username;
      checkUser();
    } else {
      window.open("http://localhost/Tugas%20Bu%20devie/Login.php");
    }
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
    window.open("http://localhost/Tugas%20Bu%20devie/Login.php");
  } catch (error) {
    console.error("Error cannot logout:", error);
  }
}

// cek user login

function displayNameLogoutBtn() {
  const nameBlock = document.getElementById("nameBlock");
  nameBlock.innerHTML = username;

  document.getElementById("logOutBtn").addEventListener("click", () => {
    logout();
  });
}

function checkUser() {
  if (user) {
    displayNameLogoutBtn();
  } else {
    logout();
  }
}
// -------------------------------------------------

window.addEventListener("load", () => {
  setTheme();
  initializeUser();
});
