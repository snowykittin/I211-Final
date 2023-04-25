<?php


class User
{

    //private data members
    private $id, $firstname, $lastname, $email_address, $password, $home_address, $state, $city, $country, $zip, $role;

    //constructor
    public function __construct($firstname, $lastname, $email_address, $password, $home_address, $city, $state, $zip, $country, $role){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email_address = $email_address;
        $this->password = $password;
        $this->home_address = $home_address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->country = $country;
        $this->role = $role;
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getFirstname()
    {
        return $this->firstname;
    }


    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }


    public function getLastname()
    {
        return $this->lastname;
    }


    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }


    public function getEmail()
    {
        return $this->email_address;
    }


    public function setEmail($email)
    {
        $this->email_address = $email;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getHomeAddress()
    {
        return $this->home_address;
    }


    public function setHomeAddress($home_address)
    {
        $this->home_address = $home_address;
    }


    public function getState()
    {
        return $this->state;
    }


    public function setState($state)
    {
        $this->state = $state;
    }


    public function getCity()
    {
        return $this->city;
    }


    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getZip(){
        return $this->zip;
    }

    public function setZip($zip){
        $this->zip = $zip;
    }

    public function getCountry()
    {
        return $this->country;
    }


    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }




}