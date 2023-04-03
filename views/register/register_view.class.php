<?php

class RegisterView extends IndexView
{
    public function output() {
        include 'templates/header.php';
        include 'templates/navbar.php';
        include 'templates/register_form.php';
        include 'templates/footer.php';
    }

    public function getError() {
        return $this->error;
    }

    public function getSuccess() {
        return $this->success;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setError($error) {
        $this->error = $error;
    }

    public function setSuccess($success) {
        $this->success = $success;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}
