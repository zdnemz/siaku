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
        $sql = "SELECT pengguna.email, pengguna.nip, pengguna.nama, divisi.nama FROM pengguna INNER JOIN divisi ON pengguna.id_divisi = divisi.id_divisi WHERE pengguna.id_pengguna = :id";
        $params = [':id' => $id];

        return $this->db->fetch($sql, $params);
    }

    public function create($data)
    {
        $id = GenerateUUID::generate();

        $sql = "INSERT INTO pengguna (id_pengguna, nama, email, password, id_divisi) VALUES (:id, :name, :email, :password, :id_divisi)";
        $params = [
            ':id' => $id,
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
            ':id_divisi' => $data['divisi']
        ];

        return $this->db->execute($sql, $params);
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM pengguna WHERE email = :email";
        $params = [':email' => $email];

        $user = $this->db->fetch($sql, $params);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function exists($email)
    {
        $sql = "SELECT * FROM pengguna WHERE email = :email";
        $params = [':email' => $email];

        $user = $this->db->fetch($sql, $params);

        if ($user) {
            return true;
        }

        return false;
    }
}