<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Encrypt;
use App\Models\UserModel;

class LoginController extends Controller
{
    // Method untuk menangani permintaan ke halaman utama (home)
    public function index()
    {
        // Menyiapkan data yang akan dikirim ke tampilan (view)
        $data = [
            'title' => 'Siaku - Login',
        ];

        // Merender tampilan 'index' dengan data yang telah disiapkan
        $this->render('login', $data);
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect("/login", ['error' => Encrypt::encrypt('Email tidak valid')]);
            return;
        }

        $userModel = new UserModel();
        $user = $userModel->login($email, $password);

        if ($user) {
            // Regenerasi session ID untuk mencegah session fixation
            session_regenerate_id(true);

            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id_pengguna'];

            switch ($user['hak_akses']) {
                case 'admin':
                    $_SESSION['hak_akses'] = 'admin';
                    $this->redirect('/dashboard');
                    break;

                case 'user':
                    $_SESSION['hak_akses'] = 'user';
                    $this->redirect('/');
                    break;

                default:
                    $_SESSION['hak_akses'] = 'user';
                    $this->redirect('/');
                    break;
            }

        } else {
            // Hapus data session jika login gagal
            unset($_SESSION['email']);
            unset($_SESSION['user_id']);
            $_SESSION['error'] = 'Email atau password salah!';
            $this->redirect('/login');
            return;
        }
    }
}
