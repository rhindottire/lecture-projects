<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= base_url('assets/'); ?>img/logops.svg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js "></script>
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css " rel="stylesheet">

    <link href="<?= base_url('assets/'); ?>js/table/jquerydatatable.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/'); ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/'); ?>jquery.countdown-2.2.0/jquery.countdown.min.js"></script>


    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet">
    <style>
        .navbar {
            border-bottom: 5px solid white;
        }

        .t_org {
            color: #FF4400;
        }

        .mr10 {
            margin-right: 10px;
        }

        .btn-save {
            width: 100%;
            height: 80px;
            font-weight: bold;
            font-size: 20pt;
        }

        .btn-add {
            width: 100%;
            height: 120px;
            text-align: center;
            font-weight: bold;
            font-size: 20pt;
        }

        .tab-snack tr td {
            padding: 2px;
            font-size: 8pt;
        }

        .cnl {
            border: 3px solid darkorange;
            text-align: center;
            color: red;
            margin-bottom: 10px;
        }

        .cnl2 {
            border: 1px solid white;
            text-align: center;
            color: red;
            margin-bottom: 10px;
        }


        #exampleModalLabel {
            color: red;
        }

        .blink {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->