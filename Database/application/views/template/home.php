<?php
date_default_timezone_set('Asia/Jakarta');
?>
<!-- Sale & Revenue Start -->

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-8 col-xl-8">
            <?= $this->session->flashdata('notiff'); ?>
            <div class="row" id="start">
                <?php foreach ($ch as $d) { ?>
                    <?php
                    if ($d->status != 'Y') {
                        $css = "cnl2";
                    } else {
                        $css = "cnl";
                    }
                    ?>
                    <div class="col-md-3">

                        <div class="bg-secondary rounded  p-4 <?= $css ?>">
                            <h6 style="margin-top: -12px; color: red;"><?= $d->nama_chanel ?></h6>
                            <?php if ($d->status != 'Y') { ?>
                                <h1 style="margin-top: -10px;">READY</h1>
                                <p style="margin-top: -8px; font-weight: bold; color: red;">00.00.00</p>
                                <p style="margin-top: -20px; color: red; font-size: 9pt;">MEMBER</p>
                                <button data-id="<?= $d->id_chanel ?>" data-nm="<?= $d->nama_chanel ?>" class="btn btn-success btn-md start" data-bs-toggle="modal" data-bs-target="#exampleModal">START <i class="fa fa-play-circle "></i></button>
                            <?php } else { ?>
                                <?php

                                $sew = "SELECT * FROM tb_sewa JOIN tb_member ON tb_sewa.kode_member=tb_member.kode WHERE id_chanel='$d->id_chanel' AND aktif='ON' ";
                                $on = $this->db->query($sew)->row_array();
                                $kode_mem = isset($on['kode_member']) ? $on['kode_member'] : '';
                                $start = isset($on['start']) ? $on['start'] : '';


                                $paket_sewa_ps = $this->db->query("SELECT * FROM tb_paket WHERE kode_paket='$kode_mem' ")->row();
                                $ps = $this->db->query("SELECT * FROM tb_paket WHERE kode_paket='$kode_mem' ")->row_array();

                                if (!empty($paket_sewa_ps)) {
                                    $stop = isset($on['stop']) ? $on['stop'] : '';
                                ?>

                                    <h4 style="margin-top: -10px; color: Cyan;">ON GOING</h4>
                                    <h2 style="margin-top: -10px; color: yellow;" id="paket<?= $d->id_chanel ?>">00:00:00</h2>

                                    <p style="margin-top: -5px; color: red; font-size: 9pt; text-transform: uppercase;"><?= $on['nama'] ?> <br><span style="color: Cyan;"><?= $paket_sewa_ps->paket ?></span></p>
                                    <a id="stpp<?= $d->id_chanel ?>" class="btn btn-primary btn-md btn_stop" data-hpk="<?= $paket_sewa_ps->id_paket ?>" data-pk="KO" data-nm="<?= $d->nama_chanel ?>" data-idch="<?= $d->id_chanel ?>" data-idsw="<?= $on['id_sewa'] ?>" data-idmm="<?= $on['id_member'] ?>" data-toggle="tooltip" title="STOP"> <i class="fa fa-stop-circle "></i></a>
                                    <button id="add<?= $d->id_chanel ?>" data-pk="<?= $paket_sewa_ps->id_paket ?>" data-id="<?= $on['id_sewa'] ?>" data-nmm="<?= $on['nama'] ?>" data-stp="<?= $stop ?>" data-nm="<?= $d->nama_chanel ?>" class="btn btn-info btn-md Add" data-bs-toggle="modal" data-bs-target="#exampleModalAdd"> <i class="fa fa-clock " data-toggle="tooltip" title="Tambah Waktu Sewa"></i></button>
                                    <a hidden id="stp<?= $d->id_chanel ?>" data-hpk="KO" class="btn btn-primary btn-md btn_stop" data-pk="<?= $paket_sewa_ps->id_paket ?>" data-nm="<?= $d->nama_chanel ?>" data-idch="<?= $d->id_chanel ?>" data-idsw="<?= $on['id_sewa'] ?>" data-idmm="<?= $on['id_member'] ?>">STOP <i class="fa fa-stop-circle "></i></a>
                                    <a class="btn hapus_start btn-warning" data-pk="<?= $paket_sewa_ps->id_paket ?>" data-nm="<?= $d->nama_chanel ?>" data-idch="<?= $d->id_chanel ?>" data-idsw="<?= $on['id_sewa'] ?>" data-idmm="<?= $on['id_member'] ?>" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash text-primary"></i></a>

                                    <script type="text/javascript">
                                        $('#paket<?= $d->id_chanel ?>').countdown('<?= $stop ?>', function(event) {
                                            var add = document.getElementById("add<?= $d->id_chanel ?>");
                                            var stp = document.getElementById("stp<?= $d->id_chanel ?>");
                                            var stpp = document.getElementById("stpp<?= $d->id_chanel ?>");
                                            var kn = event.strftime('%H:%M:%S');
                                            if (kn == "00:00:00") {
                                                clearInterval("#paket<?= $d->id_chanel ?>");
                                                $(this).html('WAKTU HABIS');
                                                $(this).attr('class', 'blink');
                                                stp.hidden = false;
                                                stpp.hidden = true;
                                                add.hidden = true;
                                            } else {
                                                $(this).html(event.strftime('%H:%M:%S'));
                                                stp.hidden = true;
                                                add.hidden = false;
                                                stpp.hidden = false;
                                            }
                                        });
                                    </script>

                                <?php
                                } else {

                                    $awal  = date_create($start);
                                    $akhir = date_create(date('Y-m-d H:i:s')); // waktu sekarang
                                    $diff  = date_diff($awal, $akhir);
                                    $thn = $diff->y;
                                    $bln = $diff->m;
                                    $hr = $diff->d;

                                    $jamm =  $diff->h;
                                    $mnt =  $diff->i;
                                    $dtk =  $diff->s;

                                    if ($thn > 0) {
                                        $thn1 = $thn . ' Tahun, ';
                                    } else {
                                        $thn1 = "";
                                    }
                                    if ($bln > 0) {
                                        $bln1 = $bln . ' Bulan, ';
                                    } else {
                                        $bln1 = "";
                                    }

                                    if ($hr > 0) {
                                        $hr1 = $hr . ' Hari, ';
                                    } else {
                                        $hr1 = "";
                                    }

                                    if ($jamm >= 10) {
                                        $jamm1 = $jamm;
                                    } else {
                                        $jamm1 = "0" . $jamm;
                                    }

                                    if ($mnt >= 10) {
                                        $mnt1 = $mnt;
                                    } else {
                                        $mnt1 = "0" . $mnt;
                                    }

                                    if ($dtk >= 10) {
                                        $dtk1 = $dtk;
                                    } else {
                                        $dtk1 = "0" . $dtk;
                                    }
                                    $timestampg =  $thn1 . $bln1 . $hr1 .  $jamm1 .  ":" . $mnt1 . ":" . $dtk1;

                                ?>
                                    <h4 style="margin-top: -10px; color: Cyan;">ON GOING</h4>
                                    <h2 style="margin-top: -10px; color: yellow;" id="jamServer<?= $d->id_chanel ?>"><?= $timestampg; ?></h2>
                                    <script>
                                        var serverClock = jQuery("#jamServer" + '<?= $d->id_chanel ?>');
                                        if (serverClock.length > 0) {
                                            showServerTime(serverClock, serverClock.text());
                                        }

                                        function showServerTime(obj, time) {
                                            var parts = time.split(":"),
                                                newTime = new Date('<?= $start ?>');

                                            newTime.setHours(parseInt(parts[0], 10));
                                            newTime.setMinutes(parseInt(parts[1], 10));
                                            newTime.setSeconds(parseInt(parts[2], 10));

                                            var timeDifference = new Date().getTime() - newTime.getTime();

                                            var methods = {
                                                displayTime: function() {
                                                    var now = new Date(new Date().getTime() - timeDifference);
                                                    obj.text([
                                                        methods.leadZeros(now.getHours(), 2),
                                                        methods.leadZeros(now.getMinutes(), 2),
                                                        methods.leadZeros(now.getSeconds(), 2)
                                                    ].join(":"));
                                                    setTimeout(methods.displayTime, 500);
                                                },

                                                leadZeros: function(time, width) {
                                                    while (String(time).length < width) {
                                                        time = "0" + time;
                                                    }
                                                    return time;
                                                }
                                            }
                                            methods.displayTime();
                                        }
                                    </script>
                                    <p style="margin-top: -5px; color: red; font-size: 9pt; text-transform: uppercase;"><?= $on['nama'] ?> <br><span style="color: Cyan;">auto time</span></p>
                                    <a class="btn btn-primary btn-md btn_stop" data-hpk="KO" data-pk="KO" data-nm="<?= $d->nama_chanel ?>" data-idch="<?= $d->id_chanel ?>" data-idsw="<?= $on['id_sewa'] ?>" data-idmm="<?= $on['id_member'] ?>">STOP <i class="fa fa-stop-circle "></i></a>
                                    <a class="btn hapus_start btn-warning" data-pk="KO" data-nm="<?= $d->nama_chanel ?>" data-idch="<?= $d->id_chanel ?>" data-idsw="<?= $on['id_sewa'] ?>" data-idmm="<?= $on['id_member'] ?>" style="margin-left: 10px;" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash text-primary"></i></a>
                            <?php }
                            } ?>
                        </div>
                    </div>
                <?php } ?>






            </div>
        </div>

        <div class="col-sm-4 col-xl-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-secondary rounded h-100 p-4" style="border: 1px solid red;">
                        <h6 class="text-white">DATA PEMBAYARAN</h6>
                        <?= $this->session->flashdata('test'); ?>
                        <table class="table table-bordered" style="border-color: red;">
                            <tr>
                                <th width="35%" class="text-white">ATAS NAMA</th>
                                <th class="text-white" id="ats_nm"></th>
                            </tr>
                            <tr>
                                <th class="text-white">LAMA SEWA</th>
                                <th class="text-white" id="lama"></th>
                            </tr>
                            <tr>
                                <th class="text-white">TOTAL</th>
                                <th class="text-white" id="tl_rp"></th>
                            </tr>
                            <tr>
                                <th class="text-white">SNACK/MINUMAN</th>
                                <th class="text-white" id="tl_pj"></th>
                            </tr>
                        </table>
                        <div style="width: 100%; height: 60px; border: 1px solid red; padding-left: 5px; color: white; font-size: 9pt;">
                            JUMLAH TOTAL
                            <span style="float: right; font-size: 30pt; font-weight: bold; padding-right: 5px;" id="tl_rp2">Rp.0</span>
                        </div>
                        <br>
                        <form action="<?= base_url('welcome/bayar'); ?>" method="POST">
                            <h6>STATUS : <span id="kemd">------</span></h6>
                            <input type="hidden" name="id_m" id="id_m">
                            <input type="hidden" name="id_s" id="id_s">
                            <input type="hidden" name="sewa" id="sewa">
                            <input type="hidden" name="total" id="total">
                            <input class="form-control form-control-lg mb-3 text-white" type="text" placeholder="Rp.0 " id="tanpa-rupiah">
                            <input type="hidden" name="bayar" id="hsl-jml">
                            <script>
                                $('#tanpa-rupiah').on('keyup', function() {
                                    var hrg = $(this).val();
                                    var ttk = ".";
                                    hrg = hrg.replaceAll(ttk, "");
                                    $("#hsl-jml").val(hrg);
                                    hrg = parseInt(hrg);
                                    var total = parseInt($('#total').val());

                                    var sub_total = hrg - total;


                                    var reverse = sub_total.toString().split('').reverse().join(''),
                                        ribuan_sub_total = reverse.match(/\d{1,3}/g);
                                    ribuan_sub_total = ribuan_sub_total.join(',').split('').reverse().join('');
                                    if (hrg >= total) {
                                        $("#kemd").html("<span class='text-success'> KEMBALI : Rp. " + ribuan_sub_total + "</span>");
                                    } else {
                                        $("#kemd").html("<span class='text-primary'> KURANG : Rp. " + ribuan_sub_total + "</span>");
                                    }
                                })
                            </script>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="<?= base_url('welcome'); ?>" class="btn btn-lg btn-primary btn-block "><i class="fa fa-spinner"></i> Refresh</a>
                                </div>

                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-lg btn-success btn-block btn-save"><i class="fa fa-save"></i> SIMPAN</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <h6 class="text-white">TRANSAKSI SNACK / MINUMAN</h6>
                        <br>
                        <?= $this->session->flashdata('pjl'); ?>
                        <form action="<?= base_url('welcome/penjualan'); ?>" method="POST">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis" id="snack" value="S">
                                        <label class="form-check-label text-white" for="snack">
                                            Snack
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis" id="minuman" value="M">
                                        <label class="form-check-label text-white" for="minuman">
                                            Minuman
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check ml-20">
                                        <input class="form-check-input" type="radio" name="jenis" id="mm" value="SM">
                                        <label class="form-check-label text-white" for="mm">
                                            Snack & Minuman
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <br>
                                    <select name="kode_member" class="form-control form-control-lg" id="" required>
                                        <option value=""> - Pilih Member -</option>
                                        <option value="BY"> Bayar Kes </option>
                                        <?php foreach ($ol as $o) { ?>
                                            <option value="<?= $o->kode ?>"> <?= $o->nama_chanel ?> - <?= $o->nama ?></option>
                                        <?php } ?>
                                    </select>
                                    <br>
                                    <input type="text" id="tanpa-rupiah2" class="form-control form-control-lg text-white" placeholder="Rp.0" required>
                                    <input type="hidden" name="jml_ttl" id="hsl-jml2">
                                    <script>
                                        $('#tanpa-rupiah2').on('keyup', function() {
                                            var hrg = $(this).val();
                                            var ttk = ".";
                                            hrg = hrg.replaceAll(ttk, "");
                                            $("#hsl-jml2").val(hrg);
                                        })
                                    </script>
                                </div>
                                <div class="col-md-5">
                                    <br>
                                    <button type="submit" class=" btn btn-lg btn-success btn-add"><i class="fa fa-cart-plus"></i> SIMPAN</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <button data-bs-toggle="modal" data-bs-target="#DataSewa" class="btn  btn-lg btn-primary" style="width: 100%; height: 100px; font-weight: bold;">
                                    <i class="fa fa-folder-open"></i><br>
                                    DATA SEWA/RENTAL
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button data-bs-toggle="modal" data-bs-target="#DataPenjualan" class="btn  btn-lg btn-primary" style="width: 100%; height: 100px; font-weight: bold;">
                                    <i class="fa fa-folder-open"></i><br>
                                    DATA PENJUALAN
                                </button>
                            </div>
                        </div>
                        <hr>


                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
