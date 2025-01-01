<?php
// Fungsi faktorial
function faktorial($m) {
    if ($m == 0) {
        return 1;
    } else {
        return $m * faktorial($m - 1);
    }
}

// Fungsi fibonacci
function fibonacci($n) {
    if ($n == 1 || $n == 2) {
        return 1;
    } else {
        return fibonacci($n - 1) + fibonacci($n - 2);
    }
}

// Fungsi konversi suhu
function konversiSuhu($celcius, $tipe) {
    switch ($tipe) {
        case 'fahrenheit':
            return (9/5 * $celcius) + 32;
        case 'reamur':
            return (4/9 * $celcius) + 32;
        case 'kelvin':
            return 273 + $celcius;
    }
}

// Memeriksa apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu = $_POST['menu'];
    
    switch ($menu) {
        case 'faktorial':
            $m = $_POST['m'];
            $result = faktorial($m);
            echo "Faktorial dari $m adalah $result<br>";
            break;
        
        case 'fibonacci':
            $n = $_POST['n'];
            $result = fibonacci($n);
            echo "Fibonacci ke-$n adalah $result<br>";
            break;
        
        case 'konversi':
            $celcius = $_POST['celcius'];
            $tipe = $_POST['tipe'];
            $result = konversiSuhu($celcius, $tipe);
            echo "Suhu dalam $tipe adalah $result<br>";
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Fungsi</title>
</head>
<body>
    <h2>Program Menu Fungsi</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Pilih Fungsi: <br>
        <input type="radio" name="menu" value="faktorial"> Faktorial<br>
        <input type="radio" name="menu" value="fibonacci"> Fibonacci<br>
        <input type="radio" name="menu" value="konversi"> Konversi Suhu<br><br>
        
        <!-- Input untuk Faktorial -->
        Input nilai m (untuk faktorial): <input type="number" name="m" min="0" value="0"><br>

        <!-- Input untuk Fibonacci -->
        Input nilai n (untuk fibonacci): <input type="number" name="n" min="1" value="1"><br>

        <!-- Input untuk Konversi Suhu -->
        Input nilai derajat Celcius: <input type="number" name="celcius" value="0"><br>
        Konversi ke: 
        <select name="tipe">
            <option value="fahrenheit">Fahrenheit</option>
            <option value="reamur">Reamur</option>
            <option value="kelvin">Kelvin</option>
        </select><br><br>

        <input type="submit" value="Hitung">
    </form>
</body>
</html>