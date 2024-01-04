<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// FRONT ROUTES
$routes->get('/', 'Home::index');
$routes->get('/profil', 'Home::profil');
$routes->get('/berita/penelitian', 'Home::berita_penelitian');
$routes->get('/berita/kegiatan', 'Home::berita_kegiatan');
$routes->get('/unduh', 'Home::unduh');
$routes->get('/daftar-penerima/dana', 'Home::penerima_dana');
$routes->get('/daftar-penerima/hibah', 'Home::penerima_hibah');

// BACK ROUTES
// Authentication
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::cek_login');
$routes->get('/logout', 'Login::logout');
// Dashboard
$routes->get('/admin/dashboard', 'User::index');
// Profil: Tentang Kami
$routes->get('/admin/profil/tentang-kami', 'TentangKami::index');
$routes->post('/admin/profil/tentang-kami/add', 'TentangKami::add_tentang_kami');
$routes->post('/admin/profil/tentang-kami/edit/(:segment)', 'TentangKami::edit_tentang_kami/$1');
$routes->get('/admin/profil/tentang-kami/delete/(:segment)', 'TentangKami::delete_tentang_kami/$1');
// Profil: Visi
$routes->get('/admin/profil/visi', 'Visi::index');
$routes->post('/admin/profil/visi/add', 'Visi::add_visi');
$routes->post('/admin/profil/visi/edit/(:segment)', 'Visi::edit_visi/$1');
$routes->get('/admin/profil/visi/delete/(:segment)', 'Visi::delete_visi/$1');
// Profil: Misi
$routes->get('/admin/profil/misi', 'Misi::index');
$routes->post('/admin/profil/misi/add', 'Misi::add_misi');
$routes->post('/admin/profil/misi/edit/(:segment)', 'Misi::edit_misi/$1');
$routes->get('/admin/profil/misi/delete/(:segment)', 'Misi::delete_misi/$1');
// Agenda
$routes->get('/admin/agenda', 'Agenda::index');
$routes->post('/admin/agenda/add', 'Agenda::add_agenda');
$routes->post('/admin/agenda/edit/(:segment)', 'Agenda::edit_agenda/$1');
$routes->get('/admin/agenda/delete/(:segment)', 'Agenda::delete_agenda/$1');
// Berita
$routes->get('/admin/berita', 'Berita::index');
$routes->post('/admin/berita/add', 'Berita::add_berita');
$routes->post('/admin/berita/edit/(:segment)', 'Berita::edit_berita/$1');
$routes->get('/admin/berita/delete/(:segment)', 'Berita::delete_berita/$1');
// Unduh
$routes->get('/admin/unduh', 'Unduh::index');
$routes->post('/admin/unduh/add', 'Unduh::add_unduh');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
