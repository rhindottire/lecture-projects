<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Data Harga Sewas</h6>
                <?= $this->session->flashdata('edit'); ?>
                <table id="example" class="table table-bordered" style="border-color: red; color: white; ">
                    <thead style="text-align: center;">
                        <tr>
                            <th width="5%">NO</th>
                            <th>JML MENIT</th>
                            <th>HARGA </th>
                            <th width="15%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($hrg as $d) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d->menit ?> Menit</td>
                                <td class="text-end"><?= number_format($d->harga) ?></td>
                                <td class="text-center">
                                    <a data-bs-toggle="modal" data-bs-target="#id<?= $d->id_harga ?>" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i> Edit Harga</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php foreach ($hrg as $d) { ?>
    <div class="modal fade" id="id<?= $d->id_harga ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Harga Sewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('master/edit_harga'); ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $d->id_harga ?>">
                    <div class="modal-body">
                        <label for="exampleInputEmail1" class="form-label">Jumlah Menit</label>
                        <input type="text" name="menit" class="form-control text-white" value="<?= $d->menit ?>" required>
                        <br>
                        <label for="exampleInputEmail1" class="form-label">Harga</label>
                        <input type="text" name="harga" class="form-control text-white" value="<?= $d->harga ?>" required>
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