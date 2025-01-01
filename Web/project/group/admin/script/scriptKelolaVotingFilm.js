let dataUserVote = [];
let dataItemVote = [];

function displayTabelUserVote() {
  document.getElementById("headerTable").innerHTML = "Tabel Data Voting";
  document.getElementById("containerButton").innerHTML = "";
  const voteTableHeader = document.querySelector("#voteTable thead");
  voteTableHeader.innerHTML = "";
  voteTableHeader.innerHTML = `
    <tr>
        <th style="width: 10px">#</th>
        <th style="width: 150px">Nama</th>
        <th style="width: 150px">Film id</th>
        <th style="width: auto">Komentar</th>
        <th style="width: 90px">Action</th>
    </tr>`;
  displayRowTabelUserVote();
}

function displayRowTabelUserVote() {
  const voteTableBody = document.querySelector("#voteTable tbody");
  voteTableBody.innerHTML = "";
  let no = 1;
  dataUserVote.forEach((element) => {
    const row = document.createElement("tr");
    row.innerHTML = `
        <td >${no}</td>
        <td >${element.nama}</td>
        <td >${element.film_id}</td>
        <td>${element.komentar}r</td>
        <td >
            <button class="btn btn-danger badge" id="deleteBtn${element.vote_id}">Delete</button>
        </td>`;
    voteTableBody.appendChild(row);
    document
      .getElementById(`deleteBtn${element.vote_id}`)
      .addEventListener("click", () => {
        if (confirm("yakin menghapus data", element.nama)) {
          deleteUserVote(element.vote_id, element.film_id);
          getDataUserVote();
        }
      });
    no += 1;
  });
}

function displayTabelVoteItem() {
  document.getElementById("headerTable").innerHTML = `Tabel Vote Item`;
  document.getElementById(
    "containerButton"
  ).innerHTML = `<button class="btn btn-success badge align-self-center" data-bs-toggle="modal" data-bs-target="#modalAddItemVote">Tambah Item</button>`;

  const voteTableHeader = document.querySelector("#voteTable thead");
  voteTableHeader.innerHTML = "";
  voteTableHeader.innerHTML = `
    <tr>
        <th style="width: 10px">#</th>
        <th style="width: 150px">Judul</th>
        <th style="width: 150px">Link Gambar</th>
        <th style="width: auto">Deskripsi</th>
        <th style="width: 150px">Total vote</th>
        <th style="width: 145px">Action</th>
    </tr>`;
}

function displayRowTabelItemVote() {
  const voteTableBody = document.querySelector("#voteTable tbody");
  voteTableBody.innerHTML = "";
  let no = 1;
  dataItemVote.forEach((element) => {
    const row = document.createElement("tr");
    row.innerHTML = `
        <td style="max-width: 10px; text-overflow: elipsis; white-space: nowrap;" >${no}</td>
        <td style="max-width: 150px; overflow: hidden; white-space: nowrap;" >${element.title}</td>
        <td style="max-width: 150px; overflow: hidden; white-space: nowrap;" >${element.img_url}</td>
        <td style="max-width: 400px; overflow: hidden; white-space: nowrap;" >${element.description}</td>
        <td style="max-width: 150px; overflow: scroll; white-space: nowrap;" >${element.total_vote}</td>
        <td >
            <button class="btn btn-warning badge" id="editBtn${element.id}">Edit</button>
            <button class="btn btn-danger badge" id="deleteBtn${element.id}">Delete</button>
        </td>`;
    voteTableBody.appendChild(row);
    const editBtn = document.getElementById(`editBtn${element.id}`);
    editBtn.setAttribute("data-bs-toggle", "modal");
    editBtn.setAttribute("data-bs-target", "#modalKelolaVoting");
    editBtn.addEventListener("click", () => {
      displayItemVoteInModal(element);
    });
    document
      .getElementById(`deleteBtn${element.id}`)
      .addEventListener("click", () => {
        if (confirm("yakin menghapus data")) {
          deleteDataItemVote(element.id);
          getDataVoteItems();
        }
      });
    no += 1;
  });
}

