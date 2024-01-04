<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <center>
                <b>
                    <h1><?= $sub ?></h1>
                </b>
            </center>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#add" style="background-color: #8F3797; color: #fff"><i class="fa fa-plus"></i> Tambah Data</button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12">
            <?php
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($errors as $key => $value) { ?>
                            <li><?= esc($value) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success" role="alert">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
            ?>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Dibuat Pada</th>
                        <th class="text-center" scope="col">Dibuat Oleh</th>
                        <th class="text-center" width="500px" scope="col">Isi</th>
                        <th class="text-center" scope="col">Diedit Pada</th>
                        <th class="text-center" scope="col">Diedit Oleh</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1;
                    foreach ($tentang_kami as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($value['created_at'])) ?></td>
                            <td><?= $value['nm_user'] ?></td>
                            <td><?= $value['isi'] ?></td>
                            <td>
                                <?php if ($value['edited_at'] == '') : ?>
                                    Data belum diedit.
                                <?php else : ?>
                                    <?= date('d-m-Y H:i:s', strtotime($value['edited_at'])) ?>
                                <?php endif; ?>
                            </td>
                            <td><?= $value['nm_user'] ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#info<?= $value['id_tentang_kami'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_tentang_kami'] ?>"><i class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $value['id_tentang_kami'] ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Info -->
    <?php foreach ($tentang_kami as $key => $value) { ?>
        <div class="modal fade" id="info<?= $value['id_tentang_kami'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalInfoLabel"><b>Detail Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Dibuat Pada</th>
                                    <td><?= date('d-m-Y H:i:s', strtotime($value['created_at'])) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Dibuat Oleh</th>
                                    <td><?= $value['nm_user'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Isi</th>
                                    <td width="600px"><?= $value['isi'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Diedit Pada</th>
                                    <td><?php if ($value['edited_at'] == '0000-00-00 00:00:00') : ?>
                                            Data belum diedit.
                                        <?php else : ?>
                                            <?= date('d-m-Y H:i:s', strtotime($value['edited_at'])) ?>
                                        <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Diedit Oleh</th>
                                    <td><?= $value['nm_user'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Modal Add -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="modalInfoLabel"><b>Tambah Data</b></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    echo form_open_multipart('admin/profil/tentang-kami/add');
                    ?>
                    <div class="form-group">
                        <label for="id_user"><b>Dibuat Oleh</b></label>
                        <input type="text" name="id_user" class="form-control" id="id_user" placeholder="<?= session('nm_user') ?>" value="<?= session('id_user') ?>" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="isi"><b>Isi</b></label>
                        <textarea name="isi" class="form-control" id="isi" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="edited_by"><b>Diedit Oleh</b></label>
                        <input type="text" name="edited_by" class="form-control" id="edited_by" placeholder="<?= session('nm_user') ?>" value="<?= session('id_user') ?>" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah Data</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <?php foreach ($tentang_kami as $key => $value) { ?>
        <div class="modal fade" id="edit<?= $value['id_tentang_kami'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalInfoLabel"><b>Ubah Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo form_open_multipart('admin/profil/tentang-kami/edit/' . $value['id_tentang_kami']);
                        ?>
                        <div class="form-group">
                            <label for="id_user"><b>Dibuat Oleh</b></label>
                            <input type="text" name="id_user" class="form-control" id="id_user" placeholder="<?= session('nm_user') ?>" value="<?= $value['id_user'] ?>" readonly>
                        </div>
                        <div class="form-group mt-2">
                            <label for="isi"><b>Isi</b></label>
                            <textarea name="isi" class="form-control" id="isi" cols="30" rows="10"><?= $value['isi'] ?></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="edited_by"><b>Diedit Oleh</b></label>
                            <input type="text" name="edited_by" class="form-control" id="edited_by" placeholder="<?= session('nm_user') ?>" value="<?= session('id_user') ?>" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Ubah Data</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Modal Delete -->
    <?php foreach ($tentang_kami as $key => $value) { ?>
        <div class="modal fade" id="delete<?= $value['id_tentang_kami'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalInfoLabel"><b>Hapus Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data yang dibuat oleh <b><?= $value['nm_user'] ?></b> pada <b><?= $value['created_at'] ?></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <a href="<?= base_url('admin/profil/tentang-kami/delete/' . $value['id_tentang_kami']) ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>