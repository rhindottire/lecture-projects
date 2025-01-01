<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Logika</title>
</head>
<body>
    <h2>Operator Logika</h2>
    <form method="post" action="">
        <label for="nilai1">Nilai 1</label>
        <select name="nilai1" id="nilai1">
            <option value="TRUE">TRUE</option>
            <option value="FALSE">FALSE</option>
        </select>

        <label for="operator">Operator</label>
        <select name="operator" id="operator">
            <option value="&&">AND</option>
            <option value="||">OR</option>
            <option value="XOR">XOR</option>
        </select>

        <label for="nilai2">Nilai 2</label>
        <select name="nilai2" id="nilai2">
            <option value="TRUE">TRUE</option>
            <option value="FALSE">FALSE</option>
        </select>

        <br>

        <button type="submit">Hitung</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nilai1 = isset($_POST['nilai1']) ? $_POST['nilai1'] : null;
        $operator = isset($_POST['operator']) ? $_POST['operator'] : null;
        $nilai2 = isset($_POST['nilai2']) ? $_POST['nilai2'] : null;

        if ($nilai1 !== null && $operator !== null && $nilai2 !== null) {
            echo "<h3>Hasil: </h3>";

            if ($operator == '&&') {
                $op_display = "AND";
                $result = ($nilai1 == 'TRUE' && $nilai2 == 'TRUE') ? 'TRUE' : 'FALSE';
            } elseif ($operator == '||') {
                $op_display = "OR";
                $result = ($nilai1 == 'TRUE' || $nilai2 == 'TRUE') ? 'TRUE' : 'FALSE';
            } elseif ($operator == 'XOR') {
                $op_display = "XOR";
                $result = ($nilai1 == 'TRUE' xor $nilai2 == 'TRUE') ? 'TRUE' : 'FALSE';
            }

            echo "<p>" . $nilai1 . " " . $op_display . " " . $nilai2 . " = " . $result . "</p>";
        } else {
            echo "<p>Isi form dengan benar.</p>";
        }
    }
    ?>
</body>
</html>