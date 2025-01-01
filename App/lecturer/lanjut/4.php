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
            print("$bilangan<br>");
            if ($bilangan == 7) {
                print("break<br>");
                break;
            }
        }
    ?>
</body>
</html>