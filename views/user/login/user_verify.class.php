<?php


class UserVerify extends UserIndexView
{
    public function display($message)
    {
        //display page header
        parent::displayHeader("Verify");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // set the login status (default is to show the login form)
        $login_status = 2;

        //obtain user id session variable
        if (isset($_SESSION['member_id'])) {
            $id = $_SESSION['member_id'];
        }

        ?>
        <!--<div id="main-header">Login</div>-->

        <!-- display user  details in a form -->
        <br><br><br><br>

        <div style="border: 1px solid black; margin: auto; padding: 10px; text-align: center; background-color: rgba(255, 215, 0, 0.85)">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
            echo '<strong>' . $message . '</strong><br>';
            ?>
            <div id="button-group">
                <input class="edit-buttons" type="button" value="Home"
                       onclick='window.location.href = "<?= BASE_URL . "/views/index/" ?>"'>

                <input class="edit-buttons" type="button" value="Home"
                       onclick='window.location.href = "<?= BASE_URL ?>"'>

                <input class="edit-buttons" type="button" value="Members"
                       onclick="window.location.href = '<?= BASE_URL ?>/user/detail/<?= $id ?>'">

            </div>
        </div>

        <br><br>

        <?php
        //display page footer
        parent::displayFooter();
    }
}