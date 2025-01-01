<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function kuadrat($bilangan) {
            $hasil = $bilangan * $bilangan;
            return $hasil;
        }
        
        print(kuadrat(5));
    ?>
</body>
</html>