<!-- Sale & Revenue End -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $harga = $this->db->query('SELECT * FROM tb_harga')->row_array();
            ?>
            <form action="<?= base_url('welcome/start'); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_on">
                    <input type="hidden" name="harga" id="" value="Harga per <?= $harga['menit'] ?> menit : Rp.<?= number_format($harga['harga']) ?>">
                    <label for="exampleInputEmail1" class="form-label">Atas Nama</label>
                    <input type="text" name="nm" class="form-control text-white" required placeholder="Member">
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="paket" style="border-color: red;">
                        <label class="form-check-label" for="paket">
                            Ceklis untuk pilih paket sewa
                        </label>
                    </div>
                    <input type="hidden" name="waktu" id="rubah" value="kosong">
                    <select name="waktu" class="form-select form-select-sm text-white" id="pilih_paket" disabled>
                        <option selected value="">Pilih Paket Sewa</option>
                        <option value="H">0.5 Jam</option>
                        <option value="A">1 Jam</option>
                        <option value="B">1,5 Jam</option>
                        <option value="C">2 Jam</option>
                        <option value="D">2,5 Jam</option>
                        <option value="E">3 Jam</option>
                        <option value="F">3,5 Jam</option>
                        <option value="G">4 Jam</option>
                    </select>
                    <script>
                        $('#pilih_paket').hide()
                        $('#paket').on('click', function() {
                            if ($(this).prop('checked')) {
                                $('#pilih_paket').show()
                                $('#rubah').prop("disabled", true);
                                $('#pilih_paket').prop("disabled", false);
                                // $('#hp').focus()
                            } else {
                                $('#pilih_paket').val(' ')
                                $('#pilih_paket').hide()
                                $('#rubah').prop("disabled", false);
                                $('#pilih_paket').prop("disabled", true);
                            }
                        })
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">START <i class="fa fa-play-circle "></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabelAdd"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url('welcome/add'); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_sww">
                    <input type="hidden" name="id_pk" id="id_pk_lama">
                    <input type="hidden" name="waktu_lama" id="waktu_lama">
                    <label for="exampleInputEmail1" class="form-label">Atas Nama : <span id="nama_member"></span></label>
                    <br>
                    <select name="waktu" class="form-select form-select-sm text-white">
                        <option selected value="">Tambahkan Waktu Sewa</option>
                        <option value="H">0.5 Jam</option>
                        <option value="A">1 Jam</option>
                        <option value="B">1,5 Jam</option>
                        <option value="C">2 Jam</option>
                        <option value="D">2,5 Jam</option>
                        <option value="E">3 Jam</option>
                        <option value="F">3,5 Jam</option>
                        <option value="G">4 Jam</option>
                    </select>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Add Time <i class="fa fa-clock "></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="DataSewa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">DATA SEWA/RENTAL PS : <?= format_indo(date('Y-m-d')) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="width: 100%; height: 500px; border: 1px solid red; overflow-y: auto; overflow-x: auto; ">
                    <table class=" table-bordered" style="border-color: red;  color: red; width: 100%;">
                        <thead>
                            <tr style="text-align: center;  font-size: 12pt;">
                                <th>NO</th>
                                <th>ATAS NAMA</th>
                                <th>LAMA SEWA</th>
                                <th>JUMLAH</th>
                                <th>SNACK</th>
                                <th>TOTAL</th>
                                <th>DIBAYAR</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody id="end">
                            <?php $no = 1; ?>
                            <?php

                            foreach ($byy as $b) {
                                $paket_1 = $this->db->query("SELECT * FROM tb_paket WHERE kode_paket='$b->kode'  ");
                                $snack_1 = $this->db->query("SELECT * FROM tb_penjualan WHERE kode_penjualan='$b->kode'  ");
                                $snack_2 = $this->db->query("SELECT kode_penjualan,jml, sum(jml) as jum FROM tb_penjualan WHERE kode_penjualan='$b->kode'")->row_array();
                                $cek_snack = $snack_1->row();
                                $ttl_kur = $b->total - $snack_2['jum'];

                                $paket_2 = $paket_1->num_rows();
                                $paket_3 = $paket_1->row();
                                if ($paket_2 > 0) {
                                    $id_p = $paket_3->id_paket;
                                } else {
                                    $id_p = "KO";
                                }
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $b->nama ?></td>
                                    <td class="text-center"><?= $b->lama_sewa ?></td>
                                    <?php if (!empty($cek_snack)) { ?>
                                        <td class="text-end"><?= number_format($ttl_kur, 0, ",", ".") ?>,-</td>
                                        <td class="text-end"><?= number_format($snack_2['jum'], 0, ",", ".") ?>,-</td>
                                    <?php } else { ?>
                                        <td class="text-end"><?= number_format($b->total, 0, ",", ".") ?>,-</td>
                                        <td class="text-end">0,-</td>
                                    <?php } ?>
                                    <td class="text-end"><?= number_format($b->total, 0, ",", ".") ?>,-</td>
                                    <td class="text-end"><?= number_format($b->dibayar, 0, ",", ".") ?>,-</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="#" data-bs-dismiss="modal" data-nm="<?= $b->nama ?>" data-id="<?= $b->id_member ?>" class="edit"><i class="fa fa-edit text-success" data-toggle="tooltip" title="Edit Data"></i></a>
                                            <?php if ($log->level == 1) { ?> |
                                                <a href="#" data-bs-dismiss="modal" data-kd="<?= $b->kode ?>" data-id_p="<?= $id_p ?>" data-nm="<?= $b->nama ?>" data-id_s="<?= $b->id_sewa ?>" data-id_m="<?= $b->id_member ?>" class="hapus"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data"></i></a>
                                            <?php } else {
                                            } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DataPenjualan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">DATA PENJUALAN SNACK : <?= format_indo(date('Y-m-d')) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="width: 100%; height: 500px; border: 1px solid red; overflow-y: auto; overflow-x: auto; ">
                    <table class=" table-bordered" style="border-color: red;  color: red; width: 100%;">
                        <thead>
                            <tr style="text-align: center;">
                                <th>NO</th>
                                <th>MEMBER/BAYAR KES</th>
                                <th>SNACK/MINUMAN</th>
                                <th>TOTAL</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody id="end2">
                            <?php $no = 1; ?>
                            <?php foreach ($pj as $d) { ?>
                                <?php
                                $aktif = $this->db->query("SELECT * FROM tb_member WHERE kode='$d->kode_penjualan' AND status='N' ")->num_rows();
                                $mem1 = $this->db->query("SELECT * FROM tb_member WHERE kode='$d->kode_penjualan' ");
                                $mem2 = $mem1->num_rows();
                                $mem3 = $mem1->row();
                                if ($mem2 > 0) {
                                    $me = $mem3->nama;
                                } else {
                                    $me = "Langsung Dibayar";
                                }

                                if ($d->jenis == "S") {
                                    $s = "SNACK";
                                } else if ($d->jenis == "M") {
                                    $s = "MINUMAN";
                                } else if ($d->jenis == "SM") {
                                    $s = "SNACK/MINUMAN";
                                }



                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $me ?></td>
                                    <td><?= $s ?></td>
                                    <td>Rp. <span style="float: right;"><?= number_format($d->jml, 0, ",", "."); ?>,-</span></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <?php
                                            if ($mem2 > 0) {
                                                if ($aktif > 0) {
                                            ?>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#EditPenjualan<?= $d->id_penjualan ?>" data-bs-dismiss="modal" class="edit"><i class="fa fa-edit text-success" data-toggle="tooltip" title="Edit Data"></i></a> |
                                                    <a href="#" data-nm="<?= $s ?>" data-id="<?= $d->id_penjualan ?>" data-bs-dismiss="modal" class="hapus"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data"></i></a>
                                                <?php } else {
                                                    echo "-";
                                                }
                                            } else { ?>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#EditPenjualan<?= $d->id_penjualan ?>" data-bs-dismiss="modal" class="edit"><i class="fa fa-edit text-success" data-toggle="tooltip" title="Edit Data"></i></a> |
                                                <a href="#" data-nm="<?= $s ?>" data-id="<?= $d->id_penjualan ?>" data-bs-dismiss="modal" class="hapus"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data"></i></a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<?php
$tgll = date('Y-m-d');
$penjj = "SELECT * FROM tb_penjualan WHERE tgl='$tgll' ";
$adaa = $this->db->query($penjj)->result();
foreach ($adaa as $g) {
?>
    <div class="modal fade" id="EditPenjualan<?= $g->id_penjualan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Penjualan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="<?= base_url('welcome/edit_penjualan'); ?>" method="POST">
                    <input type="hidden" name="id" id="" value="<?= $g->id_penjualan ?>">
                    <div class="modal-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis" id="snack" value="S" <?php if ($g->jenis == "S") echo 'checked'; ?>>
                            <label class="form-check-label text-primary" for="snack">
                                Snack
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis" id="minuman" value="M" <?php if ($g->jenis == "M") echo 'checked'; ?>>
                            <label class="form-check-label text-primary" for="minuman">
                                Minuman
                            </label>
                        </div>
                        <div class="form-check ml-20">
                            <input class="form-check-input" type="radio" name="jenis" id="mm" value="SM" <?php if ($g->jenis == "SM") echo 'checked'; ?>>
                            <label class="form-check-label text-primary" for="mm">
                                Snack/Minuman
                            </label>
                        </div>
                        <br>
                        <select name="kode_member" class="form-control form-control-lg" id="">
                            <option> - Pilih Member -</option>
                            <option value="BY" <?php if ($g->kode_penjualan == "BY") echo 'selected' ?>> Bayar Kes </option>
                            <?php foreach ($ol as $o) { ?>
                                <option value="<?= $o->kode ?>" <?php if ($o->kode == $g->kode_penjualan) echo 'selected' ?>> <?= $o->nama_chanel ?> - <?= $o->nama ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <input type="text" name="jml" class="form-control form-control-lg text-white" placeholder="Rp.0" required value="<?= $g->jml ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block">EDIT DATA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function() {
        $('#start').on('click', '.start', function() {
            var id = $(this).attr('data-id');
            var nm = $(this).attr('data-nm');
            $('#id_on').val(id);
            $('#exampleModalLabel').html(nm);
        })

        $('#start').on('click', '.Add', function() {
            var id = $(this).attr('data-id');
            var id_pk = $(this).attr('data-pk');
            var nm = $(this).attr('data-nm');
            var nmm = $(this).attr('data-nmm');
            var stop = $(this).attr('data-stp');
            $('#id_sww').val(id);
            $('#exampleModalLabelAdd').html(nm);
            $('#nama_member').html(nmm);
            $('#waktu_lama').val(stop);
            $('#id_pk_lama').val(id_pk);
        })

        $('#start').on('click', '.hapus_start', function() {
            var id_ch = $(this).attr('data-idch');
            var id_mm = $(this).attr('data-idmm');
            var id_sw = $(this).attr('data-idsw');
            var id_pk = $(this).attr('data-pk');
            var nm = $(this).attr('data-nm');

            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Data " + nm + " akan di hapus!!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('welcome/hapus_start'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id_ch: id_ch,
                            id_mm: id_mm,
                            id_sw: id_sw,
                            id_pk: id_pk,
                        },
                        success: function(data) {
                            document.location.href = "<?= base_url('welcome'); ?>";
                            // $('#bayar').modal('show')
                        }
                    });
                }
            })

            return false;
        })

        $('#start').on('click', '.btn_stop', function() {
            var id_ch = $(this).attr('data-idch');
            var id_mm = $(this).attr('data-idmm');
            var id_sw = $(this).attr('data-idsw');
            var id_pk = $(this).attr('data-pk');
            var id_hpk = $(this).attr('data-hpk');
            var nm = $(this).attr('data-nm');

            Swal.fire({
                title: nm,
                text: "Pastikan data yang anda pilih sudah benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Stop!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('welcome/stop'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id_ch: id_ch,
                            id_mm: id_mm,
                            id_sw: id_sw,
                            id_pk: id_pk,
                            id_hpk: id_hpk,
                        },
                        success: function(data) {
                            document.location.href = "<?= base_url('welcome'); ?>";
                            // $('#bayar').modal('show')
                        }
                    });
                }
            })

            return false;
        })

        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('welcome/hitung_sewa') ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data.status == "success") {
                    $("#ats_nm").html(data.nama);
                    $("#id_m").val(data.id_member);
                    $("#id_s").val(data.id_sewa);
                    $("#tl_rp").html(data.tl_rp);
                    $("#tl_rp2").html(data.sub_tl_pj);
                    $("#tl_pj").html(data.tl_pj);
                    $("#total").val(data.total);
                    $("#lama").html(data.lama);
                    $("#sewa").val(data.lama);
                } else {
                    $("#nma").html();
                }
            }
        });

        $('#end').on('click', '.edit', function() {
            var id = $(this).attr('data-id');
            var nm = $(this).attr('data-nm');
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Data " + nm + " akan di Edit!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Edit!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('welcome/edit_end'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            document.location.href = "<?= base_url('welcome'); ?>";
                            // $('#bayar').modal('show')
                        }
                    });
                }
            })
            return false;

        });

        $('#end').on('click', '.hapus', function() {
            var id_m = $(this).attr('data-id_m');
            var id_s = $(this).attr('data-id_s');
            var id_p = $(this).attr('data-id_p');
            var kd = $(this).attr('data-kd');
            var nm = $(this).attr('data-nm');
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Data " + kd + " akan di Hapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('welcome/hapus_end'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id_m: id_m,
                            id_s: id_s,
                            id_p: id_p,
                            kd: kd,
                        },
                        success: function(data) {
                            alert('Data sewa berhasil dihapus');
                            document.location.href = "<?= base_url('welcome'); ?>";
                            // $('#bayar').modal('show')
                        }
                    });
                }
                return false;
            })

        })

        $('#end2').on('click', '.hapus', function() {
            var id = $(this).attr('data-id');
            var nm = $(this).attr('data-nm');
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Data " + nm + " akan di Hapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('welcome/hapus_pjl'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            alert('Data penjualan berhasil dihapus');
                            document.location.href = "<?= base_url('welcome'); ?>";
                            // $('#bayar').modal('show')
                        }
                    });
                }
            })

            return false;
        })
    })
</script>