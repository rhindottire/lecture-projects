<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contoh fungsi sort</title>
</head>
<body>
  <?php 
    $buah = array("A" => "Nanas",
                  "E" => "Pepaya",
                  "C" => "Mangga",
                  "F" => "Apel");
    print("Data asli : <br>");
    foreach($buah as $index => $nilai) {
      print("[$index] adalah $nilai <br>");
    }
    print("Hasil sort: <br>");
    sort($buah);
    foreach($buah as $indeks => $nilai){
      print("[$indeks] adalah $nilai <br>");
    }
  ?>
</body>
</html>