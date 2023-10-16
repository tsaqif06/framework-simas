<?php

namespace FrameworkSimas\Model;

use PDO;
use FrameworkSimas\Config\Model;

class User extends Model
{
    protected $table = "users";

    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->bindParam(":email", $email);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
