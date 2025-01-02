
const expertForm = document.querySelector("#expertForm");
// send data
expertForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(expertForm);
  const data = new URLSearchParams(formData);
  // data.forEach((value, key) => {
  //   console.log(`${key}: ${value}`);
  // });
  const objData = Object.fromEntries(data);

  // get transaction token using ajax or fetch
  try {
    const response = await fetch("/frontend/php/placeOrder.php", {
      method: "POST",
      body: data,
    })
    const token = await response.text();
    // console.log(typeof token)
    // document.write(token);
    console.log(e.target.gross_amount.value)
    const payment = await axios.post('http://localhost:3000/api/payment/create', {
      nominal: parseInt(e.target.gross_amount.value)
    }, {
      headers: {
        'X-API-TOKEN': '<?= $_SESSION['token'] ?>'
      }
    }).then(res => res.data)
    window.snap.pay(token, {
      onSuccess: async function(result) {
        // rest api for create data subscribe
        const subscribe = await axios.post('http://localhost:3000/api/subscribe', {
          headers: {
            'X-API-TOKEN': '<?= $_SESSION["token"] ?>',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            paymentId: payment.data.id,
            jenis: "EXPERT"
          })
        }).then(res => res.json());
        Swal.fire({
          icon: "success",
          title: "Payment Success",
          text: "Thank you for your payment",
          showConfirmButton: false,
          timer: 1500,
        });
      },
      onPending: function(result) {
        // deleted payment id
        Swal.fire({
          icon: "info",
          title: "Payment Pending",
          text: "The payment was'nt completed",
          showConfirmButton: false,
          timer: 1500,
        });
      },
      onError: function(result) {
        // deleted payment id
        Swal.fire({
          icon: "error",
          title: "Payment Failed",
          text: "Thank you for your payment",
          showConfirmButton: false,
          timer: 1500,
        });
      },
      onClose: function() {
        // deleted payment id
        Swal.fire({
          icon: "error",
          title: "Payment Canceled",
          text: "Thank you for your payment",
          showConfirmButton: false,
          timer: 1500,
        });
      },
    });
  } catch (error) {
    console.log(error);
  }
});