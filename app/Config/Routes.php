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
$routes->group('', function ($routes) {

    // Laman Landing Page
    $routes->get('/', 'Home::index');

    // Laman Login
    $routes->get('/login', 'Auth::login');
});

$routes->group('', function ($routes) {

    // Pengajuan
    $routes->get('/surat_online',         'SuratOnline::index');
    $routes->post('/surat_online/ajukan', 'SuratOnline::ajukan');

    //tracking 
    $routes->get('/tracking',                'Tracking::index');
    $routes->get('/tracking/tracked/(:any)', 'Tracking::tracked/$1');
    $routes->post('/tracking/cari',          'Tracking::cari');
});

$routes->group('', function ($routes) {

    // Authentication
    $routes->get('/logout',    'Auth::logout');
    $routes->post('/login',    'Auth::login');
});

$routes->group('', ['filter' => 'authfilter'], function ($routes) {

    // Laman Dashboard
    $routes->get('/dashboard', 'Dashboard::index');
});

$routes->group('', ['filter' => 'authfilter'], function ($routes) {

    // Management User
    $routes->get('/user',                 'User::index');
    $routes->get('/user/tambah',          'User::tambah');
    $routes->get('/user/edit/(:num)',     'User::edit/$1');
    $routes->post('/user/tambah',         'User::create');
    $routes->post('/user/edit/(:num)',    'User::update/$1');
    $routes->delete('/user/hapus/(:num)', 'User::delete/$1');
});

$routes->group('', ['filter' => 'authfilter'], function ($routes) {

    // Management Penduduk
    $routes->get('/penduduk',                 'Penduduk::index');
    $routes->get('/penduduk/tambah',          'Penduduk::tambah');
    $routes->get('/penduduk/edit/(:num)',     'Penduduk::edit/$1');
    $routes->post('/penduduk/tambah',         'Penduduk::create');
    $routes->post('/penduduk/edit/(:num)',    'Penduduk::update/$1');
    $routes->delete('/penduduk/hapus/(:num)', 'Penduduk::delete/$1');
});

$routes->group('', ['filter' => 'authfilter'], function ($routes) {

    // Management Pegawai
    $routes->get('/pegawai',                 'Pegawai::index');
    $routes->get('/pegawai/tambah',          'Pegawai::tambah');
    $routes->post('/pegawai/tambah',         'Pegawai::create');
    $routes->get('pegawai/edit/(:num)',      'Pegawai::edit/$1');
    $routes->post('pegawai/edit/(:num)',     'Pegawai::update/$1');
    $routes->delete('/pegawai/hapus/(:num)', 'Pegawai::delete/$1');
});

$routes->group('', ['filter' => 'authfilter'], function ($routes) {

    // Management Galery
    $routes->get('/galery/s_kelurahan',              'Galery::s_kelurahan');
    $routes->get('/galery/profil_kelurahan',         'Galery::profil_kelurahan');
    $routes->get('/galery/edit_s_kelurahan/(:num)',  'Galery::edit_s_kelurahan/$1');
    $routes->get('/galery/edit_profil/(:num)',       'Galery::edit_profil/$1');
    $routes->post('/galery/edit_profil/(:num)',      'Galery::update_profile/$1');
    $routes->post('/galery/edit_s_kelurahan/(:num)', 'Galery::update_s_kelurahan/$1');
});

$routes->group('', ['filter' => 'authfilter'], function ($routes) {

    // Management Surat Masuk
    $routes->get('/surat_keluar',                     'Surat::surat_keluar');
    $routes->get('/surat/tambah_surat_keluar',        'Surat::tambah_surat_keluar');
    $routes->get('/surat/edit_surat_keluar/(:num)',   'Surat::edit_surat_keluar/$1');
    $routes->post('/surat/tambah_surat_keluar',       'surat::create_surat_keluar');
    $routes->post('/surat/edit_surat_keluar/(:num)',  'Surat::update_surat_keluar/$1');
    $routes->delete('/surat/hapusSuratKeluar/(:num)', 'Surat::hapus_surat_keluar/$1');

    // Management Surat Keluar
    $routes->get('/surat_masuk',                     'Surat::surat_masuk');
    $routes->get('/surat/tambah_surat_masuk',        'Surat::tambah_surat_masuk');
    $routes->get('/surat/edit_surat_masuk/(:num)',   'Surat::edit_surat_masuk/$1');
    $routes->post('/surat/tambah_surat_masuk',       'surat::create_surat_masuk');
    $routes->post('/surat/edit_surat_masuk/(:num)',  'Surat::update_surat_masuk/$1');
    $routes->delete('/surat/hapusSuratMasuk/(:num)', 'Surat::hapus_surat_masuk/$1');

    // Management Surat Keterangan
    $routes->get('/surat_keterangan',                     'Surat::surat_keterangan');
    $routes->get('/surat/tambah_surat_keterangan',        'Surat::tambah_surat_keterangan');
    $routes->get('/surat/edit_surat_keterangan/(:num)',   'Surat::edit_surat_keterangan/$1');
    $routes->post('/surat/tambah_surat_keterangan',       'surat::create_surat_keterangan');
    $routes->post('/surat/edit_surat_keterangan/(:num)',  'Surat::update_surat_keterangan/$1');
    $routes->delete('/surat/hapusSuratKeterangan/(:num)', 'Surat::hapus_surat_keterangan/$1');

    // Management Surat Pengajuan
    $routes->get('/surat_pengajuan',                       'Surat::pengajuan');
    $routes->post('/surat_pengajuan/update_status/(:any)', 'Surat::update_status/$1');
    $routes->delete('/surat/hapusPengajuan/(:any)',        'Surat::hapusPengajuan/$1');
});

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
