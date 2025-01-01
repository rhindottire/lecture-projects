const masterForm = document.querySelector("#masterForm");
// send data
masterForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(masterForm);
  const data = new URLSearchParams(formData);
  // data.forEach((value, key) => {
  //   console.log(`${key}: ${value}`);
  // });
  // const objData = Object.fromEntries(data);
  // get transaction token using ajax or fetch
  try {
    const response = await fetch("php/placeOrder.php", {
      method: "POST",
      body: data,
    })
    const token = await response.text();
    // console.log(typeof token)
    // document.write(token);
    window.snap.pay(token);
  } catch (error) {
    console.log(error);
  }
});













async function handleFormSubmit(form) {
  try {
    const formData = new FormData(form);
    const data = new URLSearchParams(formData);
    // data.forEach((value, key) => {
    //   console.log(`${key}: ${value}`);
    // });
    // Get transaction token using fetch or ajax
    const response = await fetch("/frontend/php/placeOrder.php", {
      method: "POST",
      body: data,
    });
    const token = await response.text();
    console.log(token);
    window.snap.pay(token, {
      onSuccess: function(result) {
        Swal.fire({
          icon: "success",
          title: "Payment Success",
          text: "Thank you for your payment",
          showConfirmButton: false,
          timer: 1500,
        });
      },
      onPending: function(result) {
        Swal.fire({
          icon: "success",
          title: "Payment Pending",
          text: "Thank you for your payment",
          showConfirmButton: false,
          timer: 1500,
        });
      },
      onError: function(result) {
        Swal.fire({
          icon: "error",
          title: "Payment Failed",
          text: "Thank you for your payment",
          showConfirmButton: false,
          timer: 1500,
        });
      },
      onClose: function() {
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
    console.log(error.message);
  }
}
document.querySelector("#basicForm").addEventListener("submit", (e) => {
  e.preventDefault();
  handleFormSubmit(e.target);
});
document.querySelector("#expertForm").addEventListener("submit", (e) => {
  e.preventDefault();
  handleFormSubmit(e.target);
});
document.querySelector("#masterForm").addEventListener("submit", (e) => {
  e.preventDefault();
  handleFormSubmit(e.target);
});