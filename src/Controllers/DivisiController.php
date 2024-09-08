<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middlewares\AuthMiddleware;
use App\Models\DivisiModel;

class DivisiController extends Controller
{
    protected $model;

    public function __construct()
    {
        $payload = AuthMiddleware::handle();

        if (!$payload || $payload->role != 'admin') {
            $this->render('error/unauthorize');
            exit;
        }

        $this->model = new DivisiModel();
    }

    public function index()
    {

        $divisi = $this->model->getAll();

        return $this->render('admin/divisi', [
            'title' => 'Siaku - Divisi',
            'divisi' => $divisi
        ]);
    }

    public function create()
    {

        $nama = htmlspecialchars(trim($_POST['nama']));

        $this->model->create($nama);

        $this->redirect('/admin/divisi');
    }

    public function edit()
    {
        if (!isset($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];
        $nama = $_POST['nama'];

        $this->model->edit($id, $nama);

        $this->redirect('/admin/divisi');
    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];

        $this->model->delete($id);

        $this->redirect('/admin/divisi');
    }
}