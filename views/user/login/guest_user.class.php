<?php


class GuestUser extends UserIndexView
{
    public function display()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['login_status'])) {
            $_SESSION['login_status'] = 4;
        }


        parent::displayHeader("Continue as a Guest");
        ?>
        <br><br><br><br>
        <div id="menu-detail">
            <fieldset id="edit-fieldset">
                <legend>Welcome Guest User!</legend>

                <h2>You are currently using a Guest Account!</h2>

                <h3>With a guest account you can shop like normal, but don't have access to the user actions. <br>
                    To obtain user actions please register an account down below. If you meant to log in, <br>
                    press the 'login' button down below. Guests can view and create orders! </h3>

                <h2><span style="color: red"><strong>As a guest, your transactions will not be stored: Please register to save account data and transaction data!!</strong></span>
                </h2>

                <br>

                <div id="button-group">
                    <input class="edit-buttons" type="button" value=" Register an Account"
                           onclick='window.location.href = "<?= BASE_URL . "/user/register/" ?>"'>


                    <input class="edit-buttons" type='button' value='View Menu'
                           onclick='window.location.href = "<?= BASE_URL . "/menu/index/" ?>"'>


                    <input class="edit-buttons" type='button' value='Login'
                           onclick='window.location.href = "<?= BASE_URL . "/user/login/" ?>"'>


                </div>

            </fieldset>
        </div>
        <br>
        <?php
        parent::displayFooter();
    }
}