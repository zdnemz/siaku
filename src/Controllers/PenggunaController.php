<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\PenggunaModel;
use App\Models\DivisiModel;

class PenggunaController extends Controller
{
    protected $model;

    public function __construct()
    {
        $payload = AuthMiddleware::handle();

        if (!$payload || $payload->role != 'admin') {
            $this->render('error/unauthorize');
            exit;
        }

        $this->model = new PenggunaModel();
    }

    public function index()
    {

        $pengguna = $this->model->getAll();

        $divisi = new DivisiModel();
        $divisi = $divisi->getAll();

        return $this->render('admin/pengguna', [
            'title' => 'Siaku - Pengguna',
            'pengguna' => $pengguna,
            'divisi' => $divisi
        ]);
    }

    public function create()
    {
        $nip = htmlspecialchars(trim($_POST['nip']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $nama = htmlspecialchars(trim($_POST['nama']));
        $divisi = htmlspecialchars(trim($_POST['divisi'] ?? 'null'));
        $role = htmlspecialchars(trim($_POST['role']));

        $data = [
            'nip' => $nip,
            'email' => $email,
            'password' => $password,
            'nama' => $nama,
            'divisi' => $divisi,
            'role' => $role,
        ];

        $user = $this->model->exists($email, $nip);
        if ($user) {
            $_SESSION['error'] = 'Akun sudah terdaftar';
            $this->redirect('/admin/pengguna');
        }


        $this->model->create($data);

        $this->redirect('/admin/pengguna');
    }



    public function edit()
    {
        if (!isset($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];

        $nama = htmlspecialchars(trim($_POST['nama']));
        $nip = htmlspecialchars(trim($_POST['nip']));
        $email = htmlspecialchars(trim($_POST['email']));
        $divisi = htmlspecialchars(trim($_POST['divisi'] ?? 'null'));
        $role = htmlspecialchars(trim($_POST['role']));

        $data = [
            'nama' => $nama,
            'nip' => $nip,
            'email' => $email,
            'divisi' => $divisi,
            'role' => $role,
        ];

        $this->model->edit($id, $data);

        $this->redirect('/admin/pengguna');
    }


    public function delete()
    {
        if (!isset($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];

        $this->model->delete($id);

        $this->redirect('/admin/pengguna');
    }
}