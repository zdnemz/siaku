<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Encrypt;
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

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'email' => $email,
            'password' => $hashedPassword,
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

        // Regenerasi session ID untuk keamanan
        session_regenerate_id(true);

        $_SESSION['hak_akses'] = 'user';
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_id'] = $user['id_pengguna'];

        $this->redirect('/');
        return;
    }
}
