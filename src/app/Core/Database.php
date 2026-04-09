<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private PDO $conn;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

        try {
            $this->conn = new PDO(
                "mysql:host={$config['host']};port={$config['port']};dbname={$config['name']};charset=utf8mb4",
                $config['user'],
                $config['password']
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
