<?php

namespace FrameworkSimas\Config;

use PDO;

class Model
{
    protected $db, $table, $conditions = [];

    public function __construct()
    {
        $conn = "{$_ENV['DB_DRIVER']}:host={$_ENV['DB_HOST']}:{$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}";
        $this->db = new PDO($conn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
    }

    public function all()
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE deleted_at IS NULL");
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!isWebRequest()) {
            if (!$data) {
                return [
                    'success' => false,
                    'message' => "Internal server error",
                    'data' => false,
                    'status' => 500,
                ];
            }

            return [
                'success' => true,
                'message' => "Success fetching data",
                'data' => $data,
                'status' => 200,
            ];
        }

        return $data;
    }

    public function find($key, $val, $isApi = false)
    {
        if (!$key || !$val) {
            return [
                'success' => false,
                'message' => "Internal server error",
                'data' => false,
                'status' => 500,
            ];
        }

        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$key} = :val");
        $stmt->bindParam(":val", $val);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!isWebRequest()) {
            if ($isApi) {
                if (!$data) {
                    return [
                        'success' => false,
                        'message' => "Data not found",
                        'data' => false,
                        'status' => 400,
                    ];
                }

                return [
                    'success' => true,
                    'message' => "Success fetching data",
                    'data' => $data,
                    'status' => 200,
                ];
            }
        }

        return $data;
    }

    public function create($data = [], $imagePath = "/public/assets/img/uploads")
    {
        $keyName = "photo";

        unset($data['_csrf']);

        if (isset($_FILES[$keyName]) && ($_FILES[$keyName]['error'] !== 4 || $_FILES[$keyName]['tmp_name'] !== '')) {
            $photo = $this->uploadImage($keyName, $imagePath);
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


        if ($stmt->rowCount() == 0) {
            $this->conditions = [];

            return [
                'success' => false,
                'errorInfo' => $stmt->errorInfo(),
                'data' => false,
            ];
        }

        return [
            'success' => true,
            'data' => $this->find('id', $this->db->lastInsertId()),
        ];
    }

    public function uploadImage($key, $imagePath = "/public/assets/img/uploads")
    {
        if ($_FILES[$key]['error'] == 4) {
            return;
        }

        $targetDir = ROOT . "{$imagePath}/";
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

    public function where($field, $operator, $value)
    {
        $this->conditions[$field] = [$operator, $value];
        return $this;
    }

    public function update($data = [], $imagePath = "/public/assets/img/uploads")
    {
        $keyName = "photo";

        unset($data['_csrf']);

        if (isset($_FILES[$keyName]) && ($_FILES[$keyName]['error'] !== 4 || $_FILES[$keyName]['tmp_name'] !== '')) {
            $photo = $this->uploadImage($keyName, $imagePath);
            if ($photo == 0) {
                return 0;
            } else {
                $data['photo'] = $photo;

                $oldPhoto = $this->find('id', $this->conditions['id'][1])['photo'];

                $path = ROOT . "{$imagePath}/{$oldPhoto}";

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

        $whereConditions = [];
        foreach ($this->conditions as $field => $condition) {
            $whereConditions[] = "$field {$condition[0]} :{$field}_value";
        }
        $whereString = implode(' AND ', $whereConditions);

        $stmt = $this->db->prepare("UPDATE {$this->table} SET $updateString WHERE $whereString");

        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $data[$key]);
        }

        foreach ($this->conditions as $field => $condition) {
            $stmt->bindParam(":{$field}_value", $condition[1]);
        }

        $stmt->execute();


        if ($stmt->rowCount() == 0) {
            $this->conditions = [];

            return [
                'success' => false,
                'errorInfo' => $stmt->errorInfo(),
                'data' => false,
            ];
        }

        return [
            'success' => true,
            'data' => $this->find('id', $this->conditions['id'][1]),
        ];
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET deleted_at = CURRENT_TIMESTAMP WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $this->conditions = [];

            return [
                'success' => false,
                'errorInfo' => $stmt->errorInfo(),
            ];
        }

        return [
            'success' => true,
            'message' => "delete successfully",
        ];
    }

    public function deletePermanent($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $this->conditions = [];

            return [
                'success' => false,
                'errorInfo' => $stmt->errorInfo(),
            ];
        }

        return [
            'success' => true,
            'message' => "delete successfully",
        ];
    }
}