function displayItemVoteInModal(data) {
  document.getElementById("formKelolaVoting_Id").value = data.id;
  document.getElementById("formKelolaVoting_Judul").value = data.title;
  document.getElementById("formKelolaVoting_LinkGambar").value = data.img_url;
  document.getElementById("formKelolaVoting_Deskripsi").value =
    data.description;
  document.getElementById("formKelolaVoting_TotalVote").value = data.total_vote;
  document.getElementById("formKelolaVoting_TanggalRilis").value =
    data.release_date;
}

async function getDataUserVote() {
  try {
    const response = await fetch("http://localhost:3000/user-vote");
    const data = await response.json();
    dataUserVote = data;
    displayRowTabelUserVote();
  } catch (error) {
    console.log("Cannot fetch data:", error);
  }
}
async function getDataVoteItems() {
  try {
    const response = await fetch("http://localhost:3000/item-vote");
    const data = await response.json();
    dataItemVote = data;
    displayRowTabelItemVote();
  } catch (error) {
    console.log("Cannot fetch data:", error);
  }
}

document.getElementById("tabelVotes").addEventListener("click", () => {
  displayTabelUserVote();
  getDataUserVote();
});

document.getElementById("tabelVoteItem").addEventListener("click", () => {
  displayTabelVoteItem();
  getDataVoteItems();
});

async function deleteUserVote(vote_id, film_id) {
  try {
    const response = await fetch("http://localhost:3000/user-vote", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ vote_id, film_id }),
    });
    alert("data telah di hapus");
    getDataUserVote();
  } catch (error) {
    console.log("Cannot fetch data:", error);
  }
}
document.getElementById("submitKelolaVoting").addEventListener("click", () => {
  editDataItemVote();
});

async function editDataItemVote() {
  const id = document.getElementById("formKelolaVoting_Id").value;
  const title = document.getElementById("formKelolaVoting_Judul").value;
  const img_url = document.getElementById("formKelolaVoting_LinkGambar").value;
  const description = document.getElementById(
    "formKelolaVoting_Deskripsi"
  ).value;
  const total_vote = document.getElementById(
    "formKelolaVoting_TotalVote"
  ).value;

  if (id == "" || title == "" || img_url == "" || description == "") {
    return alert("harap isi semua kolom");
  }
  const data = { id, title, img_url, description, total_vote };

  try {
    const response = await fetch("http://localhost:3000/item-vote", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    getDataVoteItems();
    alert("data telah di update");
  } catch (error) {
    console.log("Cannot fetch data:", error);
  }
}

async function deleteDataItemVote(id) {
  try {
    const response = await fetch("http://localhost:3000/item-vote", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id }),
    });
    if (!response.ok) {
      console.error("Server response was not ok");
      return alert("Failed to deleted data");
    }
    getDataVoteItems();
    alert("data telah di hapus");
  } catch (error) {
    console.log("Cannot fetch data:", error);
  }
}

document.getElementById("submitItemVote").addEventListener("click", () => {
  addDataItemVote();
});

async function addDataItemVote() {
  const title = document.getElementById("formAddItemVote_Judul").value;
  const img_url = document.getElementById("formAddItemVote_LinkGambar").value;
  const description = document.getElementById(
    "formAddItemVote_Deskripsi"
  ).value;

  if (title == "" || img_url == "" || description == "") {
    return alert("harap isi semua kolom");
  }
  const data = { title, img_url, description };
  try {
    const response = await fetch("http://localhost:3000/item-vote", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    if (!response.ok) {
      console.error("Server response was not ok");
      return alert("Failed to add data");
    }
    alert("data telah di tambahkan");
    getDataVoteItems();
  } catch (error) {
    console.log("Cannot fetch data:", error);
  }
}

window.addEventListener("load", () => {
  displayTabelUserVote();
  getDataUserVote();
});
