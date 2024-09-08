<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middlewares\AuthMiddleware;

class DashboardController extends Controller
{

    public function __construct()
    {
        $payload = AuthMiddleware::handle();

        if (!$payload || $payload->role != 'admin') {
            $this->render('error/unauthorize');
            exit;
        }

    }

    public function index()
    {
        return $this->render('admin/dashboard', [
            'title' => 'Siaku - Dashboard',
        ]);
    }
}