<?php
date_default_timezone_set("Asia/jakarta");
?>
<!-- Content Start -->
<div class="content open">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
        <a href="<?= base_url(); ?>" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-warning mb-0"><i class="fa fa-user-edit"></i></h2>
        </a>
        <?php
        if ($log->level == 1) {
        ?>
            <a href="#" class="sidebar-toggler flex-shrink-0 text-white">
                <i class="fa fa-bars"></i>
            </a>
        <?php } else { ?>
            <a href="<?= base_url(); ?>" class=" flex-shrink-0 text-white">
                <i class="fa fa-home"></i>
            </a>
        <?php } ?>
        <a href="#" class="nav-link flex-shrink-0 text-white">
            <i class="fa fa-calendar mr10"></i>
            <span class="d-none d-lg-inline-flex" style="font-weight: bold;"> <?= format_indo(date('Y-m-d')) ?></span>
        </a>
        <a href="#" class="nav-link flex-shrink-0 text-white">
            <i class="fa fa-clock mr10"></i>
            <span class="d-none d-lg-inline-flex">
                <span id="jam" style="font-weight: bold;"></span>
            </span>
        </a>

        <script type="text/javascript">
            window.onload = function() {
                jam();
            }

            function jam() {
                var e = document.getElementById('jam'),
                    d = new Date(),
                    h, m, s;
                h = d.getHours();
                m = set(d.getMinutes());
                s = set(d.getSeconds());

                e.innerHTML = h + ':' + m + ':' + s;

                setTimeout('jam()', 1000);
            }

            function set(e) {
                e = e < 10 ? '0' + e : e;
                return e;
            }
        </script>

        <?php
        $harga = $this->db->query('SELECT * FROM tb_harga')->row_array();
        ?>

        <h2 style="margin-left: 130px; margin-bottom: 0px; color: white;">
            <marquee behavior="" direction="">HARGA PER <?= $harga['menit'] ?> MENIT : Rp. <?= number_format($harga['harga']) ?> </marquee>
        </h2>

        <div class="navbar-nav align-items-center ms-auto">


            <div class="nav-item dropdown ">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="<?= base_url('assets'); ?>/img/us.png" alt="" style="width: 40px; height: 40px;">
                    <span class="d-none d-lg-inline-flex text-white"><?= $log->nama_lengkap ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                    <a href="<?= base_url('master/edit_password'); ?>" class="dropdown-item">Edit Password</a>
                    <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->