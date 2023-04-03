<?php

class LoginModel
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function loginUser($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $params = array(':email' => $email);

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // valid credentials
                // you can store user info in a session here if you want to
                return true;
            } else {
                // invalid credentials
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
