<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\KelasModel;
use App\Models\PengajarModel;

class KelasController extends Controller
{
    protected $model;

    public function __construct()
    {
        $payload = AuthMiddleware::handle();

        if (!$payload || $payload->role != 'admin') {
            $this->render('error/unauthorize');
            exit;
        }

        $this->model = new KelasModel();
    }

    public function index()
    {

        $kelas = $this->model->getAll();

        $pengajar = new PengajarModel();
        $pengajar = $pengajar->getAll();

        return $this->render('admin/kelas', [
            'title' => 'Siaku - Kelas',
            'kelas' => $kelas,
            'pengajar' => $pengajar
        ]);
    }

    public function create()
    {
        $pembelajaran = htmlspecialchars(trim($_POST['pembelajaran']));
        $mulai = htmlspecialchars(trim($_POST['mulai']));
        $berakhir = htmlspecialchars(trim($_POST['berakhir']));
        $grup = htmlspecialchars(trim($_POST['grup']));
        $materi = htmlspecialchars(trim($_POST['materi']));
        $zoom = htmlspecialchars(trim($_POST['zoom']));
        $pengajar = htmlspecialchars(trim($_POST['pengajar']));

        $data = [
            'pembelajaran' => $pembelajaran,
            'mulai' => $mulai,
            'berakhir' => $berakhir,
            'grup' => $grup,
            'materi' => $materi,
            'zoom' => $zoom,
            'pengajar' => $pengajar,
        ];

        $this->model->create($data);

        $this->redirect('/admin/kelas');
    }


    public function edit()
    {
        if (!isset($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];
        $pembelajaran = htmlspecialchars(trim($_POST['pembelajaran']));
        $mulai = htmlspecialchars(trim($_POST['mulai']));
        $berakhir = htmlspecialchars(trim($_POST['berakhir']));
        $grup = htmlspecialchars(trim($_POST['grup']));
        $materi = htmlspecialchars(trim($_POST['materi']));
        $zoom = htmlspecialchars(trim($_POST['zoom']));
        $pengajar = htmlspecialchars(trim($_POST['pengajar']));

        $data = [
            'pembelajaran' => $pembelajaran,
            'mulai' => $mulai,
            'berakhir' => $berakhir,
            'grup' => $grup,
            'materi' => $materi,
            'zoom' => $zoom,
            'pengajar' => $pengajar,
        ];

        $this->model->edit($id, $data);

        $this->redirect('/admin/kelas');
    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            return;
        }

        $id = $_GET['id'];

        $this->model->delete($id);

        $this->redirect('/admin/kelas');
    }
}