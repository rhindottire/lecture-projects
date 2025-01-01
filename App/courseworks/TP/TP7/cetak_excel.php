<?php
include 'koneksi.php';

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr><th colspan='3'>Rekap Laporan Penjualan $start_date sampai $end_date</th></tr>";
echo "<tr></tr>";

echo "<tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
      </tr>";

$query = "SELECT waktu_transaksi AS tanggal, total FROM transaksi 
          WHERE waktu_transaksi BETWEEN '$start_date' AND '$end_date' 
          ORDER BY waktu_transaksi";
$result = mysqli_query($conn, $query);

$total_pendapatan = 0;
$jumlah_pelanggan = 0;
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>Rp" . number_format($row['total'], 0, ',', '.') . "</td>";
    echo "<td>" . date("d-M-y", strtotime($row['tanggal'])) . "</td>";
    echo "</tr>";
    
    $total_pendapatan += $row['total'];
    $jumlah_pelanggan++;
}

echo "<tr></tr>";

echo "<tr>
        <th>Jumlah Pelanggan</th>
        <th colspan='2'>Jumlah Pendapatan</th>
      </tr>";
echo "<tr>
        <td>$jumlah_pelanggan Orang</td>
        <td colspan='2'>Rp" . number_format($total_pendapatan, 0, ',', '.') . "</td>
      </tr>";
echo "</table>";
?>
