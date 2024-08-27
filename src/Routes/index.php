<?php

use App\Controllers\AboutController;
use App\Controllers\AbsensiController;
use App\Controllers\DivisiController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\NotFoundController;
use App\Controllers\DashboardController;
use App\Controllers\ProfilController;
use App\Controllers\RegisterController;

use App\Core\Router;

// Membuat instance dari kelas Router
$router = new Router();

// Mendaftarkan rute untuk metode GET dengan URI yang akan memanggil action pada controller
$router->get('/', HomeController::class, 'index');
$router->get('/login', LoginController::class, 'index');
$router->get('/register', RegisterController::class, 'index');
$router->get('/about', AboutController::class, 'index');
$router->get('/absensi', AbsensiController::class, 'index');
$router->get('/profil', ProfilController::class, 'index');
// admin rute
$router->get('/admin/dashboard', DashboardController::class, 'index');
$router->get('/admin/divisi', DivisiController::class, 'index');

// Mendaftarkan rute untuk metode POST dengan URI yang akan memanggil action pada controller
$router->post('/login', LoginController::class, 'login');
$router->post('/register', RegisterController::class, 'register');
$router->post('/logout', LogoutController::class, 'logout');


// Menetapkan handler untuk rute yang tidak ditemukan (404)
$router->setNotFoundHandler(function () {
    $controller = new NotFoundController();
    $controller->index();
});

// Mengatur dan menjalankan rute yang sesuai dengan permintaan saat ini
$router->dispatch();
