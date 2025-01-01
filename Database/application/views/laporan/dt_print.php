<style>
    table.tab {
        width: 100%;
        border: 1px solid red;
        font-size: 9pt;
    }

    .tab th {
        border: 1px solid red;
        font-weight: bold;
        color: white;
        text-align: center;
    }

    .tab td {
        border: 1px solid red;
        color: white;
    }

    table.tab2 {
        width: 100%;
        border: 1px solid red;
        font-size: 20pt;
    }

    .tab2 th {
        border: 1px solid red;
        font-weight: bold;
        color: black;
        text-align: center;
    }

    .tab2 td {
        border: 1px solid red;
        color: white;
        font-weight: bold;
    }
</style>
<div class="row">
    <div class="col-md-3">
        <h5 style="text-align: center; color: red; font-weight: bold;">PENDAPATAN</h5>
        <table class="tab">
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>JUMLAH</th>
            </tr>
            <?php if (!empty($v_pdt->row())) { ?>
                <?php $no = 1; ?>
                <?php foreach ($v_pdt->result() as $p) { ?>
                    <?php $pdt = $v_ttl_pdt['ttl_dby']; ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($p->tgl)); ?></td>
                        <td>Rp. <span style="float: right;"><?= number_format($p->dby, 0, ",", "."); ?>,-</span></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" class="text-center">TOTAL</td>
                    <td>Rp. <span style="float: right;"><?= number_format($v_ttl_pdt['ttl_dby'], 0, ",", "."); ?>,-</span></td>
                </tr>
            <?php } else { ?>
                <?php $pdt = 0; ?>
                <tr>
                    <td colspan="2" class="text-center">TOTAL</td>
                    <td>Rp. <span style="float: right;">0,-</span></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="col-md-3">
        <h5 style="text-align: center; color: red; font-weight: bold;">PENJUALAN</h5>
        <table class="tab">
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>JUMLAH</th>
            </tr>
            <?php if (!empty($v_pjl->row())) { ?>
                <?php $no = 1; ?>
                <?php foreach ($v_pjl->result() as $p) { ?>
                    <?php $pjl = $v_ttl_pjl['ttl_jum']; ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($p->tgl)); ?></td>
                        <td>Rp. <span style="float: right;"><?= number_format($p->jum, 0, ",", "."); ?>,-</span></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" class="text-center">TOTAL</td>
                    <td>Rp. <span style="float: right;"><?= number_format($v_ttl_pjl['ttl_jum'], 0, ",", "."); ?>,-</span></td>
                </tr>
            <?php } else { ?>
                <?php $pjl = 0; ?>
                <tr>
                    <td colspan="2" class="text-center">TOTAL</td>
                    <td>Rp. <span style="float: right;">0,-</span></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="col-md-3">
        <h5 style="text-align: center; color: red; font-weight: bold;">PENGELUARAN</h5>
        <table class="tab">
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>JUMLAH</th>
            </tr>
            <?php if (!empty($v_pgl->row())) { ?>
                <?php $no = 1; ?>
                <?php foreach ($v_pgl->result() as $p) { ?>
                    <?php $pgl = $v_ttl_pgl['ttl_jump']; ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($p->tgl)); ?></td>
                        <td>Rp. <span style="float: right;"><?= number_format($p->jum, 0, ",", "."); ?>,-</span></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" class="text-center">TOTAL</td>
                    <td>Rp. <span style="float: right;"><?= number_format($pgl, 0, ",", "."); ?>,-</span></td>
                </tr>
            <?php } else { ?>
                <?php $pgl = 0; ?>
                <tr>
                    <td colspan="2" class="text-center">TOTAL</td>
                    <td>Rp. <span style="float: right;">0,-</span></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="col-md-3">
        <h5 style="text-align: center; color: red; font-weight: bold;">TOTAL KESELURUH</h5>
        <table class="tab2">
            <tr style="background-color: yellow;">
                <th class="text-center">OMSET</th>
            </tr>
            <?php
            $oms = $pdt + $pjl;
            ?>
            <tr>
                <td>Rp. <span style="float: right;"><?= number_format($oms, 0, ",", "."); ?>,-</span></td>
            </tr>
        </table>
        <br>
        <table class="tab2">
            <tr style="background-color: cyan;">
                <th class="text-center">PENGELUARAN</th>
            </tr>
            <tr>
                <td>Rp. <span style="float: right;"><?= number_format($pgl, 0, ",", "."); ?>,-</span></td>
            </tr>
        </table>
        <br>
        <table class="tab2">
            <tr style="background-color: white;">
                <th class="text-center">PENDAPATAN BERSIH</th>
            </tr>
            <?php
            $ber = $oms - $pgl;
            ?>
            <tr>
                <td>Rp. <span style="float: right;"><?= number_format($ber, 0, ",", "."); ?>,-</span></td>
            </tr>
        </table>
    </div>
</div>