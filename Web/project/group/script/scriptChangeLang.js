let lang = localStorage.getItem("lang");
let dataLang = {};

if (lang === null) {
  lang = "en";
  localStorage.setItem("lang", lang);
}

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

const parentLangButton = document.getElementById("uiButtonlang");
parentLangButton.innerHTML = capitalizeFirstLetter(lang);
const enButton = document.getElementById("enButton");
const idButton = document.getElementById("idButton");

enButton.addEventListener("click", () => {
  lang = "en";
  localStorage.setItem("lang", lang);
  parentLangButton.innerHTML = "En";
  translatePage();
});
idButton.addEventListener("click", () => {
  lang = "id";
  localStorage.setItem("lang", lang);
  parentLangButton.innerHTML = "Id";
  translatePage();
});

async function getDataLang() {
  try {
    const response = await fetch("http://localhost:3000/data-language");
    const data = await response.json();
    dataLang = data;
    translatePage();
  } catch (error) {
    console.log("Error cannot get data language:", error);
  }
}

function translatePage() {
  const elements = document.querySelectorAll("[data-translate]");
  elements.forEach((element) => {
    const key = element.getAttribute("data-translate");
    if (dataLang[lang][key]) {
      element.textContent = dataLang[lang][key];
    }
  });
}

window.addEventListener("load", () => {
  getDataLang();
});
