<HTML>
<HEAD>
    <TITLE>Contoh Operator Comparison</TITLE>
</HEAD>
<BODY>
    <?php
        $kode_hari = date("w");
        if ($kode_hari == 0)
            print("Minggu");
        elseif ($kode_hari == 1)
            print("Senin");
        elseif ($kode_hari == 2)
            print("Selasa");
        elseif ($kode_hari == 3)
            print("Rabu");
        elseif ($kode_hari == 4)
            print("Kamis");
        elseif ($kode_hari == 5)
            print("Jumat");
        else
            print("Sabtu");
    ?>
</BODY>
</HTML>