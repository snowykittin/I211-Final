<?php

class RegisterModel
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function registerUser($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $params = array(
            ':name' => $name,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        );

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
