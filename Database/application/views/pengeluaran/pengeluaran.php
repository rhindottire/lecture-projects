<?php
error_reporting(0);
?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Data Pengeluaran Bulan <?= format_indo2(date('Y-m-d')) ?></h6>
                <h1 class="float-end" style="margin-top: -20px;">Total : Rp. <?= number_format($ttl['ttl']) ?></h1>
                <?= $this->session->flashdata('edit'); ?>
                <table id="example" class="table table-bordered" style="border-color: red; color: white; ">
                    <thead style="text-align: center;">
                        <tr>
                            <th width="5%">NO</th>
                            <th>KETERANGAN ITEM</th>
                            <th>TANGGAL</th>
                            <th>JUMLAH (Rp)</th>
                            <th width="10%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody id="dat">
                        <?php $no = 1; ?>
                        <?php foreach ($pg as $d) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $d->item ?></td>
                                <td class="text-center"><?= date('d/m/Y', strtotime($d->tgl)) ?></td>
                                <td class="text-end"><?= number_format($d->total) ?>,-</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#id<?= $d->id_pengeluaran ?>" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i></a>
                                    <a id="hapus" data-id="<?= $d->id_pengeluaran ?>" data-nm="<?= $d->item ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Form input data pengeluaran</h6>

                <?= $this->session->flashdata('test'); ?>
                <form method="POST" action="<?= base_url('pengeluaran'); ?>">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Keterangan Item</label>
                        <input type="text" name="item" class="form-control text-white" placeholder="Item" autofocus required>
                        <small class="text-danger"><?= form_error('item'); ?></small>
                        <div id="emailHelp" class="form-text">Ketik keterangan barang / item pengeluaran
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jumlah (Rp)</label>
                        <input type="text" name="jml" id="tanpa-rupiah" class="form-control text-white" placeholder="Rp. 0" required>
                        <small class="text-danger"><?= form_error('jml'); ?></small>
                        <div id="emailHelp" class="form-text">Ketik harga total pengeluaran
                        </div>
                    </div>
                    <input type="hidden" name="jml2" id="hsl-jml">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success float-end"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>

        <script>
            $('#tanpa-rupiah').on('keyup', function() {
                var hrg = $(this).val();
                var ttk = ".";
                hrg = hrg.replaceAll(ttk, "");
                $("#hsl-jml").val(hrg);
            })
        </script>

    </div>
</div>

<?php foreach ($pg as $d) { ?>
    <div class="modal fade" id="id<?= $d->id_pengeluaran ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('pengeluaran/edit_pengeluaran'); ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $d->id_pengeluaran ?>">
                    <div class="modal-body">
                        <input type="text" name="item" class="form-control text-white" placeholder="Item" value="<?= $d->item ?>" autofocus required>
                        <br>
                        <input type="text" name="jml" class="form-control text-white" placeholder="Rp. 0" value="<?= $d->total ?>" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary float-start" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary">Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<script>
    $(document).ready(function() {
        $('#dat').on('click', '#hapus', function() {
            var id = $(this).attr('data-id');
            var nm = $(this).attr('data-nm');
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Data " + nm + " akan di hapus!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('pengeluaran/hapus_pengeluaran'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            document.location.href = "<?= base_url('pengeluaran'); ?>";
                            // $('#bayar').modal('show')
                        }
                    });
                }
            })

            return false;
        })
    })
</script>