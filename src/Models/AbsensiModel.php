<?php

namespace App\Models;

use App\Core\Database;
use App\Helpers\GenerateUUID;

class AbsensiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $sql = "SELECT absensi.*, pengguna.nama AS nama, kelas.pembelajaran AS pembelajaran FROM absensi JOIN pengguna ON absensi.id_pengguna = pengguna.id_pengguna JOIN kelas ON absensi.id_kelas = kelas.id_kelas";

        return $this->db->fetchAll($sql);
    }

    public function create($data)
    {

        $id_absensi = GenerateUUID::generate();

        $sql = "INSERT INTO absensi (id_absensi, id_pengguna, id_kelas, status, keterangan) VALUES (:id_absensi, :id_pengguna, :id_kelas, :status, :keterangan)";
        $params = [
            ':id_absensi' => $id_absensi,
            ':id_pengguna' => $data['id_pengguna'],
            ':id_kelas' => $data['id_kelas'],
            ':status' => $data['status'],
            ':keterangan' => $data['keterangan']
        ];

        return $this->db->execute($sql, $params);
    }

    public function edit($id, $nama)
    {
        $sql = "UPDATE absensi SET nama = :nama WHERE id_absensi = :id";
        $params = [
            ':nama' => $nama,
            ':id' => $id
        ];

        return $this->db->execute($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM absensi WHERE id_absensi = :id";
        $params = [
            ':id' => $id
        ];

        return $this->db->execute($sql, $params);
    }
}