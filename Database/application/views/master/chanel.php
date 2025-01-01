<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Data Chanel</h6>
                <?= $this->session->flashdata('edit'); ?>
                <table id="example" class="table table-bordered" style="border-color: red; color: white; ">
                    <thead style="text-align: center;">
                        <tr>
                            <th width="5%">NO</th>
                            <th>NAMA CHANEL</th>
                            <th width="15%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody id="dat">
                        <?php $no = 1; ?>
                        <?php foreach ($ch as $d) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $d->nama_chanel ?></td>
                                <td class="text-center">
                                    <a data-bs-toggle="modal" data-bs-target="#id<?= $d->id_chanel ?>" class="btn btn-sm btn-success"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i></a>
                                    <a id="hapus" data-id="<?= $d->id_chanel ?>" data-nm="<?= $d->nama_chanel ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="bg-secondary rounded h-10 p-4" style="border: 1px solid red;">
                <h6 class="mb-4">Input Data Chanel</h6>
                <?= $this->session->flashdata('test'); ?>
                <form method="POST" action="<?= base_url('master/chanel'); ?>">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Chanel</label>
                        <input type="text" name="nama" class="form-control text-white" autofocus>
                        <small class="text-danger"><?= form_error('nama'); ?></small>
                        <div id="emailHelp" class="form-text">Ketik untuk membuat chanel baru
                        </div>
                    </div>


                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- Sale & Revenue End -->

<?php foreach ($ch as $d) { ?>
    <div class="modal fade" id="id<?= $d->id_chanel ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Chanel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('master/edit_chanel'); ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $d->id_chanel ?>">
                    <div class="modal-body">
                        <input type="text" name="nama" class="form-control text-white" value="<?= $d->nama_chanel ?>" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
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
                        url: "<?= base_url('master/hapus_chanel'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            document.location.href = "<?= base_url('master/chanel'); ?>";
                            // $('#bayar').modal('show')
                        }
                    });
                }
            })

            return false;
        })
    })
</script>