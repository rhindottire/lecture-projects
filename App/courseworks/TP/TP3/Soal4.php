<?php
    // 3.4. Mengakses array asosiatif dengan perulangan
    $height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);

    // 3.4.1 Tambahkan 5 data baru ke dalam array $height
    // $height = array_merge($height, [
    //     "Diana" => 160,
    //     "Evan" => 175,
    //     "Fiona" => 180,
    //     "Gavin" => 172,
    //     "Holly" => 169
    // ]);

    // 3.4.2 Tampilkan semua data dari array $weight
    // $weight = ["Andy" => 60, "Barry" => 55, "Charlie" => 65]; // mengubah variable $height menjadi $weight
    
    foreach ($height as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }
?>