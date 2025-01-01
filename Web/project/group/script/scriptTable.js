// util untuk mengambil data dari url
async function fetchData(url) {
  try {
    const response = await fetch(url);
    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
    return await response.json();
  } catch (error) {
    console.error(`Error fetching data: ${error}`);
    return [];
  }
}
// ------------------------------------------

// tabel kritik
document.getElementById("kritikButton").addEventListener("click", async () => {
  document.getElementById("parentTable").innerHTML = `
    <h3>Tabel Kritik Dan Saran</h3>
    <table class="table table-bordered" id="tabelKritik">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th style="width: 200px">Username</th>
          <th style="width: 150px">Rating</th>
          <th style="width: auto">Komentar</th>
          <th style="width: 125px">Date</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>`;
  const container = document.getElementById("container");
  const statsTable = `
    <h3>Table</h3>
    <table class="table table-bordered" id="statsTable">
      <thead>
        <tr>
          <th>Item</th>
          <th>Count</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>`;
  container.classList.add("col-4");
  container.innerHTML = statsTable;
  const data = await fetchData("http://localhost:3000/kritik-dan-saran");
  displayDataInTable(data, "tabelKritik", "statsTable");
});
// -----------------------------------------------

// tabel survei musiman
document.getElementById("surveiButton").addEventListener("click", async () => {
  document.getElementById("parentTable").innerHTML = `
    <h3>Tabel Survei Musiman</h3>
    <table class="table table-bordered" id="tabelSurvei">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th style="width: 200px">Username</th>
          <th style="width: 150px">Pilihan</th>
          <th style="width: auto">Komentar</th>
          <th style="width: 125px">Date</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>`;
  const container = document.getElementById("container");
  const statsTable = `
      <h3>Table</h3>
      <table class="table table-bordered" id="statsTable">
        <thead>
          <tr>
            <th>Item</th>
            <th>Count</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>`;
  container.classList.add("col-4");
  container.innerHTML = statsTable;
  const data = await fetchData("http://localhost:3000/survei-musiman");
  displayDataInTable(data, "tabelSurvei", "statsTable");
});
// ------------------------------------------------

// form tambah notif
document.getElementById("notifButton").addEventListener("click", () => {
  document.getElementById("parentTable").innerHTML = `
  <h3>Form Tambah Notif</h3>
    <div id="alertBoxFormAddNotif"></div>
    <div class="mb-3">
      <label for="formNotifIdUser" class="form-label">IdUser ( "" == semua user )</label>
      <input type="number" class="form-control" id="formNotifIdUser">
    </div>
    <div class="mb-3">
      <label for="formNotifHeader" class="form-label">Header (Required)</label>
      <input type="text" class="form-control" id="formNotifHeader">
    </div>
    <div class="mb-3">
      <label for="formNotifBody" class="form-label">Body (Required)</label>
      <input type="text" class="form-control" id="formNotifBody">
    </div>
    <button id="updateNotif" class="btn btn-primary">Submit</button>`;
  const container = document.getElementById("container");
  container.innerHTML = "";
  container.classList.remove("col-4");
  document
    .getElementById("updateNotif")
    .addEventListener("click", handleNotificationSubmit);
});

async function handleNotificationSubmit() {
  const idUser = document.getElementById("formNotifIdUser").value;
  const alertBox = document.getElementById("alertBoxFormAddNotif");
  alertBox.innerHTML = "";

  const successAlert = `<div class="alert alert-success" role="alert">Notif Berhasil Ditambahkan!</div>`;
  const errorAlert = `<div class="alert alert-danger" role="alert">Notif Gagal Ditambahkan!</div>`;

  const result = idUser ? await addNotif(idUser) : await addNotifAll();
  alertBox.innerHTML = result ? successAlert : errorAlert;
}

async function addNotifAll() {
  try {
    const data = await fetchData("http://localhost:3000/user");
    const addResults = await Promise.all(data.map((user) => addNotif(user.id)));
    return addResults.every((result) => result === true);
  } catch (error) {
    console.error(`Error fetching users: ${error}`);
    return false;
  }
}

async function addNotif(idUser) {
  const headerMsg = document.getElementById("formNotifHeader").value;
  const bodyMsg = document.getElementById("formNotifBody").value;
  const currentTime = new Date().toISOString().split("T")[0];
  if (headerMsg == "" || bodyMsg == "") {
    return false;
  }
  const data = { header: headerMsg, body: bodyMsg, date: currentTime };

  try {
    const response = await fetch(`http://localhost:3000/add-notif/${idUser}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });

    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
    console.log(await response.json(), "Notification added successfully");
    return true;
  } catch (error) {
    console.error("Error adding notification:", error);
    return false;
  }
}

// ------------------------------------------

function calculateStatistics(data) {
  const stats = {
    totalUsers: data.length,
    ratings: {},
  };

  data.forEach((item) => {
    const rating = item.rating || item.pilihan;
    if (!stats.ratings[rating]) {
      stats.ratings[rating] = 0;
    }
    stats.ratings[rating] += 1;
  });

  return stats;
}

function displayStatistics(stats, statsTableId, rating) {
  const statsTableBody = document.querySelector(`#${statsTableId} tbody`);
  statsTableBody.innerHTML = "";

  const totalUserRow = document.createElement("tr");
  totalUserRow.innerHTML = `
    <td >Total Users</td>
    <td>${stats.totalUsers}</td>`;

  statsTableBody.appendChild(totalUserRow);

  const userChoice = document.createElement("tr");
  userChoice.innerHTML = `
  <th colspan="2">Pilihan</th>`;

  statsTableBody.appendChild(userChoice);

  for (const [rating, count] of Object.entries(stats.ratings)) {
    const ratingRow = document.createElement("tr");
    ratingRow.innerHTML = `
      <td>${rating}</td>
      <td>${count}</td>`;
    statsTableBody.appendChild(ratingRow);
  }
}

function displayDataInTable(data, tableId, statsTableId) {
  const statsTableBody = document.querySelector(`#${statsTableId} tbody`);
  statsTableBody.innerHTML = "";

  const tableBody = document.querySelector(`#${tableId} tbody`);
  tableBody.innerHTML = "";
  data.forEach((item, index) => {
    const { user, rating, kritiksaran, date } = item;
    const tableRow = document.createElement("tr");
    tableRow.innerHTML = `
      <td>${index + 1}</td>
      <td>${user}</td>
      <td>${rating || item.pilihan}</td>
      <td>${kritiksaran || item.komentar}</td>
      <td>${date}</td>`;
    tableBody.appendChild(tableRow);
  });
  const stats = calculateStatistics(data);
  displayStatistics(stats, statsTableId);
}
