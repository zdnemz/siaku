<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\JWT;
use App\Models\DivisiModel;
use App\Models\UserModel;

class RegisterController extends Controller
{
    public function index()
    {
        $divisiModel = new DivisiModel();
        $divisi = $divisiModel->getAll();

        $data = [
            'title' => 'Siaku - Register',
            'divisi' => $divisi
        ];
        $this->render('register', $data);
    }

    public function register()
    {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $name = htmlspecialchars($_POST['name']);
        $divisi = htmlspecialchars($_POST['divisi']);

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email tidak valid';
            $this->redirect('/register');
            return;
        }

        // Validasi password
        if (strlen($password) < 8) {
            $_SESSION['error'] = 'Password harus lebih dari 8 karakter';
            $this->redirect('/register');
            return;
        }

        $data = [
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'divisi' => $divisi
        ];

        $userModel = new UserModel();

        // Periksa apakah email sudah terdaftar
        if ($userModel->exists($email)) {
            $_SESSION['error'] = 'Email sudah terdaftar';
            $this->redirect('/register');
            return;
        }

        // Buat user baru
        $userModel->create($data);
        $user = $userModel->get($email);

        session_regenerate_id(true);

        $user_id = $user['id_pengguna'];
        $role = $user['hak_akses'];

        // Generate JWT token
        $token = JWT::generate([
            'id' => $user_id,
            'role' => $role
        ]);

        // Set session
        $_SESSION['jwt'] = $token;

        $this->redirect('/');
        return;
    }
}
