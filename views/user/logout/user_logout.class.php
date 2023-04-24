<?php


class UserLogout extends UserIndexView
{
    //put your code here
    public function display()
    {
        parent::displayHeader("Logout");


        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // echo $login_status;
        if (!isset($_SESSION['login_status'])) {
            $deleteCART = TRUE;
        } else {
            $deleteCART = FALSE;
        }
        // need a php session that would hold the cart data
        if ($deleteCART === TRUE) {
            $host = "localhost";
            $login = "phpuser";
            $password = "phpuser";
            $database = "infinibank_db";

            $conn = @ new mysqli($host, $login, $password, $database);

            if ($conn->connect_errno) {
                $error = $conn->connect_error;
                exit();
            }

            $stmt = $conn->prepare('DELETE FROM cart');
            $stmt->execute();
        }
        $_SESSION = array();
        setcookie(session_name(), "", time() - 3600);

        session_destroy();

        ?>
        <br><br><br><br>
        <div id="menu-detail">
            <fieldset id="edit-fieldset">
                <legend>You have been logged out!</legend>
                <h3>
                    <span style="background: linear-gradient(to right, #ef5350, #f48fb1, #7e57c2, #2196f3, #26c6da, #43a047, #eeff41, #f9a825, #ff5722)"
                          class="logout">Thank you for your visit...</span></h3>
                <h3>We hope you found our website enjoyable! Please come again!</h3>
            </fieldset>
        </div>

        <div id="button-group">
            <input class="edit-buttons" type="button" value=" Homepage "
                   onclick='window.location.href = "<?= BASE_URL ?>"'>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }
}