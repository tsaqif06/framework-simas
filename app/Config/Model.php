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
        $keyName = "photo";
        if (isset($_FILES[$keyName]) && ($_FILES[$keyName]['error'] !== 4 || $_FILES[$keyName]['tmp_name'] !== '')) {
            $photo = $this->uploadImage($keyName);
            if ($photo == 0) {
                return 0;
            } else {
                $data['photo'] = $photo;
            }
        }
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

    public function uploadImage($key)
    {
        if ($_FILES[$key]['error'] == 4) {
            return;
        }

        $targetDir = ROOT . "/public/assets/img/uploads/";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES[$key]["name"], PATHINFO_EXTENSION));
        $randomString = bin2hex(random_bytes(10));
        $targetFile = $targetDir . $randomString . "." . $imageFileType;

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$key]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if ($_FILES[$key]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        $finalName = $randomString . "." . $imageFileType;

        if ($uploadOk == 0) {
            return $uploadOk;
        } else {
            if (move_uploaded_file($_FILES[$key]["tmp_name"], $targetFile)) {
                return $finalName;
            } else {
                return 0;
            }
        }
    }

    public function update($id, $data = [])
    {
        $keyName = "photo";
        if (isset($_FILES[$keyName]) && ($_FILES[$keyName]['error'] !== 4 || $_FILES[$keyName]['tmp_name'] !== '')) {
            $photo = $this->uploadImage($keyName);
            if ($photo == 0) {
                return 0;
            } else {
                $data['photo'] = $photo;

                $oldPhoto = $this->find($id)['photo'];

                $path = ROOT . "/public/assets/img/uploads/{$oldPhoto}";

                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

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

    public function runMigration()
    {
        try {
            $conn = "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']}:{$_ENV['DB_PORT']}";
            $tempDb = new PDO($conn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $tempDb->exec("DROP DATABASE IF EXISTS {$_ENV['DB_NAME']}");
            $tempDb->exec("CREATE DATABASE {$_ENV['DB_NAME']}");
            $tempDb = null;

            $this->db->exec("USE {$_ENV['DB_NAME']}");

            $sql = file_get_contents(__DIR__ . "/../../database/{$_ENV['DB_NAME']}.sql");
            $this->db->exec($sql);
            echo "db migrate succesfully!<br>
                <a href=" . '"' . BASEURL . '/user"' . "><- Back</a>";
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
