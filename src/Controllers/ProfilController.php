<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\UserModel;

class ProfilController extends Controller
{
    private $payload = [];

    public function __construct()
    {
        $payload = AuthMiddleware::handle();

        if (!$payload) {
            $this->redirect('/login');
        }

        $this->payload = $payload;
    }

    public function index()
    {
        $userModel = new UserModel();

        $user = $userModel->getById($this->payload->id);

        return $this->render('profil', [
            'title' => 'Siaku - Profil',
            'user' => $user
        ]);
    }
}