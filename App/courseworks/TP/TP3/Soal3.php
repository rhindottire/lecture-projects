<?php
  // 3.3. Deklarasi dan akses array asosiatif
  $height = array("Andy" => 176, "Barry" => 165, "Charlie" => 170);
  echo "Andy is " . $height["Andy"] . " cm tall. <br>";

  // 3.3.1 Tambahkan 5 data baru ke dalam array $height
  $height = array_merge($height, array(
    "ACHMAD" => 181,
    "RIDHO" => 182,
    "FA'IZ" => 183,
    "EDHO" => 184,
    "DODO" => 185
  ));
  echo "Indeks terakhir dalam array \$height: " . array_keys($height)[count($height) - 1] . " dengan tinggi " . end($height) . " cm<br>";

  // 3.3.2 Hapus 1 data tertentu dari array $height
  unset($height["DODO"]);
  echo "Setelah penghapusan, indeks terakhir dalam \$height: " . array_keys($height)[count($height) - 1] . " dengan tinggi " . end($height) . " cm<br>";

  // 3.3.3 Buat array $weight dan tampilkan data ke-2
  $weight = ["Andy" => 60, "Barry" => 55, "Charlie" => 65];
  echo "Data ke-2 dari array \$weight: " . array_keys($weight)[1] . " memiliki berat " . $weight["Barry"] . " kg<br>";
?>