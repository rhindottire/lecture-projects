<?php
    $matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
    $praktikum = ["JARKOM", "PAW"];

    // for ($i = 0; $i < count($matkul); $i++) {
    //     if (in_array($matkul[$i], $praktikum)) {
    //         echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikumnya<br>";
    //     } elseif ($i == 6 || $i == 7) {
    //         echo "Saya belum mengambil matkul " . $matkul[$i] . "<br>";
    //     } else {
    //         echo "Saya sudah mengambil matkul " . $matkul[$i] . " semester lalu<br>";
    //     }
    // }

    foreach ($matkul as $i) {
        switch ($i) {
            case "PTI" :
            case 'ALPRO':
            case 'DPW':
            case 'STRUKDAT':
                echo "Saya sudah mengambil matkul " . $i . " semester lalu<br>";
                break;
            case 'JARKOM':
            case 'PAW':
                echo "Saya sedang mengambil matkul " . $i . " termasuk praktikumnya<br>";
                break;
            default:
                echo "Saya belum mengambil matkul " . $i . " semester lalu<br>";
                break;
        }
    }
?>