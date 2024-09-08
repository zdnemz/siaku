<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $dsn;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        $this->dsn = getenv('DATABASE_DSN');
        $this->username = getenv('DATABASE_USERNAME');
        $this->password = getenv('DATABASE_PASSWORD');
        $this->connect();
    }

    private function connect()
    {
        $this->conn = null;
        try {

            $this->conn = new PDO(
                $this->dsn,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function execute($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
}
