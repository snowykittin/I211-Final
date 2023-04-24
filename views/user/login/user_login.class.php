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
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2>Login</h2>
                    <form action="<?= BASE_URL ?>/user/verify/" method="post">
                        <div class="form-group">
                            <label for="username">Email:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}

?>
