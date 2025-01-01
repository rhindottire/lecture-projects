let dataAnime = [];
let topAnime = [];
let general = [];
let restricted = [];
let genres = [];
let aZ = [];
let zA = [];
let premium = [];

function showTopAnime() {
  topAnime = [];
  const sortAnime = [...dataAnime].sort((a, b) => a.rank - b.rank);
  topAnime = sortAnime.slice(0, 15);
  showData(topAnime);
}

function showGeneralAnime() {
  general = [];
  for (const item of dataAnime) {
    if (item.rating === "General") {
      general.push(item);
    }
  }
  showData(general);
}

function showRestrictedAnime() {
  restricted = [];
  for (const item of dataAnime) {
    if (item.rating === "Restricted") {
      restricted.push(item);
    }
  }
  showData(restricted);
}

function showDataWithGenre(genre) {
  const filteredData = dataAnime.filter((item) => {
    return item.genre.includes(genre);
  });
  showData(filteredData);
}

function showAZ_Anime() {
  aZ = [...dataAnime].sort((a, b) => {
    const aTitle = a.title.toLowerCase();
    const bTitle = b.title.toLowerCase();
    return aTitle < bTitle ? -1 : 1;
  });
  showData(aZ);
}

function showZA_Anime() {
  zA = [...dataAnime].sort((a, b) => {
    const aTitle = a.title.toLowerCase();
    const bTitle = b.title.toLowerCase();
    return aTitle > bTitle ? -1 : 1;
  });
  showData(zA);
}

function showPremiumAnime() {
  premium = [];
  for (const item of dataAnime) {
    if (item.premium === true) {
      premium.push(item);
    }
  }
  showData(premium);
}

async function loadData() {
  try {
    const response = await fetch("http://localhost:3000/data");
    if (!response.ok)
      throw new Error(`Something went wrong: ${response.status}`);
    dataAnime = await response.json();
    showGenres();
    showTopAnime();
  } catch (error) {
    console.log(error);
  }
}

function showGenres() {
  genres = [];
  dataAnime.forEach((item) => {
    const itemGenres = item.genre.split(",");
    itemGenres.forEach((genre) => {
      if (!genre.trim()) return; // skip if genre is empty
      genre = genre.trim();
      if (!genres.some((genreItem) => genreItem === genre)) {
        genres.push(genre);
      }
    });
  });
  genres = genres.sort();

  const genreContainer = document.querySelector("#genre-menu");
  genreContainer.innerHTML = "";
  genres.forEach((genre) => {
    const genreItem = document.createElement("a");
    genreItem.setAttribute("data-bs-dismiss", "modal");
    genreItem.addEventListener("click", () => {
      showDataWithGenre(genre);
    });
    genreItem.textContent = genre + " | ";
    genreContainer.appendChild(genreItem);
  });
}

function showData(anime) {
  const cardContainer = document.querySelector("#collection");
  cardContainer.innerHTML = "";
  anime.forEach((item) => {
    const card = document.createElement("div");
    card.classList.add("col", "d-flex", "align-item-stretch");
    card.innerHTML = `<div class="card p-2 w-100 shadow">
        <div class="card-image mx-auto">
          <img src="${item.img}" class="img-fluid" style="height:300px;">
        </div>
        <div class="card-content mt-4">
          <h4>${item.title}</h4>
          <p>Rank : ${item.rank}</p>
          <p>Score : ${item.score}</p>
          <p>Rating : ${item.rating}</p>
          <p>Genre : ${item.genre}</p>
        </div>
    </div>`;
    cardContainer.appendChild(card);
  });
}

window.addEventListener("load", function () {
  loadData();
});

const topButton = document.querySelector("#sort-top");
topButton.addEventListener("click", () => {
  showTopAnime();
});

const generalButton = document.querySelector("#sort-general");
generalButton.addEventListener("click", () => {
  showGeneralAnime();
});

const restrictedButton = document.querySelector("#sort-restricted");
restrictedButton.addEventListener("click", () => {
  showRestrictedAnime();
});

const AZ_Button = document.querySelector("#sort-AZ");
AZ_Button.addEventListener("click", () => {
  showAZ_Anime();
});

const ZA_Button = document.querySelector("#sort-ZA");
ZA_Button.addEventListener("click", () => {
  showZA_Anime();
});

const premiumButton = document.querySelector("#sort-premium");
premiumButton.addEventListener("click", () => {
  document.getElementById("header").innerHTML = "Premium Anime";
  showPremiumAnime();
});
