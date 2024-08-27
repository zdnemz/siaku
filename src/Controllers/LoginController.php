<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\JWT;
use App\Models\UserModel;

class LoginController extends Controller
{
    // Method untuk menampilkan halaman login
    public function index()
    {
        // Data untuk dikirim ke view
        $data = [
            'title' => 'Siaku - Login',
        ];

        // Render tampilan login dengan data yang disiapkan
        $this->render('login', $data);
    }

    // Method untuk memproses login
    public function login()
    {
        // Mulai session
        session_start();

        // Validasi input
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            $_SESSION['error'] = "Email dan password harus diisi!";
            $this->redirect('/login');
            return;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email tidak valid!";
            $this->redirect('/login');
            return;
        }

        // Cek user di database
        $userModel = new UserModel();
        $user = $userModel->login($email, $password);

        if ($user) {
            // Lakukan regenerasi session ID untuk keamanan
            session_regenerate_id(true);

            // Generate JWT token dengan data pengguna
            $token = JWT::generate([
                'id' => $user['id_pengguna'],
                'role' => $user['hak_akses'],
            ]);

            // Set session dengan token JWT
            $_SESSION['jwt'] = $token;
            $_SESSION['role'] = $user['hak_akses'];

            // Redirect sesuai dengan peran (role) pengguna
            $this->redirect($user['hak_akses'] === 'admin' ? '/admin/dashboard' : '/');
        } else {
            // Hapus semua data session jika login gagal
            session_unset();
            $_SESSION['error'] = 'Email atau password salah!';
            $this->redirect('/login');
        }
    }
}
