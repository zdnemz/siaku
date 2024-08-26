<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class DashboardController extends Controller
{

    public function __construct()
    {
        AuthMiddleware::handle();
    }

    public function index()
    {
        return $this->render('dashboard', [
            'title' => 'Siaku - Dashboard',
        ]);
    }
}