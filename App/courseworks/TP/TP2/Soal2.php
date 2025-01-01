<?php
  $matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

  foreach ($matkul as $alias) {
      switch ($alias) {
          case "PTI":
          case "ALPRO":
          case "DPW":
          case "STRUKDAT":
          case "JARKOM":
          case "PAW":
              echo "Saya suka " . $alias . "<br>";
              break;
          default:
              echo "Saya tidak mengambil matkul " . $alias . "<br>";
              break;
      }
  }
?>