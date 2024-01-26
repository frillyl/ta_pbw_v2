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
                        <th class="text-center" scope="col">Nama Pengguna</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1;
                    foreach ($pengguna as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nm_user'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#info<?= $value['id_user'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_user'] ?>"><i class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $value['id_user'] ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

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
                    echo form_open_multipart('admin/master/pengguna/add');
                    ?>
                    <div class="form-group mt-2">
                        <label for="nm_user"><b>Nama Pengguna</b></label>
                        <input type="text" name="nm_user" class="form-control" id="nm_user" placeholder="Nama Pengguna">
                    </div>
                    <div class="form-group mt-2">
                        <label for="email"><b>Email</b></label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
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
    <?php foreach ($pengguna as $key => $value) { ?>
        <div class="modal fade" id="edit<?= $value['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalInfoLabel"><b>Ubah Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo form_open_multipart('admin/master/pengguna/edit/' . $value['id_user']);
                        ?>
                        <div class="form-group mt-2">
                            <label for="nm_user"><b>Nama Pengguna</b></label>
                            <input type="text" name="nm_user" class="form-control" id="nm_user" placeholder="Nama Pengguna" value="<?= $value['nm_user'] ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="email"><b>Email</b></label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?= $value['email'] ?>">
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
    <?php foreach ($pengguna as $key => $value) { ?>
        <div class="modal fade" id="delete<?= $value['id_user'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalDeleteLabel"><b>Hapus Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data user <b><?= $value['nm_user'] ?></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <a href="<?= base_url('admin/master/pengguna/delete/' . $value['id_user']) ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>