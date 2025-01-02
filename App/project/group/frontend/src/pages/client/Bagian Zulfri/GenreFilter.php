<?php
include_once "./aksi/koneksi.php";
$page = "filter";

// Simulasi genre musik untuk browsing
$genres = query("SELECT DISTINCT genre FROM musik");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Music</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/sidebar.css">
    <style>
        /* Main Content */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #FFFFFF;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .main-content h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #1E1E1E;
            border: none;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 200px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
            justify-content: space-between;
        }

        .card h5 {
            font-size: 16px;
            color: #FFFFFF;
            margin: 0;
        }

        .card .btn {
            background-color: rgb(14 165 233);
            color: #FFFFFF;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: all .2s ease-in-out;
        }

        .card .btn:hover {
            transform: scale(1.05);
            transition: all .2s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include "./assets/sidebar.php" ?>
        <!-- Main Content -->
        <div class="main-content">
            <h1>Browse Music by Genre</h1>
            <div class="card-container">
                <?php foreach ($genres as $genre): ?>
                    <div class="card">
                        <h5 class="card-title"><?php echo $genre['genre']; ?></h5>
                        <a href="browse.php?genre=<?= $genre['genre']; ?>" class="btn">Browse <?php echo $genre['genre']; ?> Songs</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>