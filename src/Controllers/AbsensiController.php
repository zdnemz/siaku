<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;

class AbsensiController extends Controller
{

    public function __construct()
    {
        AuthMiddleware::handle();
    }

    public function index()
    {

        $data = [
            'title' => 'Siaku - Absensi',
        ];

        $this->render('absensi', $data);
        return;

    }
}