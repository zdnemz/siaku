<?php

namespace App\Models;

use App\Core\Database;

class DivisiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM divisi";
        return $this->db->fetchAll($sql);
    }

    public function create($nama)
    {
        $sql = "INSERT INTO divisi (nama) VALUES (:nama)";
        $params = [
            ':nama' => $nama
        ];
        return $this->db->fetch($sql, $params);
    }

    public function edit($id, $nama) {
        $sql = "UPDATE divisi SET nama = :nama WHERE id_divisi = :id";
        $params = [
            ':nama' => $nama,
            ':id' => $id
        ];

        return $this->db->execute($sql, $params);
    }

    public function delete($id) {
        $sql = "DELETE FROM divisi WHERE id_divisi = :id";
        $params = [
            ':id' => $id
        ];

        return $this->db->execute($sql, $params);
    }
}