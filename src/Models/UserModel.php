<?php

namespace App\Models;

use App\Core\Database;
use App\Helpers\GenerateUUID;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function get($email)
    {
        $sql = "SELECT * FROM pengguna WHERE email = :email";
        $params = [':email' => $email];

        return $this->db->fetch($sql, $params);
    }

    public function getById($id)
    {
        $sql = "SELECT pengguna.email, pengguna.nip, pengguna.nama as nama, divisi.nama as divisi FROM pengguna INNER JOIN divisi ON pengguna.id_divisi = divisi.id_divisi WHERE pengguna.id_pengguna = :id";
        $params = [':id' => $id];

        return $this->db->fetch($sql, $params);
    }

    public function create($data)
    {
        $id = GenerateUUID::generate();

        $sql = "INSERT INTO pengguna (id_pengguna, nip, nama, email, password, id_divisi) VALUES (:id, :nip, :name, :email, :password, :id_divisi)";
        $params = [
            ':id' => $id,
            ':nip' => $data['nip'],
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ':id_divisi' => $data['divisi']
        ];

        return $this->db->execute($sql, $params);
    }

    public function login($identifier, $password)
    {
        $sql = "SELECT * FROM pengguna WHERE email = :identifier OR nip = :identifier";
        $params = [':identifier' => $identifier];

        $user = $this->db->fetch($sql, $params);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
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