<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Models\AbsensiModel;
use App\Models\KelasModel;
use App\Models\UserModel;

class AbsensiController extends Controller
{
    private $payload = [];

    public function __construct()
    {
        $payload = AuthMiddleware::handle();

        if (!$payload) {
            $this->redirect('/auth/login');
        }

        $this->payload = $payload;
    }

    public function index()
    {

        $kelas = new KelasModel();
        $kelas = $kelas->getUnexpired($this->payload->id);

        $user = new UserModel();
        $user = $user->getById($this->payload->id);


        $data = [
            'title' => 'Siaku - Absensi',
            'kelas' => $kelas,
            'user' => $user,
            'payload' => $this->payload
        ];

        $this->render('absensi', $data);
        return;

    }

    public function create()
    {
        if (!isset($_GET['id'])) {
            return;
        }

        $id_kelas = $_GET['id'];
        $id_pengguna = $this->payload->id;
        $status = $_POST['absensi'];
        $keterangan = $_POST['keterangan'] ?? null;

        $data = [
            'id_pengguna' => $id_pengguna,
            'id_kelas' => $id_kelas,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        $absensi = new AbsensiModel();
        $absensi->create($data);

        $this->redirect('/absensi');
    }
}