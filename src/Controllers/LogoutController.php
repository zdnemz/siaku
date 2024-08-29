<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class LogoutController extends Controller
{

    public function __construct()
    {
        AuthMiddleware::handle();
    }

    public function logout()
    {
        // Hapus sesi JWT
        unset($_SESSION['jwt']);
        // Regenerasi session ID untuk mencegah session fixation
        session_regenerate_id(true);

        // Redirect ke halaman beranda
        $this->redirect('/');
        return;
    }
}