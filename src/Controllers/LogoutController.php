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
        unset($_SESSION['email']);
        unset($_SESSION['user_id']);
        $this->redirect('/');
        return;
    }
}