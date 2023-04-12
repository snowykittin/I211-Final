<?php


class UserUpdate extends UserIndexView
{
    public function display($message, $id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        }
        parent::displayHeader("User Update Screen");
        ?>

        <br><br><br><br>

        <!-- display user verification message in a div -->
        <div style="border: 1px solid black; margin: auto; padding: 10px; text-align: center; background-color: rgba(255, 215, 0, 0.85)">
            <input type="hidden" name="id" value="<?= $id ?>">
            <?php
            echo '<h2>' . $message . '</h2>';
            if ($role == 1) { ?>
                <!--- IF ADMIN IS LOGGED IN DISPLAY USER DETAILS PAGE BUTTON-->
                <input class="edit-buttons" type="button" id="userDetails-button" value="  Back to Accounts  "
                       onclick="window.location.href = '<?= BASE_URL ?>/user/index/'">

            <?php } else { ?>
                <div id="button-group">
                    <input class="edit-buttons" type="button" value="Back to Account"
                           onclick='window.location.href = "<?= BASE_URL . "/user/detail/$id" ?>"'>
                </div>

            <?php } ?>
        </div>

        <br><br>

        <?php
        parent::displayFooter();
    }
}