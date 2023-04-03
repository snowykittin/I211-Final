<?php

class LoginController
{
    private $model;

    public function __construct(LoginModel $model)
    {
        $this->model = $model;
    }

    public function loginUser()
    {
        $error = '';
        $success = '';
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                $error = 'Please fill in all fields.';
            } else {
                $result = $this->model->loginUser($email, $password);
                if ($result) {
                    $success = 'Login successful.';
                    // redirect to the dashboard page or wherever you want to go
                } else {
                    $error = 'Invalid email or password. Please try again.';
                }
            }
        }

        $view = new LoginView();
        $view->output($error, $success, $email, $password);
    }
}
