<?php
    // 3.2. Panjang array dan akses array terindeks menggunakan looping
    $fruits = array("Avocado", "Blueberry", "Cherry");

    // 3.2.1 Tambahkan 5 data
    // array_push($fruits, "Mango", "Orange", "Banana", "Pineapple", "Apple");
    $arrlenght = count($fruits);

    // 3.2.2 Buat array $veggies
    $veggies = array("Carrot", "Broccoli", "Spinach"); // count($veggies);

    for ($x = 0; $x < $arrlenght; $x++) {
        echo $fruits[$x];
        echo "<br>";
    }
?>