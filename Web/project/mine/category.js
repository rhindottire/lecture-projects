let dataAnime = [];
let topAnime = [];
let general = [];
let restricted = [];
let genres = [];
let aZ = [];
let zA = [];
let premium = [];

async function loadData() {
  try {
    const response = await fetch("http://localhost:3000/data");
    if (!response.ok) throw new Error(`Something went wrong: ${response.status}`);
    dataAnime = await response.json();
    console.log(dataAnime)
    showGenres();
    showTopAnime();
  } catch (error) {
    console.log(error);
  }
}

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
  genres.map((genre) => {
    const genreButton = document.createElement("button");
    genreButton.style.width = "49%";
    genreButton.setAttribute("data-bs-dismiss", "modal");
    genreButton.classList.add("btn", "btn-primary", "genre-button");
    const span = document.createElement("span");
    span.textContent = genre;
    genreButton.appendChild(span);
    genreContainer.appendChild(genreButton);
    genreButton.addEventListener("click", () => {
      document.getElementById("header").innerHTML = `Sort by ${genre}`;
      showDataWithGenre(genre);
    });
  });
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

function showData(anime) {
  const cardContainer = document.querySelector("#collection");
  cardContainer.innerHTML = "";
  anime.map((item) => {
    const card = document.createElement("div");
    card.classList.add("col", "d-flex", "align-item-stretch");
    card.innerHTML = `<div class="card p-2 w-100">
        <div class="card-image mx-auto" style="width: 165%; height: 300px">
          <div class="img" style="background-image: url('${item.img}'); background-size: cover; background-position: center; background-repeat: no-repeat; width: 60%; height: 300px" class="image-container">
            <div class="p-2">
              ${item.premium ? "<i class='bg-black text-light d-flex justify-content-center align-items-center p-1 rounded-5 bi bi-gem' style='width:50px; height: 25px;'></i>" : ""}
            </div>
          </div>
        </div>
        <div class="card-content h-100 mt-4 d-flex flex-column justify-content-between">
          <div>
            <h4 class="card-title">${item.title}</h4>
            <p class="card-rank">Rank : ${item.rank}</p>
            <p class="card-score">Score : ${item.score}</p>
            <p class="card-rating">Rating : ${item.rating}</p>
            <p class="card-genre">Genre : ${item.genre}</p>
          </div>
          <div>
            <button class="btn btn-primary watch-button">Streaming <i class="bi bi-play-circle"></i></button>
            <button class="btn btn-primary like-button">Like <i class="bi bi-hand-thumbs-up"></i></button>
          </div>
        </div>
    </div>`;
    card.querySelector(".watch-button").addEventListener("click", () => {
      // handle watch button click
    });
    card.querySelector(".like-button").addEventListener("click", () => {
      // handle like button click
    });
    cardContainer.appendChild(card);
  });
}

window.addEventListener("load", function () {
  loadData();
});

const topButton = document.querySelector("#sort-top");
topButton.addEventListener("click", () => {
  document.getElementById("header").innerHTML = "TOP FILM";
  showTopAnime();
});

const generalButton = document.querySelector("#sort-general");
generalButton.addEventListener("click", () => {
  document.getElementById("header").innerHTML = "Sort by General";
  showGeneralAnime();
});

const restrictedButton = document.querySelector("#sort-restricted");
restrictedButton.addEventListener("click", () => {
  document.getElementById("header").innerHTML = "Sort by Restricted";
  showRestrictedAnime();
});

const AZ_Button = document.querySelector("#sort-AZ");
AZ_Button.addEventListener("click", () => {
  document.getElementById("header").innerHTML = "Sort A-Z";
  showAZ_Anime();
});

const ZA_Button = document.querySelector("#sort-ZA");
ZA_Button.addEventListener("click", () => {
  document.getElementById("header").innerHTML = "Sort Z-A";
  showZA_Anime();
});

const premiumButton = document.querySelector("#sort-premium");
premiumButton.addEventListener("click", () => {
  document.getElementById("header").innerHTML = "Premium";
  showPremiumAnime();
});