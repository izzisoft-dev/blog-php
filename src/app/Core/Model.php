<?php

namespace App\Core;

use App\Core\Database;
use PDO;

class Model {

    protected $db;

    public function __construct(){
        $this->db = (new Database())->getConnection();
    }

    protected function insert(string $table, array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $stmt = $this->db->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})");
        $stmt->execute(array_values($data));

        return (int) $this->db->lastInsertId();
    }

    protected function get(string $table): array{

        $stmt = $this->db->query("SELECT * FROM {$table}");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getAll(): array {                                                                                          
        return $this->get($this->table);                                                                                          
    } 
}