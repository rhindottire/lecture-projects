<?php
  // Contoh array terindeks
  $best_programmer_ever = array("ACHMAD", "RIDHO", "FA'IZ");

  // Mengakses elemen array
  echo "Array elemen pertama: " . $best_programmer_ever[0] . "<br>";
  echo "Array elemen ke-2: " . $best_programmer_ever[1] . "<br>";
  // Mengakses elemen terakhir tanpa menuliskan indeks secara eksplisit
  echo "Array elemen terakhir: " . end($best_programmer_ever);
?>