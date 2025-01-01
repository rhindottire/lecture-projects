<?php
  // 3.1. Deklarasi dan akses array terindeks
  $fruits = array("Avocado", "Blueberry", "Cherry");
  echo "I like " . $fruits[0] . ", " . $fruits[1] . ", and " . $fruits[2] . ". <br>";

  // 3.1.1 Tambahkan 5 data baru dan tampilkan indeks tertinggi
  array_push($fruits, "mango", "pineapple", "apple", "strawberry", "grape");
  echo "Indeks tertinggi dari \$fruits: " . (count($fruits) - 1) . "<br>";

  // 3.1.2 Hapus satu data dan tampilkan indeks tertinggi
  unset($fruits[1]);
  echo "Setelah penghapusan, indeks tertinggi dari \$fruits: " . (count($fruits) - 1) . "<br>";

  // 3.1.3 Buat array $veggies dengan 3 data dan tampilkan
  $veggies = ["Carrot", "Broccoli", "Tomato"];
  echo "Data dalam array \$veggies: <br>";
  print_r($veggies);
?>