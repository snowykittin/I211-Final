<?php

class RegisterModel
{
    private $db;
    private $dbConnection;
    static private $_instance = NULL;

    public function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }


    public function registerUser($name, $email, $password)
    {
        $sql = "INSERT INTO members (name, email, password) VALUES (:name, :email, :password)";
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

    public static function getRegisterModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new RegisterModel();
        }
        return self::$_instance;
    }
}
