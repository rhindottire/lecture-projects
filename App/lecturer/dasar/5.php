<!DOCTYPE html>
<html>
<head>
  <title>Contoh Operator Arithmethic</title>
</head>
<body>
  <form name="calculator" method="post" action="">
    <table>
      <tr>
        <td colspan="2">
          <div align="center">Calculator Sederhana</div>
        </td>
      </tr>
      <tr>
        <td>Operand Pertama</td>
        <td><input type="text" name="nilaipertama" required></td>
      </tr>
      <tr>
        <td>Operator</td>
        <td>
          <select name="operator">
            <option value="*">Perkalian</option>
            <option value="/">Pembagian</option>
            <option value="%">Modulus</option>
            <option value="+">Penjumlahan</option>
            <option value="-">Pengurangan</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Operand Kedua</td>
        <td><input type="text" name="nilaikedua" required></td>
      </tr>
      <tr>
        <td><input type="submit" name="proses" value="Hitung"></td>
      </tr>
    </table>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nilaipertama = $_POST["nilaipertama"];
      $operator = $_POST["operator"];
      $nilaikedua = $_POST["nilaikedua"];

      if (is_numeric($nilaipertama) && is_numeric($nilaikedua)) {
          if ($operator == "*") {
              $hasil = $nilaipertama * $nilaikedua;
              echo "<br> Hasil Perkalian = <b>$hasil</b>";
          } elseif ($operator == "/") {
              if ($nilaikedua != 0) {
                  $hasil = $nilaipertama / $nilaikedua;
                  echo "<br> Hasil Pembagian = <b>$hasil</b>";
              } else {
                  echo "<br> Pembagian dengan nol tidak diperbolehkan!";
              }
          } elseif ($operator == "%") {
              $hasil = $nilaipertama % $nilaikedua;
              echo "<br> Hasil Modulus = <b>$hasil</b>";
          } elseif ($operator == "+") {
              $hasil = $nilaipertama + $nilaikedua;
              echo "<br> Hasil Penjumlahan = <b>$hasil</b>";
          } elseif ($operator == "-") {
              $hasil = $nilaipertama - $nilaikedua;
              echo "<br> Hasil Pengurangan = <b>$hasil</b>";
          }
      } else {
          echo "<br> Silakan masukkan angka yang valid untuk kedua operand!";
      }
  }
  ?>
</body>
</html>