let dataAnime = [];

async function getDataAnime() {
    try {
        const response = await fetch("http://localhost:3000/data");
        if (!response.ok) throw new Error(`Something went wrong: ${response.status}`);
        dataAnime = await response.json();
        // console.log(dataAnime);
        // showData(dataAnime);
    } catch (error) {    
        console.log(error);
    }
}

async function addData(data) {
    try {
      const response = await fetch("http://localhost:3000/data", {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });
      if (!response.ok) throw new Error(`Something went wrong: ${response.status}`);
      dataAnime = await response.json();
    //   showData(dataAnime);
    } catch (error) {
      console.log(error);
  }}
  
function getDataFromInput() {
    document.getElementById('addData').addEventListener('click', getDataFromInput);
    const animeTitle = document.getElementById('animeTitle').value;
    const animeImg = document.getElementById('animeImg').value;
    const animeRank = document.getElementById('animeRank').value;
    const animeScore = document.getElementById('animeScore').value;
    const animeRating = document.getElementById('animeRating').value;
    const animeGenre = document.getElementById('animeGenre').value;
    const animePremium = document.getElementById('animePremium').value === 'true';

    const newData = {
        title: animeTitle,
        rank: parseInt(animeRank),
        score: parseFloat(animeScore),
        rating: animeRating,
        genre: animeGenre,
        img: animeImg,
        premium: animePremium,
    };
    // addData(newData);
}

document.addEventListener('DOMContentLoaded', async () => {
    await getDataAnime();
    displayAnime();
    setupSearch();
});

async function displayAnime() {
    const tbody = document.querySelector("#collection");
    tbody.innerHTML = '';
    dataAnime.sort((a, b) => a.rank - b.rank);
    dataAnime.forEach(anime => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td style="max-width: 100px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.rank}</td>
            <td style="max-width: 360px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.title}</td>
            <td style="max-width: 150px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.img}</td>
            <td style="max-width: 150px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.genre}</td>
            <td style="max-width: 300px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.score}</td>
            <td style="max-width: 300px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" class="text-white ${anime.rating == 'Restricted' ? 'bg-danger' : 'bg-success'}">${anime.rating}</td>
            <td style="max-width: 150px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" class=" ${anime.premium == true ? 'bg-primary text-white' : ""}">${anime.premium ? 'Yes' : 'No'}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editAnime(${anime.id})" data-bs-toggle="modal" data-bs-target="#modalEditData">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteAnime(${anime.id})">Delete</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

const submitEdit = document.getElementById("SubmitEditAnime")
const Id = document.getElementById("Id")
const Title = document.getElementById("Title")
const Img = document.getElementById("Img")
const Rating = document.getElementById("Rating")
const Genre = document.getElementById("Genre")
const Premium = document.getElementById("Premium")

function editAnime(id) {
    const anime = dataAnime.find(a => a.id == id);
    Id.value = anime.id;
    Title.value = anime.title;
    Img.value = anime.img;
    Rating.value = anime.rating;
    Genre.value = anime.genre;
    Premium.value = anime.premium;
}

submitEdit.addEventListener("click", () => {
    SubmitEditAnime();
})

function SubmitEditAnime() {
    const editedAnime = {
        id: Id.value,
        img: Img.value,
        title: Title.value,
        rating: Rating.value,
        genre: Genre.value,
        premium: Premium.value
    } 
    console.log(editedAnime);
    try {
        const response = fetch(`http://localhost:3000/edit-data/${Id.value}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(editedAnime)
        }) 
        displayAnime();
    } catch (error) {
        console.log(error);
    }
}

async function deleteAnime(id) {
    console.log(id);
    const respone = await fetch(`http://localhost:3000/data/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    displayAnime();
}
const submitAdd = document.getElementById("SubmitAddAnime")
const addId = document.getElementById("addId")
const addTitle = document.getElementById("addTitle")
const addImg = document.getElementById("addImg")
const addRank = document.getElementById("addRank")
const addRating = document.getElementById("addRating")
const addGenre = document.getElementById("addGenre")
const addPremium = document.getElementById("addPremium")

submitAdd.addEventListener("click", () => {
    addAnime();
})

function addAnime() {
    const newAnime = {
        img: addImg.value,
        title: addTitle.value,
        rating: addRating.value,
        genre: addGenre.value,
        premium: addPremium.value
    }
    try {
        const response = fetch("http://localhost:3000/data", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newAnime)
        }) 
        displayAnime()
    } catch (error) {
        console.log(error);
    }
}

function setupSearch() {
    const searchInput = document.getElementById("searchBar");
    searchInput.addEventListener("input", () => {
      // alert("hello")
      const searchTerm = searchInput.value.toLowerCase();
      const filteredAnime = dataAnime.filter((anime) => {
        return (anime.title.toLowerCase().includes(searchTerm))
          // anime.rank.toString().includes(searchTerm) ||
          // anime.title.toLowerCase().includes(searchTerm) ||
          // anime.img.toLowerCase().includes(searchTerm) ||
          // anime.score.toString().includes(searchTerm) ||
          // anime.rating.toLowerCase().includes(searchTerm) ||
          // anime.genre.toLowerCase().includes(searchTerm) ||
          // (anime.premium ? "yes" : "no").includes(searchTerm)       
        });
        console.log(filteredAnime);
        displayAnimeBySearch(filteredAnime);
    });
}
  
async function displayAnimeBySearch(dataAnimeSearch) {
    const tbody = document.querySelector("#collection");
    tbody.innerHTML = "";
    dataAnimeSearch.sort((a, b) => a.rank - b.rank);
    dataAnimeSearch.forEach((anime) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td style="max-width: 100px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.rank}</td>
            <td style="max-width: 360px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.title}</td>
            <td style="max-width: 150px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.img}</td>
            <td style="max-width: 150px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.genre}</td>
            <td style="max-width: 300px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">${anime.score}</td>
            <td style="max-width: 300px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" class="text-white ${anime.rating == "Restricted" ? "bg-danger" : "bg-success"}">${anime.rating}</td>
            <td style="max-width: 150px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;" class=" ${anime.premium == true ? "bg-primary text-white" : ""}">${anime.premium ? "Yes" : "No"}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editAnime(${anime.id})" data-bs-toggle="modal" data-bs-target="#modalEditData">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteAnime(${anime.id})">Delete</button>
            </td>
        `;
    tbody.appendChild(tr);
    });
}