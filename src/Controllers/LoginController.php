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
        $this->render('auth/login', $data);
    }

    // Method untuk memproses login
    public function login()
    {
        // Mulai session
        session_start();

        // Validasi input
        if (!isset($_POST['identifier']) || !isset($_POST['password'])) {
            $_SESSION['error'] = "Email/NIP dan password harus diisi!";
            $this->redirect('/auth/login');
            return;
        }

        // Ambil input dari form
        $identifier = htmlspecialchars(trim($_POST['identifier']));
        $password = htmlspecialchars(trim($_POST['password']));

        // Cek user di database
        $userModel = new UserModel();
        $user = $userModel->login($identifier, $password);

        if ($user) {
            // Lakukan regenerasi session ID untuk keamanan
            session_regenerate_id(true);

            // Generate JWT token dengan data pengguna
            $token = JWT::generate([
                'id' => $user['id_pengguna'],
                'role' => $user['role'],
            ]);

            // Set session dengan token JWT
            $_SESSION['jwt'] = $token;
            $_SESSION['role'] = $user['role'];

            // Redirect sesuai dengan peran (role) pengguna
            $this->redirect($user['role'] === 'admin' ? '/admin/dashboard' : '/');
        } else {
            // Hapus semua data session jika login gagal
            session_unset();
            $_SESSION['error'] = 'Email/NIP atau password salah!';
            $this->redirect('/auth/login');
        }
    }
}
