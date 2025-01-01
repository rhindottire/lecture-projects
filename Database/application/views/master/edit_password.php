<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-4">
        </div>
        <div class="col-sm-12 col-xl-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Edit Password</h6>
                <?= $this->session->flashdata('pass'); ?>
                <form action="<?= base_url('master/edit_password'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control text-red" placeholder="Username" value="<?= $log->username ?>" readonly>
                        <small class="text-danger"><?= form_error('username'); ?></small>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password Lama</label>
                        <input type="password" name="pass_lama" class="form-control text-white" placeholder="Password Lama">
                        <small class="text-danger"><?= form_error('pass_lama'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password Baru</label>
                        <input type="password" name="password1" class="form-control text-white" placeholder="Password Baru">
                        <small class="text-danger"><?= form_error('password1'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password2" class="form-control text-white" placeholder="Konfirmasi Password Baru">
                        <small class="text-danger"><?= form_error('password2'); ?></small>
                    </div>

                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>