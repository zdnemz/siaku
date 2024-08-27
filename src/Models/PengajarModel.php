<?php

namespace App\Models;

use App\Core\Database;
use App\Helpers\GenerateUUID;

class PengajarModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM pengajar";
        return $this->db->fetchAll($sql);
    }

    public function create($data)
    {
        $id = GenerateUUID::generate();

        $sql = "INSERT INTO pengajar (id_pengajar, nama, alamat) VALUES (:id, :nama, :alamat)";
        $params = [
            ':id' => $id,
            ':nama' => $data['nama'],
            ':alamat' => $data['alamat']
        ];
        return $this->db->fetch($sql, $params);
    }

    public function edit($id, $data)
    {
        $sql = "UPDATE pengajar SET nama = :nama, alamat = :alamat WHERE id_pengajar = :id";
        $params = [
            ':id' => $id,
            ':nama' => $data['nama'],
            ':alamat' => $data['alamat']
        ];

        return $this->db->execute($sql, $params);
    }


    public function delete($id)
    {
        $sql = "DELETE FROM pengajar WHERE id_pengajar = :id";
        $params = [
            ':id' => $id
        ];

        return $this->db->execute($sql, $params);
    }
}