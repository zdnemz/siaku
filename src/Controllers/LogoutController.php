<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middlewares\AuthMiddleware;

class LogoutController extends Controller
{

    public function __construct()
    {
        AuthMiddleware::handle();
    }

    public function logout()
    {
        // Hapus sesi JWT dan role pengguna
        unset($_SESSION['jwt']);
        unset($_SESSION['role']);
        // Regenerasi session ID untuk mencegah session fixation
        session_regenerate_id(true);

        // Redirect ke halaman beranda
        $this->redirect('/');
        return;
    }
}