<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav col-12 col-lg-auto me-lg-auto mb-2 mb-md-0">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url('admin/dashboard') ?>">Beranda</a>
        </li>
        <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profil
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('admin/profil/tentang-kami') ?>">Tentang Kami</a></li>
                <li><a class="dropdown-item" href="<?= base_url('admin/profil/visi') ?>">Visi</a></li>
                <li><a class="dropdown-item" href="<?= base_url('admin/profil/misi') ?>">Misi</a></li>
            </ul>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url('admin/agenda') ?>">Agenda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url('admin/berita') ?>">Berita</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Daftar Penerima Hibah
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('admin/hibah/dana') ?>">Dana</a></li>
                <li><a class="dropdown-item" href="<?= base_url('admin/hibah/penelitian') ?>">Penelitian</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Master Data
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('admin/master/pengguna') ?>">Pengguna</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url('admin/unduh') ?>">Unduh</a>
        </li>
    </ul>

    <ul class="navbar-nav col-12 col-lg-auto ms-lg-auto mb-2 mb-md-0">
        <div class="flex-shrink-0 dropdown">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= base_url() ?>/public/assets/icons/user.png" class="rounded-circle" alt="User Profile" width="32px" height="32px">
                <p class="mb-0 ms-2"><?= session('nm_user') ?></p>
            </a>

            <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Keluar</a></li>
            </ul>
        </div>
    </ul>
</div>
</div>
</nav>
</header>

<main>