<?php


class UserNonVerify extends UserIndexView
{

    //put your code here
    public function display($message)
    {
        //display page header
        parent::displayHeader("Verification Error");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }
        if (isset($_SESSION['attempted_username'])) {
            $username = $_SESSION['attempted_username'];
        }
        if (isset($_SESSION['attempted_password'])) {
            $password = $_SESSION['attempted_password'];
        }

        ?>
        <br><br><br><br>
        <div class="login-issue"
             style="border: 1px solid #bbb; margin: auto; padding: 10px; text-align: center; background-color: rgba(255, 215, 0, 0.85)">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php

            // display the attempted login information to the user, therefore they know what they typed.
            echo '<p><strong>' . $message . '</strong></p>';
            echo '<p><strong>' . 'Your entered username: ' . '<div style="color: red">' . $username . '</div></strong></p>';
            echo '<p><strong>' . 'Your entered password: ' . '<div style="color: red">' . $password . '</div></strong></p>';
            echo '<p style="font-style: italic"><strong>' . 'If you have not registered, please do so by clicking the: Register an Account button.' . '</strong></p>';

            // if information entered wrong is TRUE
            session_destroy();
            ?>
            <div id="button-group">
                <input class="edit-buttons" type="button" value="Register an Account"
                       onclick='window.location.href = "<?= BASE_URL . "/user/register/" ?>"'>
                <input class="edit-buttons" type="button" value="Back to Login Page"
                       onclick='window.location.href = "<?= BASE_URL . "/user/login/" ?>"'>
            </div>
        </div>
        <br>
        <?php
        //display page footer
        parent::displayFooter();

        //after page is viewed
    }
}