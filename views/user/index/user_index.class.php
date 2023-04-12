<?php


class UserIndex extends UserIndexView
{
    /*
     * the display method accepts an array of user objects and displays
     * them in a grid.
     */
    public static function displayHeader($title)
    {
    }

    public function display($users)
    {
        //display page header
        parent::displayHeader("ADMIN: USER ACCOUNTS");

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


        ?>

        <!--Need main header div to 'show' in order to get the fetch in a nice ordered block. just used opacity-->
        <div id="main-header" style="opacity: 0">Known Registered Users</div>
        <div class="grid-container">
            <?php
            if ($users === 0) {
                echo "No user was found.<br><br><br><br><br>";
            } else {
                echo '<br><br>';
                foreach ($users as $i => $user) {
                    $id = $user->getId();
                    $username = $user->getUsername();
                    // $password = $user->getPassword();
                    $firstname = $user->getFirstname();
                    $lastname = $user->getLastname();
                    $email = $user->getEmail();
                    $role = $user->getRole();

                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo " 
               
              <div id='menu-index'>
                    <br>
                    <table id='menu-detail-all'>
                        <tr class='detail-labels-all'>
                            <th>Username:</th>
                            <th>First Name:</th>
                            <th>Last Name:</th>
                            <th>Email:</th>
                            <th>User Role:</th>
                            <th>Edit Account?</th>
                        </tr>
                        <tr class='detail-info-all'>
                            <td>$username</td>
                            <td>$firstname</td>
                            <td>$lastname</td>
                            <td>$email</td>
                            <td>$role</td>
                            <td><strong><a href='", BASE_URL, "/user/detail/$id'>YES</a></strong></td>
                        </tr>          
                    </table>
                </div>
                ";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($users) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>

        <div id="button-group">
            <input class="edit-buttons" type="button" value="Back to Account"
                   onclick='window.location.href = "<?= BASE_URL . "/user/detail/$Adminid" ?>"'>
        </div>


        <?php
    } //end of display method

    public static function displayFooter()
    {
        parent::displayFooter();
    }
}
