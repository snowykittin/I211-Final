<?php


class RegisterController
{
    private $model;

    public function __construct()
    {
        $this->model = RegisterModel::getRegisterModel();
    }

    public function registerUser()
    {
        $error = '';
        $success = '';
        $name = '';
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($name) || empty($email) || empty($password)) {
                $error = 'Please fill in all fields.';
            } else {
                $result = $this->model->registerUser($name, $email, $password);
                if ($result) {
                    $success = 'Registration successful.';
                    $name = '';
                    $email = '';
                    $password = '';
                } else {
                    $error = 'Registration failed. Please try again.';
                }
            }
        }

        require_once('views/register/register_view.class.php');
    }
}
