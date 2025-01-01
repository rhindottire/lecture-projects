<?php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=data_penjualan.xls");

echo "Produk\tPenjualan\n";
echo "Produk A\t12\n";
echo "Produk B\t19\n";
echo "Produk C\t3\n";
echo "Produk D\t5\n";

// header("Location: index.php");
// exit();
?>
