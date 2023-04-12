<?php


class UserDetail extends UserIndexView
{
    public function display($user_id, $user, $confirm = "")
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // grabs user id for check
        $id = $user->getId();

        // retrieves the user_id (of the logged in user)
        if (isset($_SESSION['user_id'])) {
            $Adminid = $_SESSION['user_id'];
        } else {
            $Adminid = NULL;
        }
        if (isset($_SESSION['role'])) {
            $LOGGEDROLE = $_SESSION['role'];
        }

        // matches the ids and if they match display the approiate page title
        try {
            if ($Adminid === $id) {
                $pageTitle = 'Account Details';
            } else {
                $pageTitle = 'ALERT: MANIPULATION ERROR';
            }
            if ($Adminid === NULL) {
                throw new UserIssueException("<p><strong>" . "WARNING WARNING WARNING" . "<br><br>" . "YOU ARE NOT THIS USER" . "<br><br>" . "PLEASE CONTACT SERVER ADMIN IF PROBLEM CONTINUES" . "</strong></p>");
            }
        } catch (UserIssueException $e) {
            $view = new UserController();
            $view->manierror($e->getMessage());
            return false;
        }

        //display page header
        parent::displayHeader($pageTitle);

        //retrieve user details by calling get methods
        $id = $user->getId();
        $username = $user->getUsername();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        $role = $user->getRole();

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

            // commented out because it caused issues on pages where it reset when it shouldn't
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

        //if block to determine if the user is an admin or not
        // based on that, determine if it blocks the user from changing the base url
        ?>

        <!--<div id="main-header">User Details</div>-->
        <br><br><br><br>
        <!-- display user details in a table -->
        <table id="menu-detail">
            <tr class="detail-labels">
                <th>Username:</th>
                <th>First Name:</th>
                <th>Last Name:</th>
                <th>Email:</th>
            </tr>
            <tr class="detail-info">
                <td><?= $username ?></td>
                <td><?= $firstname ?></td>
                <td><?= $lastname ?></td>
                <td><?= $email ?></td>
            </tr>
        </table>
        <div id="confirm-message"><?= $confirm ?></div>
        <div id="button-group">
            <input class="edit-buttons" type="button" id="edit-button" value="   Edit   "
                   onclick="window.location.href = '<?= BASE_URL ?>/user/edit/<?= $id ?>'">&nbsp;

            <input class="edit-buttons" type="button" id="delete-button" value="   Delete Account   "
                   onclick="window.location.href = '<?= BASE_URL ?>/user/deleteDisplay/<?= $id ?>'">

            <input class="edit-buttons" type="button" id="trans-button" value=" Past Transactions "
                   onclick="window.location.href = '<?= BASE_URL ?>/cart/pastTransactions/'">

            <!--The point of the if condition here is to prevent php interpreting an Admin user
            logging out another user, that isn't logged in.. So if I was on TestUser4 and hit 'logout' it doesn't
            log out 'testUser4', rather it logs out the admin:

            ADMIN logout === ADMIN LOGOUT
            Logout === standard logout feature
            -->
            <?php if ($role == 1) { ?>
                <input class="edit-buttons" type="button" id="cancel-button" value="  ADMIN Logout  "
                       onclick="window.location.href = '<?= BASE_URL ?>/user/logout/<?= $CurrentAdmin ?>'">
            <?php } else { ?>
                <input class="edit-buttons" type="button" id="cancel-button" value="  Logout  "
                       onclick="window.location.href = '<?= BASE_URL ?>/user/logout/<?= $id ?>'">

            <?php } ?>

            <?php
            // admin users have a role or security access of 1
            if ($role == 1) { ?>
                <!--- IF ADMIN IS LOGGED IN DISPLAY USER DETAILS PAGE BUTTON-->
                <input class="edit-buttons" type="button" id="userDetails-button" value="  User Accounts  "
                       onclick="window.location.href = '<?= BASE_URL ?>/user/index/'">

            <?php } ?>


        </div>

        <div id="confirm-message"><?= $confirm ?></div>
        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}