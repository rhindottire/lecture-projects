<!DOCTYPE html>
<html>
<body>
    <form name="bangun2d" method="post" action="">
        <table>
            <tr>
                <td colspan="2">
                    <div align="center">Menentukan Karakteristik Bangun 2 Dimensi</div>
                </td>
            </tr>
            <tr>
                <td>Nama Bangun</td>
                <td>
                    <select name="bangun">
                        <option value="stg">Segitiga</option>
                        <option value="bs">Bujur Sangkar</option>
                        <option value="psp">Persegi Panjang</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="pilih" value="Pilih">
                </td>
            </tr>
        </table>
    </form>

    <br>

    <?php
    if (isset($_POST['pilih'])) {
        $namabangun = filter_input(INPUT_POST, 'bangun', FILTER_SANITIZE_STRING);
        if ($namabangun) {
            switch ($namabangun) {
                case "stg":
                    echo "Karakteristik dari Segitiga adalah:<br>";
                    echo " - ada 3 sisi<br>";
                    echo " - besar setiap sudut 60 derajat<br>";
                    echo " - memiliki alas dan tinggi<br>";
                    echo " - memiliki 3 diagonal<br>";
                    break;
                case "bs":
                    echo "Karakteristik dari Bujur Sangkar adalah:<br>";
                    echo " - ada 4 sisi<br>";
                    echo " - besar setiap sudut 90 derajat<br>";
                    echo " - memiliki 4 sisi yang sama panjang<br>";
                    echo " - memiliki 1 diagonal<br>";
                    break;
                case "psp":
                    echo "Karakteristik dari Persegi Panjang adalah:<br>";
                    echo " - ada 4 sisi<br>";
                    echo " - besar setiap sudut 90 derajat<br>";
                    echo " - memiliki panjang dan lebar<br>";
                    echo " - memiliki 2 diagonal<br>";
                    break;
                default:
                    echo "Bangun tidak dikenal.<br>";
            }
        } else {
            echo "Silakan pilih bangun 2D.<br>";
        }
    }
    ?>
</body>
</html>