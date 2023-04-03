<?php

class LoginView
{
    public function output($error = '', $success = '', $email = '', $password = '')
    {
        include('templates/header.php');
        include('templates/navbar.php');
        include('templates/login_form.php');
        include('templates/footer.php');
    }
}
