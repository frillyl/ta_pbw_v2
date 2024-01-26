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
                        <th class="text-center" width="800px" scope="col">Judul Berita</th>
                        <th class="text-center" scope="col">Kategori Berita</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1;
                    foreach ($berita as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('j F Y', strtotime($value['created_at'])) ?></td>
                            <td><?= $value['judul_berita'] ?></td>
                            <td><?php if ($value['kategori'] == '1') : ?>
                                    Berita Penelitian
                                <?php else : ?>
                                    Berita Kegiatan
                                <?php endif; ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#info<?= $value['id_berita'] ?>"><i class="fa-solid fa-circle-info"></i></button>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_berita'] ?>"><i class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $value['id_berita'] ?>"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Info -->
    <?php foreach ($berita as $key => $value) { ?>
        <div class="modal fade" id="info<?= $value['id_berita'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <th scope="row">Dipublikasi Pada</th>
                                    <td><?= date('j F Y H:i:s', strtotime($value['created_at'])) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Dipublikasi Oleh</th>
                                    <td><?= $value['nm_user'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Judul Berita</th>
                                    <td><?= $value['judul_berita'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Sub-judul Berita</th>
                                    <td width="600px"><?php if ($value['sub_judul'] == '') : ?>
                                            Tidak Ada Sub-judul.
                                        <?php else : ?>
                                            <?= $value['sub_judul'] ?>
                                        <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Kategori</th>
                                    <td><?php if ($value['kategori'] == '1') : ?>
                                            Berita Penelitian
                                        <?php else : ?>
                                            Berita Kegiatan
                                        <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Isi Berita</th>
                                    <td><?= $value['isi_berita'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Foto Utama</th>
                                    <td><img src="<?= base_url('public/assets/media/' . $value['main_image']) ?>" class="img-fluid">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Foto 1</th>
                                    <td><img src="<?= base_url('public/assets/media/' . $value['image1']) ?>" class="img-fluid"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Foto 2</th>
                                    <td><img src="<?= base_url('public/assets/media/' . $value['image2']) ?>" class="img-fluid"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Foto 3</th>
                                    <td><img src="<?= base_url('public/assets/media/' . $value['image3']) ?>" class="img-fluid"></td>
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
                    echo form_open_multipart('admin/berita/add');
                    ?>
                    <div class="form-group">
                        <label for="id_user" hidden><b>Dipublikasi Oleh</b></label>
                        <input type="text" name="id_user" class="form-control" id="id_user" placeholder="<?= session('nm_user') ?>" value="<?= session('id_user') ?>" hidden>
                    </div>
                    <div class="form-group mt-2">
                        <label for="judul_berita"><b>Judul Berita</b></label>
                        <input type="text" name="judul_berita" class="form-control" id="judul_berita">
                    </div>
                    <div class="form-group mt-2">
                        <label for="sub_judul"><b>Sub-judul Berita</b></label>
                        <input type="text" name="sub_judul" class="form-control" id="sub_judul">
                    </div>
                    <div class="form-group mt-2">
                        <label for="kategori"><b>Kategori</b></label>
                        <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                            <option selected>-- Pilih Kategori Berita --</option>
                            <option value="1">Berita Penelitian</option>
                            <option value="2">Berita Kegiatan</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="isi_berita"><b>Isi Berita</b></label>
                        <textarea name="isi_berita" class="form-control" id="isi_berita" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="main_image"><b>Foto Utama</b></label>
                        <input type="file" name="main_image" id="main_image" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="main_image_preview"><b>Preview Foto Utama</b></label>
                        <br>
                        <img src="<?= base_url('public/assets/media/' . $value['main_image']) ?>" id="gambar_load" class="img-fluid">
                    </div>
                    <div class="form-group mt-2">
                        <label for="foto1"><b>Foto 1</b></label>
                        <input type="file" name="foto1" id="foto1" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="foto1_preview"><b>Preview Foto 1</b></label>
                        <br>
                        <img src="<?= base_url('public/assets/media/' . $value['main_image']) ?>" id="gambar_load1" class="img-fluid">
                    </div>
                    <div class="form-group mt-2">
                        <label for="foto2"><b>Foto 2</b></label>
                        <input type="file" name="foto2" id="foto2" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="foto2_preview"><b>Preview Foto 2</b></label>
                        <br>
                        <img src="<?= base_url('public/assets/media/' . $value['main_image']) ?>" id="gambar_load2" class="img-fluid">
                    </div>
                    <div class="form-group mt-2">
                        <label for="foto3"><b>Foto 3</b></label>
                        <input type="file" name="foto3" id="foto3" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="foto3_preview"><b>Preview Foto 3</b></label>
                        <br>
                        <img src="<?= base_url('public/assets/media/' . $value['main_image']) ?>" id="gambar_load3" class="img-fluid">
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
    <?php foreach ($berita as $key => $value) { ?>
        <div class="modal fade" id="edit<?= $value['id_berita'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalInfoLabel"><b>Ubah Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo form_open_multipart('admin/berita/edit/' . $value['id_berita']);
                        ?>
                        <div class="form-group">
                            <label for="id_user" hidden><b>Dipublikasi Oleh</b></label>
                            <input type="text" name="id_user" class="form-control" id="id_user" placeholder="<?= $value['nm_user'] ?>" value="<?= $value['id_user'] ?>" hidden>
                        </div>
                        <div class="form-group mt-2">
                            <label for="judul_berita"><b>Judul Berita</b></label>
                            <input type="text" name="judul_berita" class="form-control" id="judul_berita" placeholder="<?= $value['judul_berita'] ?>" value="<?= $value['judul_berita'] ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="sub_judul"><b>Sub-judul Berita</b></label>
                            <input type="text" name="sub_judul" class="form-control" id="sub_judul" placeholder="<?= $value['sub_judul'] ?>" value="<?= $value['sub_judul'] ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="kategori"><b>Kategori</b></label>
                            <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                                <option value="">-- Pilih Kategori Berita --</option>
                                <?php foreach ($berita as $key => $value) { ?>
                                    <option selected value="<?= $value['kategori'] ?>"><?php if ($value['edited_by'] == 0) : ?>
                                            Berita Penelitian
                                        <?php else : ?>
                                            Berita Kegiatan
                                        <?php endif; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="isi_berita"><b>Isi Berita</b></label>
                            <textarea name="isi_berita" class="form-control" id="isi_berita" cols="30" rows="10"><?= $value['isi_berita'] ?></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="main_image"><b>Foto Utama</b></label>
                            <input type="file" name="main_image" id="main_image" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="main_image_preview"><b>Preview Foto Utama</b></label>
                            <br>
                            <img src="<?= base_url('public/assets/media/' . $value['main_image']) ?>" id="gambar_load" class="img-fluid">
                        </div>
                        <div class="form-group mt-2">
                            <label for="foto1"><b>Foto 1</b></label>
                            <input type="file" name="foto1" id="foto1" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="foto1_preview"><b>Preview Foto 1</b></label>
                            <br>
                            <img src="<?= base_url('public/assets/media/' . $value['image1']) ?>" id="gambar_load1" class="img-fluid">
                        </div>
                        <div class="form-group mt-2">
                            <label for="foto2"><b>Foto 2</b></label>
                            <input type="file" name="foto2" id="foto2" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="foto2_preview"><b>Preview Foto 2</b></label>
                            <br>
                            <img src="<?= base_url('public/assets/media/' . $value['image2']) ?>" id="gambar_load2" class="img-fluid">
                        </div>
                        <div class="form-group mt-2">
                            <label for="foto3"><b>Foto 3</b></label>
                            <input type="file" name="foto3" id="foto3" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="foto3_preview"><b>Preview Foto 3</b></label>
                            <br>
                            <img src="<?= base_url('public/assets/media/' . $value['image3']) ?>" id="gambar_load3" class="img-fluid">
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
    <?php foreach ($berita as $key => $value) { ?>
        <div class="modal fade" id="delete<?= $value['id_berita'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="modalDeleteLabel"><b>Hapus Data</b></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus berita <b><?= $value['judul_berita'] ?></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                        <a href="<?= base_url('admin/berita/delete/' . $value['id_berita']) ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>