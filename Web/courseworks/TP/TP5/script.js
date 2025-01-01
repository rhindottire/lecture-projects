// querySelector adalah metode memilih elemen pertama dalam dokumen

// addEventListener adalah metode menjalankan fungsi jika sebuah peristiwa (click, scroll, dll)

// createElement adalah metode membuat elemen baru

// appendChild adalah metode menambahkan elemen baru

// querySelectorAll adalah metode memilih semua elemen yang cocok dengan selektor

// removeChild adalah metode menghapus elemen anak dari sebuah elemen induk dalam DOM (Document Object Model)

// innerHTML adalah metode mengatur konten HTML dari suatu elemen dan memenampilkan isi elemen

// forEach adalah metode mengeksekusi fungsi tertentu pada setiap elemen dalam sebuah array

// parseInt adalah fungsi mengonversi string ke integer

// isNaN adalah fungsi menentukan apakah suatu nilai adalah NaN (Not-a-Number)

const addItem = document.querySelector("#add-item");

addItem.addEventListener("click", () => {
  const table = document.querySelector("#my-table");
  const thTable = document.querySelector("th");
  table.classList.contains("aktif") ? "" : table.classList.add("aktif");
  thTable.classList.contains("aktif") ? "" : thTable.classList.add("aktif");
  const trElement = document.createElement("tr");
  for (let i = 0; i < 4; i++) {
    const tdElement = document.createElement("td");
    const inputElement = document.createElement("input");
    tdElement.appendChild(inputElement);
    trElement.appendChild(tdElement);
    if (i === 0) {
      inputElement.name = "nama";
      inputElement.id = "nama";
      inputElement.type = "text";
    } else if (i === 1) {
      inputElement.name = "harga";
      inputElement.id = "harga";
      inputElement.type = "number";
    } else if (i === 2) {
      inputElement.name = "jumlah";
      inputElement.id = "jumlah";
      inputElement.type = "number";
    } else if (i === 3) {
      inputElement.name = "subtotal";
      inputElement.id = "subtotal";
      inputElement.classList.add("subtotal");
      inputElement.type = "number";
      inputElement.readOnly = true;
      inputElement.value = "";
    }
  }
  const tdElementAction = document.createElement("td");
  const buttonElement = document.createElement("button");
  buttonElement.textContent = "Hapus";
  tdElementAction.appendChild(buttonElement);
  trElement.appendChild(tdElementAction);
  table.appendChild(trElement);
  buttonElement.addEventListener("click", () => {
    table.removeChild(trElement);
    hitungTotal();
  });
});

document.addEventListener("click", (e) => {
  if (e.target.id === "nama") {
    e.target.addEventListener("input", () => {
      const inputNama = e.target;
      const inputJumlah = e.target.parentNode.nextSibling.firstChild;
      const inputHarga = e.target.parentNode.nextSibling.nextSibling.firstChild;
      const inputSubTotal = e.target.parentNode.nextSibling.nextSibling.nextSibling.firstChild;

      hitungSubTotal(inputNama, inputHarga, inputJumlah, inputSubTotal);
      hitungTotal();
    });
  } else if (e.target.id === "jumlah") {
    e.target.addEventListener("input", () => {
      const inputNama = e.target.parentNode.previousSibling.previousSibling.firstChild;
      const inputJumlah = e.target;
      const inputHarga = e.target.parentNode.previousSibling.firstChild;
      const inputSubTotal = e.target.parentNode.nextSibling.firstChild;

      hitungSubTotal(inputNama, inputHarga, inputJumlah, inputSubTotal);
      hitungTotal();
    });
  } else if (e.target.id === "harga") {
    e.target.addEventListener("input", () => {
      const inputNama = e.target.parentNode.previousSibling.firstChild;
      const inputHarga = e.target;
      const inputJumlah = e.target.parentNode.nextSibling.firstChild;
      const inputSubTotal = e.target.parentNode.nextSibling.nextSibling.firstChild;

      hitungSubTotal(inputNama, inputHarga, inputJumlah, inputSubTotal);
      hitungTotal();
      
    });
  }
});

function hitungSubTotal(inputNama, inputHarga, inputJumlah, inputSubTotal) {
  let namaBarang = inputNama.value;
  let hargaBarang = parseInt(inputHarga.value);
  let jumlahBarang = parseInt(inputJumlah.value);
  if (isNaN(hargaBarang) || isNaN(jumlahBarang) || hargaBarang === 0 || jumlahBarang === 0 || namaBarang == "") {
    inputSubTotal.value = "";
  } else {
    inputSubTotal.value = jumlahBarang * hargaBarang;
  }
  // isNaN(hargaBarang) || isNaN(jumlahBarang) || hargaBarang === 0 || jumlahBarang === 0 || namaBarang == "" ? inputSubTotal.value = 0 : inputSubTotal.value = jumlahBarang * hargaBarang
}

function hitungTotal() {
  const subTotals = document.querySelectorAll(".subtotal");
  const total = document.querySelector("#total");
  let totalValue = 0;
  subTotals.forEach((subTotal) => {
    const subTotalValue = parseInt(subTotal.value);
    if (!isNaN(subTotalValue)) {
      totalValue += subTotalValue;
    }
  });
  total.innerHTML = "Total Harga : " + totalValue;
}