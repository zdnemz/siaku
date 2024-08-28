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
        $sql = "SELECT pengguna.id_pengguna, pengguna.nip, pengguna.email, pengguna.nama, pengguna.id_divisi, pengguna.role, divisi.nama AS divisi FROM pengguna LEFT JOIN divisi ON pengguna.id_divisi = divisi.id_divisi;";

        return $this->db->fetchAll($sql);
    }

    public function getPengajar()
    {
        $sql = "SELECT *, id_pengguna AS id_pengajar FROM pengguna WHERE role = 'pengajar';";
        return $this->db->fetchAll($sql);
    }

    public function create($data)
    {
        $id = GenerateUUID::generate();

        $sql = "INSERT INTO pengguna (id_pengguna, nip, email, password, nama, id_divisi, role) 
            VALUES (:id, :nip, :email, :password, :nama, :divisi, :role)";

        $params = [
            ':id' => $id,
            ':nip' => $data['nip'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ':nama' => $data['nama'],
            ':divisi' => $data['divisi'] != 'null' ? $data['divisi'] : null,
            ':role' => $data['role'],
        ];

        return $this->db->fetch($sql, $params);
    }



    public function edit($id, $data)
    {
        $sql = "UPDATE pengguna SET nama = :nama, nip = :nip, email = :email, id_divisi = :divisi, role = :role WHERE id_pengguna = :id";

        $params = [
            ':id' => $id,
            ':nama' => $data['nama'],
            ':nip' => $data['nip'],
            ':email' => $data['email'],
            ':divisi' => $data['divisi'] != 'null' ? $data['divisi'] : null,
            ':role' => $data['role'],
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

    public function exists($email, $nip)
    {
        $sql = "SELECT * FROM pengguna WHERE email = :email OR nip = :nip";
        $params = [
            ':email' => $email,
            ':nip' => $nip
        ];

        $user = $this->db->fetch($sql, $params);

        if ($user) {
            return true;
        }

        return false;
    }
}