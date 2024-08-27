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
        $this->render('auth/register', $data);
    }

    public function register()
    {
        $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
        $nip = htmlspecialchars(trim($_POST['nip']), ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
        $divisi = htmlspecialchars(trim($_POST['divisi']), ENT_QUOTES, 'UTF-8');

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email tidak valid';
            $this->redirect('/auth/register');
            return;
        }

        // Validasi password
        if (strlen($password) < 8) {
            $_SESSION['error'] = 'Password harus lebih dari 8 karakter';
            $this->redirect('/auth/register');
            return;
        }

        // Memanggil model User
        $userModel = new UserModel();

        // Periksa apakah email sudah terdaftar
        if ($userModel->exists($email, $nip)) {
            $_SESSION['error'] = 'Akun sudah terdaftar';
            $this->redirect('/auth/register');
            return;
        }


        $data = [
            'nip' => $nip,
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'divisi' => $divisi
        ];

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
        $_SESSION['role'] = $role;

        $this->redirect('/');
        return;
    }
}
