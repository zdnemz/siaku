<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\DivisiModel;

class DivisiController extends Controller
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

        $divisiModel = new DivisiModel();
        $divisi = $divisiModel->getAll();

        return $this->render('admin/divisi', [
            'title' => 'Siaku - Divisi',
            'divisi' => $divisi
        ]);
    }
}