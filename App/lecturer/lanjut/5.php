<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        for ($bilangan = 1; $bilangan <= 10; $bilangan++) {
            if ($bilangan == 7) {
                print("continue<br>");
                continue;
            }
            print("$bilangan<br>");
        }
    ?>
</body>
</html>