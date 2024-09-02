<?php

namespace App\Models;

use App\Core\Database;
use App\Helpers\GenerateUUID;

class KelasModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $sql = "SELECT kelas.*, pengguna.nama as pengajar FROM kelas INNER JOIN pengguna ON kelas.id_pengajar = pengguna.id_pengguna WHERE pengguna.role = 'pengajar'";
        return $this->db->fetchAll($sql);
    }

    public function getUnexpired($id)
    {
        $sql = "SELECT kelas.*, pengguna.nama AS pengajar FROM kelas LEFT JOIN absensi ON kelas.id_kelas = absensi.id_kelas INNER JOIN pengguna ON kelas.id_pengajar = pengguna.id_pengguna WHERE (absensi.id_pengguna != :id OR absensi.id_pengguna IS NULL) AND pengguna.role = 'pengajar' AND kelas.berakhir >= CURRENT_DATE() AND kelas.mulai <= CURRENT_DATE()";

        $params = [':id' => $id];

        return $this->db->fetchAll($sql, $params);
    }

    public function create($data)
    {
        // Generate a unique ID
        $id = GenerateUUID::generate();

        // SQL statement to insert data into the database
        $sql = "INSERT INTO kelas (id_kelas, pembelajaran, mulai, berakhir, grup, materi, zoom, id_pengajar) VALUES (:id, :pembelajaran, :mulai, :berakhir, :grup, :materi, :zoom, :pengajar)";

        // Parameters for the SQL query
        $params = [
            ':id' => $id,
            ':pembelajaran' => $data['pembelajaran'],
            ':mulai' => $data['mulai'],
            ':berakhir' => $data['berakhir'],
            ':grup' => $data['grup'],
            ':materi' => $data['materi'],
            ':zoom' => $data['zoom'],
            ':pengajar' => $data['pengajar']
        ];

        // Execute the SQL query and return the result
        return $this->db->fetch($sql, $params);
    }


    public function edit($id, $data)
    {
        $sql = "UPDATE kelas SET pembelajaran = :pembelajaran, mulai = :mulai, berakhir = :berakhir, grup = :grup, materi = :materi, zoom = :zoom, id_pengajar = :pengajar WHERE id_kelas = :id";
        $params = [
            ':pembelajaran' => $data['pembelajaran'],
            ':mulai' => $data['mulai'],
            ':berakhir' => $data['berakhir'],
            ':grup' => $data['grup'],
            ':materi' => $data['materi'],
            ':zoom' => $data['zoom'],
            ':pengajar' => $data['pengajar'],
            ':id' => $id
        ];

        return $this->db->execute($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM kelas WHERE id_kelas = :id";
        $params = [
            ':id' => $id
        ];

        return $this->db->execute($sql, $params);
    }
}