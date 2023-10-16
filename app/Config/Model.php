<?php

namespace FrameworkSimas\Config;

use PDO;

class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $conn = "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']}:{$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}";
        $this->db = new PDO($conn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
    }

    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE deleted_at IS NULL");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data = [])
    {
        $data['created_at'] = date('Y-m-d H:i:s');

        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_map(fn ($value) => ":$value", array_keys($data)));

        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");

        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $data[$key]);
        }

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function update($id, $data = [])
    {
        $data['updated_at'] = date('Y-m-d H:i:s');

        $updates = [];
        foreach ($data as $key => $value) {
            $updates[] = "$key = :$key";
        }
        $updateString = implode(', ', $updates);

        $stmt = $this->db->prepare("UPDATE {$this->table} SET $updateString WHERE id = :id");
        $stmt->bindParam(":id", $id);

        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $data[$key]);
        }

        $stmt->execute();

        return $stmt->rowCount();
    }


    public function delete($id)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->rowCount();
    }


    public function deletePermanent($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->rowCount();
    }
}
