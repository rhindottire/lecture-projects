<?php 
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table th {
            background-color: #89CFEF;
            color: black;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .btn-info {
            color: white;
            background-color: #17a2b8;
        }
        .btn-danger {
            color: white;
        }
        .header-button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .page-title {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">DODO's Store</a>
        <div>
            <a href="#" class="text-white mx-2">Supplier</a>
            <a href="#" class="text-white mx-2">Barang</a>
            <a href="#" class="text-white mx-2">Transaksi</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h4 class="mb-3 page-title">Transaction Master Data</h4>
        <div class="d-flex justify-content-end mb-3">
            <a href="report_transaksi.php" class="btn header-button mr-2">Sales Report</a>
            <button class="btn btn-success">Add Transaction</button>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Waktu Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT *,
                          transaksi.id AS id_transaksi,
                          pelanggan.id AS pelanggan_id,
                          pelanggan.nama AS nama_pelanggan 
                          FROM transaksi
                          JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id";
                $result = mysqli_query($conn, $query);
                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['id_transaksi'] . "</td>";
                    echo "<td>" . $row['waktu_transaksi'] . "</td>";
                    echo "<td>" . $row['nama_pelanggan'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>Rp" . number_format($row['total'], 0, ',', '.') . "</td>";
                    echo "<td>";
                    echo "<a href='#' class='btn btn-info btn-sm'>Detail</a> ";
                    echo "<button class='btn btn-danger btn-sm'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
