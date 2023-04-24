<?php

class UserLogin extends UserIndexView
{
    public function display()
    {
        // Display page header
        parent::displayHeader("Login");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['login_status'])) {
            $login_status = 2;
        } else {
            $login_status = $_SESSION['login_status'];
        }

        if ($login_status == 2) {
            $this->displayLoginForm();
        }

        // Add other cases for login_status if needed

        parent::displayFooter();
    }

    private function displayLoginForm()
    {
        ?>
        <div class="title">
            <h1>Login</h1>
        </div>
        <div class="register-form">
                    <form action="<?= BASE_URL ?>/user/verify/" method="post">
                            <label for="username">Email:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>

                        <div class="form-row">
                            <input style="cursor:pointer;" type="submit" name="action" value="Login">
                            <input style="cursor:pointer;" type="button" value="Register" onclick='window.location.href = "<?= BASE_URL ?>/user/register"'>
                        </div>
                    </form>
        </div>
        <?php
    }
}

?>
