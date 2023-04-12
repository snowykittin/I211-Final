<?php


class UserError extends UserIndexView
{
    public function display($message)
    {
        // header
        parent::displayHeader("Error");
        ?>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            $Adminid = $_SESSION['user_id'];
            $result = TRUE;
        } else {
            $Adminid = NULL;
            $result = FALSE;
        }

        ?>
        <br><br><br><br>
        <div class="menu-error-msg">
            <h1>An Error has Occurred.</h1>
            <h3><?= urldecode($message) ?></h3>
        </div>

        <br><br>
        <div id="button-group">
            <?php if ($result == TRUE) { ?>
                <input class="edit-buttons" type="button" value=" BACK TO DELETE "
                       onclick="window.location.href='<?= BASE_URL ?>/user/deleteDisplay/<?= $Adminid ?>'">

            <?php } ?>
            <input class="edit-buttons" type="button" value=" Retry Login  "
                   onclick="window.location.href='<?= BASE_URL ?>/user/login'">
            <input class="edit-buttons" type="button" value="  Register  "
                   onclick="window.location.href='<?= BASE_URL ?>/user/register'">
        </div>
        <br><br>

        <?php
        //display page footer
        parent::displayFooter();
    }

}