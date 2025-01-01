$("#add").click(function () {
  const row = $(".row");
  const col = `
    <div class="col">
        <div class="nama"><input type="text" name="nama" id="nama"></div>
        <div class="harga"><input type="number" name="harga" id="harga"></div>
        <div class="jumlah"><input type="number" name="jumlah" id="jumlah"></div>
        <div class="subtotal"><p id="subtotalvalue" class="subtotalvalue"></p></div>
        <div class="aksi"><button id="delete">Delete</button></div>
    </div>
    `;

  if ($(row.children().hasClass("initial"))) {
    $(row.children().addClass("col"));
    $(row.children().removeClass("initial"));
  }

  row.append(col);
});

$(document).click(function (e) {
  if (e.target.id === "nama") {
    const subTotal = $(e.target).parent().parent().children(".subtotal").children("p");
    $(e.target).on("input", function () {
      subTotal.text(hitungSubTotal($("#nama").val(), $("#harga").val(), $("#jumlah").val()));

      hitungTotal();
    });
  } else if (e.target.id === "harga") {
    const subTotal = $(e.target).parent().parent().children(".subtotal").children("p");
    $(e.target).on("input", function () {
      subTotal.text(hitungSubTotal($("#nama").val(), $("#harga").val(), $("#jumlah").val()));

      hitungTotal();
    });
  } else if (e.target.id === "jumlah") {
    const subTotal = $(e.target).parent().parent().children(".subtotal").children("p");
    $(e.target).on("input", function () {
      subTotal.text(hitungSubTotal($("#nama").val(), $("#harga").val(), $("#jumlah").val()));

      hitungTotal();
    });
  } else if (e.target.id === "delete") {
    $(e.target).click(function () {
      $(this).parent().parent().remove();

      hitungTotal();
    });
  }
});

function hitungSubTotal(inputName, inputHarga, inputJumlah) {
  let subTotal = 0;
  if (inputName === "") {
    return;
  }
  subTotal = inputHarga * inputJumlah;
  return subTotal;
}

function hitungTotal() {
  let total = 0;
  $(".subtotalvalue").each(function () {
    const value = parseInt($(this).text());
    if (!isNaN(value)) {
      total += parseInt(value);
    }
  });
  $("#total").text("Total : " + total);
}
