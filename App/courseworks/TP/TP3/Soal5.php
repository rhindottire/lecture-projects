<?php
    // 3.5. Deklarasi dan akses array multidimensi
    $students = array(
        array("Andy", "220401", "0812345678"),
        array("Bianca", "220402", "0812345687"),
        array("Candice", "220403", "0812345665"),
        array("ACHMAD", "220404", "1234567890"), // New student 1
        array("RIDHO", "220405", "0987654321"), // New student 2
        array("FA'IZ", "220406", "1010101010"), // New student 3
        array("EDHO", "220407", "0101010101"), // New student 4
        array("DODO", "220408", "1111111111"), // New student 5
    );

    // 3.5.2 Tampilkan data dalam array $students dalam bentuk tabel
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Name</th><th>ID</th><th>KEY</th></tr>";

    for ($row = 0; $row < count($students); $row++) {
        echo "<tr>";
        for ($col = 0; $col < 3; $col++) {
            echo "<td>" . $students[$row][$col] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
?>