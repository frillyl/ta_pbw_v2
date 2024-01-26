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
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#reset"><i class="fa-solid fa-arrows-rotate"></i> Reset Data</button>
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
                        <th class="text-center" scope="col">Periode</th>
                        <th class="text-center" width="300px" scope="col">Judul Agenda</th>
                        <th class="text-center" width="500px" scope="col">Keterangan</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1;
                    foreach ($agenda as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('j F Y', strtotime($value['tgl_agenda'])) ?></td>
                            <td><?= $value['judul_agenda'] ?></td>
                            <td><?= $value['ket'] ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#info<?= $value['id_agenda'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_agenda'] ?>"><i class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $value['id_agenda'] ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Info -->
    <?php foreach ($agenda as $key => $value) { ?>
        <div class="modal fade" id="info<?= $value['id_agenda'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <th scope="row">Tanggal Agenda</th>
                                    <td><?= date('j F Y', strtotime($value['tgl_agenda'])) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Judul Agenda</th>
                                    <td width="600px"><?= $value['judul_agenda'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td><?= $value['ket'] ?></td>
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
                    echo form_open_multipart('admin/agenda/add');
                    ?>
                    <div class="form-group">
                        <label for="id_user" hidden><b>Dibuat Oleh</b></label>
                        <input type="text" name="id_user" class="form-control" id="id_user" placeholder="<?= session('nm_user') ?>" value="<?= session('id_user') ?>" hidden>
                    </div>
                    <label for="tglAgendaAdd"><b>Tanggal Agenda</b></label>
                    <div class="input-group date" id="tglAgendaAdd" data-target-input="nearest">
                        <input type="text" name="tgl_agenda" class="form-control datetimepicker-input" data-target="#tglAgendaAdd" />
                        <span class="input-group-text" id="tglAgendaAdd">
                            <div class="input-group-text input-group-append" data-target="#tglAgendaAdd" data-toggle="datetimepicker">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="judul_agenda"><b>Judul Agenda</b></label>
                        <input type="text" name="judul_agenda" class="form-control" id="judul_agenda">
                    </div>
                    <div class="form-group mt-2">
                        <label for="ket"><b>Keterangan</b></label>
                        <textarea name="ket" class="form-control" id="ket" cols="15" rows="5"></textarea>
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
    <?php foreach ($agenda as $key => $value) { ?>
        <div class="modal fade" id="edit<?= $value['id_agenda'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalInfoLabel"><b>Ubah Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo form_open_multipart('admin/agenda/edit/' . $value['id_agenda']);
                        ?>
                        <div class="form-group">
                            <label for="id_user" hidden><b>Dibuat Oleh</b></label>
                            <input type="text" name="id_user" class="form-control" id="id_user" placeholder="<?= session('nm_user') ?>" value="<?= session('id_user') ?>" hidden>
                        </div>
                        <label for="tglAgendaEdit"><b>Tanggal Agenda</b></label>
                        <div class="input-group date" id="tglAgendaEdit<?= $value['id_agenda'] ?>" data-target-input="nearest">
                            <input type="text" name="tgl_agenda" class="form-control datetimepicker-input" data-target="#tglAgendaEdit<?= $value['id_agenda'] ?>" placeholder="<?= $value['tgl_agenda'] ?>" value="<?= $value['tgl_agenda'] ?>" />
                            <span class="input-group-text" id="tglAgendaEdit<?= $value['id_agenda'] ?>">
                                <div class="input-group-text input-group-append" data-target="#tglAgendaEdit<?= $value['id_agenda'] ?>" data-toggle="datetimepicker">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </span>
                        </div>
                        <div class="form-group mt-2">
                            <label for="judul_agenda"><b>Judul Agenda</b></label>
                            <input type="text" name="judul_agenda" class="form-control" id="judul_agenda" value="<?= $value['judul_agenda'] ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="ket"><b>Keterangan</b></label>
                            <textarea name="ket" class="form-control" id="ket" cols="15" rows="5"><?= $value['ket'] ?></textarea>
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
    <?php foreach ($agenda as $key => $value) { ?>
        <div class="modal fade" id="delete<?= $value['id_agenda'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalDeleteLabel"><b>Hapus Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data yang dibuat oleh <b><?= $value['nm_user'] ?></b> pada <b><?= date('d-m-Y H:i:s', strtotime($value['created_at'])) ?></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <a href="<?= base_url('admin/agenda/delete/' . $value['id_agenda']) ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Modal Reset -->
    <div class="modal fade" id="reset">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="modalDeleteLabel"><b>Reset Data</b></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin <b>mereset seluruh data</b> yang ada di <b>table agenda</b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('admin/agenda/reset') ?>" class="btn btn-danger">Reset</a>
                </div>
            </div>
        </div>
    </div>
</div>