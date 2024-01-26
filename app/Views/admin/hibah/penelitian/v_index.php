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
                        <th class="text-center" scope="col">Keterangan</th>
                        <th class="text-center" scope="col">Skema Penelitian</th>
                        <th class="text-center" width="500px" scope="col">Judul Penelitian</th>
                        <th class="text-center" scope="col">Ketua Peneliti</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1;
                    foreach ($penelitian as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?php if ($value['keterangan'] == 1) { ?>
                                    Baru
                                <?php } else { ?>
                                    Lanjutan
                                <?php } ?></td>
                            <td><?php if ($value['skema_penelitian'] == 1) { ?>
                                    PDP/Dosen Pemula
                                <?php } elseif ($value['skema_penelitian'] == 2) { ?>
                                    PFR
                                <?php } elseif ($value['skema_penelitian'] == 3) { ?>
                                    PPS-PTM
                                <?php } elseif ($value['skema_penelitian'] == 4) { ?>
                                    PPS-PDD
                                <?php } elseif ($value['skema_penelitian'] == 5) { ?>
                                    PT-JH
                                <?php } elseif ($value['skema_penelitian'] == 6) { ?>
                                    PTUPT
                                <?php } elseif ($value['skema_penelitian'] == 7) { ?>
                                    PT
                                <?php } elseif ($value['skema_penelitian'] == 8) { ?>
                                    PDKN
                                <?php } else { ?>
                                    PTKN
                                <?php } ?></td>
                            <td><?= $value['judul_penelitian'] ?></td>
                            <td><?= $value['ka_peneliti'] ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#info<?= $value['id_hibah_penelitian'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_hibah_penelitian'] ?>"><i class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $value['id_hibah_penelitian'] ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Info -->
    <?php foreach ($penelitian as $key => $value) { ?>
        <div class="modal fade" id="info<?= $value['id_hibah_penelitian'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <th scope="row">Tahun</th>
                                    <td><?= $value['tahun'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td><?php if ($value['keterangan'] == 1) { ?>
                                            Baru
                                        <?php } else { ?>
                                            Lanjutan
                                        <?php } ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Skema Penelitian</th>
                                    <td><?php if ($value['skema_penelitian'] == 1) { ?>
                                            PDP/Dosen Pemula
                                        <?php } elseif ($value['skema_penelitian'] == 2) { ?>
                                            PFR
                                        <?php } elseif ($value['skema_penelitian'] == 3) { ?>
                                            PPS-PTM
                                        <?php } elseif ($value['skema_penelitian'] == 4) { ?>
                                            PPS-PDD
                                        <?php } elseif ($value['skema_penelitian'] == 5) { ?>
                                            PT-JH
                                        <?php } elseif ($value['skema_penelitian'] == 6) { ?>
                                            PTUPT
                                        <?php } elseif ($value['skema_penelitian'] == 7) { ?>
                                            PT
                                        <?php } elseif ($value['skema_penelitian'] == 8) { ?>
                                            PDKN
                                        <?php } else { ?>
                                            PTKN
                                        <?php } ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Judul Penelitian</th>
                                    <td><?= $value['judul_penelitian'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Ketua Peneliti</th>
                                    <td><?= $value['ka_peneliti'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Diedit Pada</th>
                                    <td><?php if ($value['edited_at'] == '') : ?>
                                            Data belum diedit.
                                        <?php else : ?>
                                            <?= date('d-m-Y H:i:s', strtotime($value['edited_at'])) ?>
                                        <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Diedit Oleh</th>
                                    <td><?php if ($value['edited_by'] == 0) : ?>
                                            Data belum diedit.
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
                    echo form_open('admin/hibah/penelitian/add');
                    ?>
                    <div class="form-group">
                        <label for="tahun" hidden><b>Tahun</b></label>
                        <input type="text" name="tahun" class="form-control" id="tahun" hidden>
                    </div>
                    <div class="form-group">
                        <label for="keterangan"><b>Keterangan</b></label>
                        <select name="keterangan" class="form-select" aria-label="Default select example">
                            <option selected>-- Pilih Keterangan --</option>
                            <option value="1">Baru</option>
                            <option value="2">Lanjutan</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="skema_penelitian"><b>Skema Penelitian</b></label>
                        <select name="skema_penelitian" class="form-select" aria-label="Default select example">
                            <option selected>-- Pilih Skema Penelitian --</option>
                            <option value="1">PDP/Dosen Pemula</option>
                            <option value="2">PFR</option>
                            <option value="3">PPS-PTM</option>
                            <option value="4">PPS-PDD</option>
                            <option value="5">PT-JH</option>
                            <option value="6">PTUPT</option>
                            <option value="7">PT</option>
                            <option value="8">PDKN</option>
                            <option value="9">PTKN</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="judul_penelitian"><b>Judul Penelitian</b></label>
                        <input type="text" name="judul_penelitian" class="form-control" id="judul_penelitian">
                    </div>
                    <div class="form-group mt-2">
                        <label for="ka_peneliti"><b>Ketua Peneliti</b></label>
                        <input type="text" name="ka_peneliti" class="form-control" id="ka_peneliti">
                    </div>
                    <div class="form-group">
                        <label for="created_by" hidden><b>Dibuat Oleh</b></label>
                        <input type="text" name="created_by" class="form-control" id="created_by" placeholder="<?= session('nm_user') ?>" value="<?= session('id_user') ?>" hidden>
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
    <?php foreach ($penelitian as $key => $value) { ?>
        <div class="modal fade" id="edit<?= $value['id_hibah_penelitian'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalInfoLabel"><b>Ubah Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo form_open_multipart('admin/hibah/penelitian/edit/' . $value['id_hibah_penelitian']);
                        ?>
                        <div class="form-group mt-2">
                            <label for="keterangan"><b>Keterangan</b></label>
                            <select name="keterangan" class="form-control">
                                <option <?php if ($value['keterangan'] == '') {
                                            echo 'selected';
                                        } ?> value="">----- Pilih Keterangan -----</option>
                                <option <?php if ($value['keterangan'] == 1) {
                                            echo 'selected';
                                        } ?> value="1">Baru</option>
                                <option <?php if ($value['keterangan'] == 2) {
                                            echo 'selected';
                                        } ?> value="2">Lanjutan</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="skema_penelitian"><b>Skema Penelitian</b></label>
                            <select name="skema_penelitian" class="form-control">
                                <option <?php if ($value['skema_penelitian'] == '') {
                                            echo 'selected';
                                        } ?> value="">----- Pilih Skema Penelitian -----</option>
                                <option <?php if ($value['skema_penelitian'] == 1) {
                                            echo 'selected';
                                        } ?> value="1">PDP/Dosen Pemula</option>
                                <option <?php if ($value['skema_penelitian'] == 2) {
                                            echo 'selected';
                                        } ?> value="2">PFR</option>
                                <option <?php if ($value['skema_penelitian'] == 3) {
                                            echo 'selected';
                                        } ?> value="3">PPS-PTM</option>
                                <option <?php if ($value['skema_penelitian'] == 4) {
                                            echo 'selected';
                                        } ?> value="4">PPS-PDD</option>
                                <option <?php if ($value['skema_penelitian'] == 5) {
                                            echo 'selected';
                                        } ?> value="5">PT-JH</option>
                                <option <?php if ($value['skema_penelitian'] == 6) {
                                            echo 'selected';
                                        } ?> value="6">PTUPT</option>
                                <option <?php if ($value['skema_penelitian'] == 7) {
                                            echo 'selected';
                                        } ?> value="7">PT</option>
                                <option <?php if ($value['skema_penelitian'] == 8) {
                                            echo 'selected';
                                        } ?> value="8">PDKN</option>
                                <option <?php if ($value['skema_penelitian'] == 9) {
                                            echo 'selected';
                                        } ?> value="9">PTKN</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="judul_penelitian"><b>Judul Penelitian</b></label>
                            <input type="text" name="judul_penelitian" class="form-control" id="judul_penelitian" value="<?= $value['judul_penelitian'] ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="ka_peneliti"><b>Ketua Peneliti</b></label>
                            <input type="text" name="ka_peneliti" class="form-control" id="ka_peneliti" value="<?= $value['ka_peneliti'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="created_at" hidden><b>Dibuat Oleh</b></label>
                            <input type="text" name="created_by" class="form-control" id="created_by" placeholder="<?= $value['created_by'] ?>" value="<?= $value['created_by'] ?>" hidden>
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
    <?php foreach ($penelitian as $key => $value) { ?>
        <div class="modal fade" id="delete<?= $value['id_hibah_penelitian'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalDeleteLabel"><b>Hapus Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data <b>hibah penelitian dengan judul <?= $value['judul_penelitian'] ?> dan ketua peneliti <?= $value['ka_peneliti'] ?></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <a href="<?= base_url('admin/hibah/penelitian/delete/' . $value['id_hibah_penelitian']) ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>