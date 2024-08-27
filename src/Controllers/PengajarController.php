<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\PengajarModel;

class PengajarController extends Controller
{
    protected $model;

    public function __construct()
    {
        $payload = AuthMiddleware::handle();

        if (!$payload || $payload->role != 'admin') {
            $this->render('error/unauthorize');
            exit;
        }

        $this->model = new pengajarModel();
    }

    public function index()
    {

        $pengajar = $this->model->getAll();

        return $this->render('admin/pengajar', [
            'title' => 'Siaku - Pengajar',
            'pengajar' => $pengajar
        ]);
    }

    public function create()
    {

        $nama = htmlspecialchars(trim($_POST['nama']));
        $alamat = htmlspecialchars(trim($_POST['alamat']));

        $data = [
            'nama' => $nama,
            'alamat' => $alamat,
        ];

        $this->model->create($data);

        $this->redirect('/admin/pengajar');
    }

    public function edit()
    {
        if (!isset($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];
        $nama = htmlspecialchars(trim($_POST['nama']));
        $alamat = htmlspecialchars(trim($_POST['alamat']));

        $data = [
            'nama' => $nama,
            'alamat' => $alamat,
        ];

        $this->model->edit($id, $data);

        $this->redirect('/admin/pengajar');
    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];

        $this->model->delete($id);

        $this->redirect('/admin/pengajar');
    }
}