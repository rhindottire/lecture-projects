<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contoh array index berupa string</title>
</head>
<body>
  <?php 
    $mobil["tipe"]="Sidekick";
    $mobil["merk"]="Suzuki";
    $mobil["warna"]="Merah";
    foreach($mobil as $index => $elemen) {
      print("$index : $elemen<br>\n");
    }
  ?>
</body>
</html>