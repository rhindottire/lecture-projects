$(document).ready(function () {
  $("#add-item").on("click", function () {
    const table = $("#my-table");
    const thTable = $("th");
    if (!table.hasClass("aktif")) table.addClass("aktif");
    if (!thTable.hasClass("aktif")) thTable.addClass("aktif");
    const trElement = $("<tr></tr>");
    for (let i = 0; i < 4; i++) {
      const tdElement = $("<td></td>");
      const inputElement = $("<input></input>");
      tdElement.append(inputElement);
      trElement.append(tdElement);
      if (i === 0) {
        inputElement.attr({ name: "nama", id: "nama", type: "text" });
      } else if (i === 1) {
        inputElement.attr({ name: "harga", id: "harga", type: "number" });
      } else if (i === 2) {
        inputElement.attr({ name: "jumlah", id: "jumlah", type: "number" });
      } else if (i === 3) {
        inputElement.attr({
          name: "subtotal",
          id: "subtotal",
          type: "number",
          readonly: true,
          value: "",
        }).addClass("subtotal");
      }
    }
    const tdElementAction = $("<td></td>");
    const buttonElement = $("<button>Hapus</button>");
    tdElementAction.append(buttonElement);
    trElement.append(tdElementAction);
    table.append(trElement);
    const tdElementEdit = $("<td></td>");
    const buttonElementEdit = $("<button>Edit</button>");
    tdElementAction.append(buttonElementEdit);
    trElement.append(tdElementEdit);
    table.append(trElement);
  });

  $(document).on("click", "button", function () {
    const trElement = $(this).closest("tr");
    trElement.remove();
    hitungTotal();
  });

  $(document).on("input", "#nama", function () {
    const inputNama = $(this);
    const inputJumlah = $(this).parent().next().find("input");
    const inputHarga = $(this).parent().next().next().find("input");
    const inputSubTotal = $(this).parent().next().next().next().find("input");
    hitungSubTotal(inputNama, inputHarga, inputJumlah, inputSubTotal);
    hitungTotal();
  });

  $(document).on("input", "#jumlah", function () {
    const inputNama = $(this).parent().prev().prev().find("input");
    const inputJumlah = $(this);
    const inputHarga = $(this).parent().prev().find("input");
    const inputSubTotal = $(this).parent().next().find("input");
    hitungSubTotal(inputNama, inputHarga, inputJumlah, inputSubTotal);
    hitungTotal();
  });

  $(document).on("input", "#harga", function () {
    const inputNama = $(this).parent().prev().find("input");
    const inputHarga = $(this);
    const inputJumlah = $(this).parent().next().find("input");
    const inputSubTotal = $(this).parent().next().next().find("input");
    hitungSubTotal(inputNama, inputHarga, inputJumlah, inputSubTotal);
    hitungTotal();
  });
});

function hitungSubTotal(inputNama, inputHarga, inputJumlah, inputSubTotal) {
  let namaBarang = inputNama.val();
  let hargaBarang = parseInt(inputHarga.val());
  let jumlahBarang = parseInt(inputJumlah.val());
  if (isNaN(hargaBarang) || isNaN(jumlahBarang) || hargaBarang === 0 || jumlahBarang === 0 || namaBarang == "") {
    inputSubTotal.val("");
  } else {
    inputSubTotal.val(jumlahBarang * hargaBarang);
  }
}

function hitungTotal() {
  const subTotals = $(".subtotal");
  const total = $("#total");
  let totalValue = 0;
  subTotals.each(function () {
    const subTotalValue = parseInt($(this).val());
    if (!isNaN(subTotalValue)) {
      totalValue += subTotalValue;
    }
  });
  total.html("Total Harga : " + totalValue);
}