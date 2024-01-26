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
                        <th class="text-center" scope="col">Tanggal Publikasi</th>
                        <th class="text-center" width="500px" scope="col">Keterangan</th>
                        <th class="text-center" scope="col">Nama File</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1;
                    foreach ($unduh as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('j F Y', strtotime($value['created_at'])) ?></td>
                            <td><?= $value['keterangan'] ?></td>
                            <td><a href="<?= base_url('public/assets/docs/' . $value['file']) ?>" target="_blank"><?= $value['file'] ?></a></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#info<?= $value['id_unduh'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_unduh'] ?>"><i class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $value['id_unduh'] ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Info -->
    <?php foreach ($unduh as $key => $value) { ?>
        <div class="modal fade" id="info<?= $value['id_unduh'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <th scope="row">Tanggal Publikasi</th>
                                    <td><?= date('j F Y H:i:s', strtotime($value['created_at'])) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Dipublikasi Oleh</th>
                                    <td><?= $value['nm_user'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td><?= $value['keterangan'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama File</th>
                                    <td width="600px"><?= $value['file'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Diedit Pada</th>
                                    <td><?php if ($value['edited_at'] == '') : ?>
                                            Berita belum diedit.
                                        <?php else : ?>
                                            <?= date('j F Y H:i:s', strtotime($value['edited_at'])) ?>
                                        <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Diedit Oleh</th>
                                    <td><?php if ($value['edited_by'] == 0) : ?>
                                            Berita belum diedit.
                                        <?php else : ?>
                                            <?= $value['nm_user'] ?>
                                        <?php endif; ?></td>
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
                    echo form_open_multipart('admin/unduh/add');
                    ?>
                    <div class="form-group">
                        <label for="id_user" hidden><b>Dipublikasi Oleh</b></label>
                        <input type="text" name="id_user" class="form-control" id="id_user" placeholder="<?= session('nm_user') ?>" value="<?= session('id_user') ?>" hidden>
                    </div>
                    <div class="form-group mt-2">
                        <label for="keterangan"><b>Keterangan</b></label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan">
                    </div>
                    <div class="form-group mt-2">
                        <label for="file"><b>File</b></label>
                        <input class="form-control" name="file" type="file" id="file">
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
    <?php foreach ($unduh as $key => $value) { ?>
        <div class="modal fade" id="edit<?= $value['id_unduh'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalInfoLabel"><b>Ubah Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo form_open_multipart('admin/unduh/edit/' . $value['id_unduh']);
                        ?>
                        <div class="form-group">
                            <label for="id_user" hidden><b>Dipublikasi Oleh</b></label>
                            <input type="text" name="id_user" class="form-control" id="id_user" placeholder="<?= $value['nm_user'] ?>" value="<?= $value['id_user'] ?>" hidden>
                        </div>
                        <div class="form-group mt-2">
                            <label for="keterangan"><b>Keterangan</b></label>
                            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="<?= $value['keterangan'] ?>" value="<?= $value['keterangan'] ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="file"><b>File</b></label>
                            <input class="form-control" name="file" type="file" id="file" value="<?php $value['file'] ?>" data-placeholder=" <?php $value['file']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="edited_by" hidden><b>Diedit Oleh</b></label>
                            <input type="text" name="edited_by" class="form-control" id="edited_by" placeholder="<?= session('nm_user') ?>" value="<?= session('id_user') ?>" hidden>
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

</div>