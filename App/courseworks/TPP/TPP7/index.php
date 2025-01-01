<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grafik Penjualan Bulanan</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 50px;
    }
    h1 {
      color: #333;
    }
    .chart-container {
      width: 80%;
      max-width: 600px;
      margin-bottom: 20px;
    }
    .button-container {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }
    button {
      padding: 10px 20px;
      font-size: 16px;
      color: white;
      background-color: #28a745;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <h1>Grafik Penjualan Bulanan</h1>
  <div class="chart-container">
    <canvas id="myChart"></canvas>
  </div>
  <div class="button-container">
    <button onclick="window.print()">Print PDF</button>
    <a href="download.php">
      <button>Download Excel</button>
    </a>
  </div>
  <script>
    const data = {
      labels: ["Produk A", "Produk B", "Produk C", "Produk D"],
      datasets: [{
        label: "Penjualan",
        data: [12, 19, 3, 5],
        backgroundColor: [
          "rgba(75, 192, 192, 0.2)", 
          "rgba(255, 99, 132, 0.2)", 
          "rgba(54, 162, 235, 0.2)", 
          "rgba(255, 206, 86, 0.2)"
        ],
        borderColor: [
          "rgba(75, 192, 192, 1)", 
          "rgba(255, 99, 132, 1)", 
          "rgba(54, 162, 235, 1)", 
          "rgba(255, 206, 86, 1)"
        ],
        borderWidth: 1
      }]
    };

    const options = {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    const ctx = document.getElementById("myChart").getContext("2d");
    const myChart = new Chart(ctx, {
      type: "bar",
      data: data,
      options: options
    });
  </script>
</body>
</html>