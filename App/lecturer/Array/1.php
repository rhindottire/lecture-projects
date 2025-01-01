<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contoh array</title>
</head>
<body>
  <?php 
    $kota = array("Medan","Jakarta","Bandung","Denpasar","Makasar");
    $jumlah = count($kota);
    for ($i=0; $i < $jumlah; $i++) {
      print("\$kota[$i] : $kota[$i]<br>\n");
    }
  ?>
</body>
</html>