<?php

namespace App\Models;

use App\Core\Database;
use App\Helpers\GenerateUUID;

class PenggunaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $sql = "SELECT pengguna.id_pengguna, pengguna.nip, pengguna.email, pengguna.nama, pengguna.id_divisi, pengguna.hak_akses, divisi.nama AS divisi FROM pengguna INNER JOIN divisi ON pengguna.id_divisi = divisi.id_divisi;";
        return $this->db->fetchAll($sql);
    }

    public function create($data)
    {
        $id = GenerateUUID::generate();

        $sql = "INSERT INTO pengguna (id_pengguna, nip, email, password, nama, id_divisi, hak_akses) 
            VALUES (:id, :nip, :email, :password, :nama, :divisi, :hak_akses)";

        $params = [
            ':id' => $id,
            ':nip' => $data['nip'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ':nama' => $data['nama'],
            ':divisi' => $data['divisi'],
            ':hak_akses' => $data['hak_akses'],
        ];

        return $this->db->fetch($sql, $params);
    }



    public function edit($id, $data)
    {
        $sql = "UPDATE pengguna SET nama = :nama, nip = :nip, email = :email, id_divisi = :divisi, hak_akses = :hak_akses WHERE id_pengguna = :id";

        $params = [
            ':id' => $id,
            ':nama' => $data['nama'],
            ':nip' => $data['nip'],
            ':email' => $data['email'],
            ':divisi' => $data['divisi'],
            ':hak_akses' => $data['hak_akses'],
        ];

        return $this->db->execute($sql, $params);
    }



    public function delete($id)
    {
        $sql = "DELETE FROM pengguna WHERE id_pengguna = :id";
        $params = [
            ':id' => $id
        ];

        return $this->db->execute($sql, $params);
    }
}