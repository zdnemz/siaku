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

    public function get($id)
    {
        $sql = "SELECT * FROM divisi WHERE id_divisi = :id";
        $params = [':id' => $id];
        return $this->db->fetch($sql, $params);
    }

    public function create($name)
    {
        $sql = "INSERT INTO divisi (nama) VALUES (:name)";
        $params = [
            ':name' => $name
        ];
        return $this->db->fetch($sql, $params);
    }
}