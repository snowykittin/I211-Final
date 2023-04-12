<?php


class UserDelete extends UserIndexView
{
    public function display($user, $confirm = "")
    {
        //display page header
        parent::displayHeader("DELETE ACCOUNT");

        //retrieve user details by calling get methods
        $id = $user->getId();
        $username = $user->getUsername();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        $role = $user->getRole();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            $Adminid = $_SESSION['user_id'];
        } else {
            $Adminid = NULL;
        }

        try {
            if ($Adminid === NULL) {
                throw new UserIssueException("<p><strong>" . "WARNING WARNING WARNING" . "<br><br>" . "YOU ARE NOT THIS USER" . "<br><br>" . "PLEASE CONTACT SERVER ADMIN IF PROBLEM CONTINUES" . "</strong></p>");
            }
        } catch (UserIssueException $e) {
            $view = new UserController();
            $view->manierror($e->getMessage());
            return false;
        }

        if (isset($_SESSION['role'])) {
            $LOGGEDROLE = $_SESSION['role'];
        }

        $CurrentAdmin = $Adminid;

        // logged role is the current role for the user. This prevents users from attacking other accounts
        echo $LOGGEDROLE;
        if ($LOGGEDROLE == 1) {
            // The entire block here, is so that if a user somehow does get pass the restrict, it finds it
            // and returns null and unsets the id if not true.
            // if an admin gets on this page, it doesn't do anything.
            $ROLEONE = $CurrentAdmin;
            $_SESSION['ADMINLOG'] = $ROLEONE;

            echo $LOGGEDROLE;

            /*if ($Adminid != $id) {
                unset($_SESSION['role']);
            }*/
        } else {
            try {
                if ($Adminid != $id) {
                    throw new UserIssueException("<p><strong>" . "WARNING WARNING WARNING" . "<br><br>" . "YOU ARE NOT THIS USER" . "<br><br>" . "PLEASE CONTACT SERVER ADMIN IF PROBLEM CONTINUES" . "</strong></p>");
                }
            } catch (UserIssueException $e) {
                $view = new UserController();
                $view->manierror($e->getMessage());
                return false;
            }
        }
        ?>

        <br><br><br><br>
        <div id="edit-form">
            <fieldset id="edit-fieldset">
                <legend>Delete Account</legend>


                <label class="edit-left">Username: </label>
                <p id="Username" class="edit-right"><?= $username ?></p>

                <br>

                <label class="edit-left">First Name: </label>
                <p id="firstName" class="edit-right"><?= $firstname ?></p>

                <br>

                <label class="edit-left">Last Name: </label>
                <p id="lastName" class="edit-right"><?= $lastname ?></p>

                <br>

                <label class="edit-left">Email: </label>
                <p id="email" class="edit-right"><?= $email ?></p>

                <br>
            </fieldset>

            <br><br>

            <form action="<?= BASE_URL ?>/user/delete" method="post">
                <div id="button-group">
                    <label><strong>Type YES:</strong></label>
                    <input class="edit-buttons" type="text" name="confirm" required size="10">
                    <input class="edit-buttons" type="submit" value=" DELETE ACCOUNT ">
                    <input class="edit-buttons" type="button" id="cancel-button" value="   Cancel   "
                           onclick="window.location.href = '<?= BASE_URL ?>/user/detail/<?= $CurrentAdmin ?>'">&nbsp;
                </div>
            </form>
        </div>
        <?php
        ?>
        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}