function displayDataInTable(data) {
  const tableBody = document.querySelector(`#tabelKritik tbody`);
  tableBody.innerHTML = "";
  data.forEach((item, index) => {
    const { user, email, rating, kritiksaran } = item;
    const tableRow = document.createElement("tr");
    tableRow.innerHTML = `
        <td>${index + 1}</td>
        <td>${user}</td>
        <td>${email}</td>
        <td>${rating}</td>
        <td>${kritiksaran}</td>
        <td class="d-flex justify-content-center gap-2">
          <button id="balasBtn${
            item.id
          }" class="btn btn-success badge" data-bs-toggle="modal" data-bs-target="#kelolaKritik">Balas</button>
          <button id="deleteKritikBtn${
            item.id
          }" class="btn btn-danger badge">Del</button>
        </td>
        `;
    tableBody.appendChild(tableRow);
    document.getElementById("alertBoxFormKelolaKritik").innerHTML = "";
    document
      .getElementById(`balasBtn${item.id}`)
      .addEventListener("click", () => {
        displayModalKirimBalasan(item);
      });

    document
      .getElementById(`deleteKritikBtn${item.id}`)
      .addEventListener("click", () => {
        if (confirm(`yakin menghapus baris ${item.user}`)) {
          deleteKritik(item.id);
        }
      });
  });
}

function displayModalKirimBalasan(data) {
  document.getElementById("formKelolaKritikNamaUser").value = data.user;
  document.getElementById("formKelolaKritikEmailUser").value = data.email;
  document.getElementById("formKelolaKritikBalasan").value = `Dear ${data.user},

Terima kasih telah meluangkan waktu untuk memberikan masukan kepada kami. terima kasih atas kontribusi Anda. Kami berharap Anda akan terus memberikan umpan balik yang membangun di masa mendatang.
Salam hormat,

Admin`;
}

async function deleteKritik(idUser) {
  try {
    const response = await fetch(
      `http://localhost:3000/kritik-dan-saran/${idUser}`,
      {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
    initializeTableKritk();
    console.log(response);
  } catch (error) {
    console.log("Cannot delete data:", error);
  }
}

async function initializeTableKritk() {
  try {
    const response = await fetch("http://localhost:3000/kritik-dan-saran");
    const data = await response.json();
    displayDataInTable(data);
  } catch (error) {
    console.log("Cannot load Data kritik dan saran:", error);
  }
}

async function kirimEmail(data) {
  const alertBox = document.getElementById("alertBoxFormKelolaKritik");
  alertBox.innerHTML = "";

  try {
    const response = await fetch("http://localhost:3000/send-email", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });

    if (response.status == 200) {
      const data = await response.json();
      alertBox.innerHTML = `
      <div class="alert alert-success" role="alert">
        Email berhasil dikirim!
      </div>`;
    } else {
      alertBox.innerHTML = `
      <div class="alert alert-danger" role="alert">
        Email gagal dikirim!
      </div>`;
    }
  } catch (error) {
    console.log("Cannot send email:", error);
    alertBox.innerHTML = `
    <div class="alert alert-danger" role="alert">
      Email gagal dikirim!
    </div>`;
  }
}

document.getElementById("kirimBalasanKritik").addEventListener("click", () => {
  const dataBalasan = {
    emailUser: document.getElementById("formKelolaKritikEmailUser").value,
    isiBalasan: document.getElementById("formKelolaKritikBalasan").value,
  };
  kirimEmail(dataBalasan);
});

window.addEventListener("load", async () => {
  initializeTableKritk();
});
