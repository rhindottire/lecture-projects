let dataVoteItem = [];

const getCurrentDate = () => {
  const now = new Date();
  const dd = String(now.getDate()).padStart(2, "0");
  const mm = String(now.getMonth() + 1).padStart(2, "0");
  const yyyy = now.getFullYear();
  return `${yyyy}-${mm}-${dd}`;
};

document.getElementById("ratingKepuasan").addEventListener("input", (event) => {
  const ratingValue = event.target.value;
  document.getElementById("displayRatingKepuasan").textContent = ratingValue;
});

const getKritikFromInput = () => ({
  user: document.getElementById("formKritik_Nama").value,
  email: document.getElementById("formKritik_Email").value,
  rating: document.getElementById("ratingKepuasan").value,
  kritiksaran: document.getElementById("formKritikDanSaran").value,
});

const insertKritikDanSaran = async () => {
  const kritikData = getKritikFromInput();
  const alertBox = document.getElementById("alertBoxFormKritik");
  if (
    kritikData.kritiksaran == "" ||
    kritikData.user == "" ||
    kritikData.email == ""
  ) {
    alertBox.innerHTML = `
      <div class="alert alert-danger" role="alert">
        Mohon isi semua kolom!
      </div>`;
    document.querySelector("#modalKritikDanSaran .modal-body").scrollTop = 0;
    return;
  }

  try {
    const response = await fetch("http://localhost:3000/kritik-dan-saran", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(kritikData),
    });

    alertBox.innerHTML = `
      <div class="alert alert-${
        response.ok ? "success" : "danger"
      }" role="alert">
        Kritik dan saran ${response.ok ? "berhasil" : "gagal"} dikirim!
      </div>`;
  } catch (error) {
    console.error("Error:", error);
    alertBox.innerHTML = `
      <div class="alert alert-danger" role="alert">
        Gagal mengirim kritik dan saran!
      </div>`;
  } finally {
    document.getElementById("formKritik_Nama").value = "";
    document.getElementById("formKritik_Email").value = "";
    document.getElementById("ratingKepuasan").value = 5;
    document.getElementById("formKritikDanSaran").value = "";
    document.querySelector(
      "#modalFormKritikDanSaran .modal-body"
    ).scrollTop = 0;
  }
};

document.getElementById("kirimKritik").addEventListener("click", () => {
  insertKritikDanSaran();
});

const getSurveiFromInput = () => ({
  film_id: document.getElementById("formSurvei_Select").value,
  nama: document.getElementById("formSurvei_Nama").value,
  komentar: document.getElementById("formKomentar").value,
});

const insertToSurveiMusiman = async () => {
  const data = getSurveiFromInput();
  const alertBox = document.getElementById("alertBoxFormSurvei");

  if (data.user == "" || data.komentar == "") {
    alertBox.innerHTML = `
      <div class="alert alert-danger" role="alert">
        Mohon isi semua kolom!
      </div>`;
    return;
  }
  if (data.film_id === "Open this select menu") {
    alertBox.innerHTML = `
      <div class="alert alert-danger" role="alert">
        Silakan pilih salah satu pilihan!
      </div>`;
    return;
  }

  try {
    const response = await fetch("http://localhost:3000/user-vote", {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    });

    alertBox.innerHTML = `
      <div class="alert alert-${
        response.ok ? "success" : "danger"
      }" role="alert">
        Survei ${response.ok ? "berhasil" : "gagal"} dikirim!
      </div>`;
  } catch (error) {
    console.error("Error:", error);
    alertBox.innerHTML = `
      <div class="alert alert-danger" role="alert">
        Survei gagal dikirim!
      </div>`;
  }
};

document.getElementById("kirimSurvei").addEventListener("click", () => {
  insertToSurveiMusiman();
});

async function getDataVoteItems() {
  try {
    const response = await fetch("http://localhost:3000/item-vote");
    const data = await response.json();
    dataVoteItem = data;
    console.log(data);
    console.log(dataVoteItem);
  } catch (error) {
    console.log("Cannot fetch data:", error);
  }
}

const formSurvei_Select = document.getElementById("formSurvei_Select");
function displayOptionFormSurvey() {
  console.log(dataVoteItem);
  dataVoteItem.forEach((item) => {
    const optionHTML = document.createElement("div");
    optionHTML.innerHTML = `<option value="${item.id}">${item.title}</option>`;
    formSurvei_Select.appendChild(optionHTML.children[0]);
  });
}

const containerVoteItem = document.getElementById("containerVoteItem");
function displayVoteItem() {
  const dataSorted = [...dataVoteItem].sort(
    (a, b) => b.total_vote - a.total_vote
  );
  dataSorted.forEach((data) => {
    console.log(data);
    const div = document.createElement("div");
    div.innerHTML = `
  <div class="row p-3" style="height="150px">
    <div class="col-2">
      <img
        src="${data.img_url}"
        class="img-fluid"
        alt="${data.title}"
      />
      <p>Total Vote: ${data.total_vote}</p>
    </div>
    <div class="col d-flex flex-column justify-content-center">
      <h4 class="m-0">${data.title}</h4>
      <p class="my-2">Deskripsi</p>
      <p class="overflow-y-scroll fs-small" style="width:auto; height:150px;">
        ${data.description}
      </p>
    </div>
  </div>`;
    containerVoteItem.appendChild(div.children[0]);
  });
}

window.addEventListener("load", async () => {
  await getDataVoteItems();
  displayOptionFormSurvey();
  displayVoteItem();
});
