<HTML>
<BODY>
    <form name="diskon" method="post" action="">
        <table>
            <tr>
                <td>Penentuan Diskon</td>
            </tr>
            <tr>
                <td>Besar Pembelian: Rp.<input name="beli" type="text"></td>
            </tr>
            <tr>
                <td><input type="submit" name="proses" value="Hitung"></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['beli']) && $_POST['beli'] !== "") {
        $beli = intval($_POST['beli']);
        $diskon = 0;
        if ($beli >= 10000) {
            $diskon = intval(0.1 * $beli);
        }
        print("Diskon= Rp." . $diskon . "<br>");
        print("Pembayaran= Rp." . ($beli - $diskon) . "<br>");
    }
    ?>
</BODY>
</HTML>