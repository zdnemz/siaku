<?php

use App\Controllers\AboutController;
use App\Controllers\AbsensiController;
use App\Controllers\DivisiController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\KelasController;
use App\Controllers\LaporanController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\NotFoundController;
use App\Controllers\PengajarController;
use App\Controllers\PenggunaController;
use App\Controllers\ProfilController;
use App\Controllers\RegisterController;

use App\Core\Router;

// Membuat instance dari kelas Router
$router = new Router();

// Mendaftarkan rute untuk metode GET dengan URI yang akan memanggil action pada controller
$router->get('/', HomeController::class, 'index');
$router->get('/auth/login', LoginController::class, 'index');
$router->get('/auth/register', RegisterController::class, 'index');
$router->get('/about', AboutController::class, 'index');
$router->get('/absensi', AbsensiController::class, 'index');
$router->get('/profil', ProfilController::class, 'index');
// admin rute
$router->get('/admin/dashboard', DashboardController::class, 'index');
$router->get('/admin/divisi', DivisiController::class, 'index');
$router->get('/admin/kelas', KelasController::class, 'index');
$router->get('/admin/pengguna', PenggunaController::class, 'index');
$router->get('/admin/laporan', LaporanController::class, 'index');
$router->get('/admin/laporan/export', LaporanController::class, 'exportToExcel');

// Mendaftarkan rute untuk metode POST dengan URI yang akan memanggil action pada controller
$router->post('/absensi', AbsensiController::class, 'create');

// auth rute
$router->post('/auth/login', LoginController::class, 'login');
$router->post('/auth/register', RegisterController::class, 'register');
$router->post('/auth/logout', LogoutController::class, 'logout');

// divisi rute
$router->post('/admin/divisi/create', DivisiController::class, 'create');
$router->post('/admin/divisi/edit', DivisiController::class, 'edit');
$router->post('/admin/divisi/delete', DivisiController::class, 'delete');

// kelas rute
$router->post('/admin/kelas/create', KelasController::class, 'create');
$router->post('/admin/kelas/edit', KelasController::class, 'edit');
$router->post('/admin/kelas/delete', KelasController::class, 'delete');

// peserta rute
$router->post('/admin/pengguna/create', PenggunaController::class, 'create');
$router->post('/admin/pengguna/edit', PenggunaController::class, 'edit');
$router->post('/admin/pengguna/delete', PenggunaController::class, 'delete');

// Menetapkan handler untuk rute yang tidak ditemukan (404)
$router->setNotFoundHandler(function () {
    $controller = new NotFoundController();
    $controller->index();
});

// Mengatur dan menjalankan rute yang sesuai dengan permintaan saat ini
$router->dispatch();
