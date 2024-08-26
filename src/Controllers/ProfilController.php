<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\UserModel;

class ProfilController extends Controller
{

    public function __construct()
    {
        AuthMiddleware::handle();
    }

    public function index()
    {
        $userModel = new UserModel();

        $user = $userModel->getById($_SESSION['user_id']);

        return $this->render('profil', [
            'title' => 'Siaku - Profil',
            'user' => $user
        ]);
    }
}