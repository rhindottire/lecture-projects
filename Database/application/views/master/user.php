<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Data User</h6>
                <?= $this->session->flashdata('msg'); ?>
                <table id="example" class="table table-bordered" style="border-color: red; color: white; ">
                    <thead style="text-align: center;">
                        <tr>
                            <th width="5%">NO</th>
                            <th>NAMA LENGKAP</th>
                            <th>USERNAME </th>
                            <th>LEVEL </th>
                            <th width="15%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody id="dat">
                        <?php $no = 1; ?>
                        <?php foreach ($ur as $d) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d->nama_lengkap ?></td>
                                <td><?= $d->username ?></td>
                                <td>
                                    <?php
                                    if ($d->level == 1) {
                                        echo 'Master Admin';
                                    } else {
                                        echo 'Admin';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a data-bs-toggle="modal" data-bs-target="#id<?= $d->id_user ?>" class="btn btn-sm btn-success"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i></a>
                                    <a id="hapus" data-id="<?= $d->id_user ?>" data-nm="<?= $d->nama_lengkap ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12 col-xl-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Input Data User</h6>
                <form action="<?= base_url('master/user'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control text-white" autofocus placeholder="Nama Lengkap">
                        <small class="text-danger"><?= form_error('nama_lengkap'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control text-white" placeholder="Username">
                        <small class="text-danger"><?= form_error('username'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Level</label>
                        <select name="level" id="" class="form-control">
                            <option>-- Pilih Level --</option>
                            <option value="1">Master Admin</option>
                            <option value="2">Admin</option>
                        </select>
                        <small class="text-danger"><?= form_error('level'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input type="password" name="password1" class="form-control text-white" placeholder="Password">
                        <small class="text-danger"><?= form_error('password1'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password2" class="form-control text-white" placeholder="Konfirmasi Password">
                        <small class="text-danger"><?= form_error('password2'); ?></small>
                    </div>

                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($ur as $d) { ?>
    <div class="modal fade" id="id<?= $d->id_user ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit data user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('master/edit_user'); ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $d->id_user ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control text-white" value="<?= $d->nama_lengkap ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control text-white" value="<?= $d->username ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Level</label>
                            <select name="level" id="" class="form-control">
                                <option>-- Pilih Level --</option>
                                <option value="1" <?php if ($d->level == 1) echo 'selected'; ?>>Master Admin</option>
                                <option value="2" <?php if ($d->level == 2) echo 'selected'; ?>>Admin</option>
                            </select>
                        </div>
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
                        url: "<?= base_url('master/hapus_user'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            alert('Data berhasil dihapus');
                            document.location.href = "<?= base_url('master/user'); ?>";
                            // $('#bayar').modal('show')
                        }
                    });
                }
            })

            return false;
        })
    })
</script>