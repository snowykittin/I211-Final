<?php


class User
{

    //private data members
    private $id, $username, $password, $firstname, $lastname, $email, $role;

    //the constructor
    public function __construct($id, $username, $password, $firstname, $lastname, $email, $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->role = $role;
    }

    //getters
    function getId()
    {
        return $this->id;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getFirstname()
    {
        return $this->firstname;
    }

    function getLastname()
    {
        return $this->lastname;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getRole()
    {
        return $this->role;
    }

    //setters
    function setId($id)
    {
        $this->id = $id;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setRole($role)
    {
        $this->role = $role;
    }
}