<?php


class UserLogin extends UserIndexView
{
    public function display()
    {
        //display page header
        parent::displayHeader("Login");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //   echo $_SESSION['login_status'];

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
            $database = "lewies";

            $conn = @ new mysqli($host, $login, $password, $database);

            if ($conn->connect_errno) {
                $error = $conn->connect_error;
                exit();
            }

            $stmt = $conn->prepare('DELETE FROM cart');
            $stmt->execute();
        }

        //login - status session var
        if (isset($_SESSION['login_status'])) {
            $login_status = $_SESSION['login_status'];
        }else{
            $login_status = 2;
        }

        //obtain user id session variable
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
        }

        if (isset($_SESSION['attempted_username'])) {
            $_SESSION['attempted_username'] = ' ';
        }
        if (isset($_SESSION['attempted_password'])) {
            $_SESSION['attempted_password'] = ' ';
        }

        /*************************************************************************************
         *                       settings for login_status                        *
         ************************************************************************************/
        // if login status is set display the user to log out.
        if ($login_status == 1) {
            // session['name'] is the username of the account that is logged in.
            echo "<br><br><br><br><h2 style='text-align: center; background-color: rgba(255, 215, 0, 0.90); padding: 40px 0'><strong>You are logged in as  \"" . $_SESSION['name'] . "\"</strong></h2>";
            ?>
            <div id="button-group">
                <input type="hidden" name="id" value="<?= $id ?>">
                <!-- allow the user to view their details and edit/delete account -->
                <input class="edit-buttons" type="button" value="View Account"
                       onclick="window.location.href = '<?= BASE_URL ?>/user/detail/<?= $id ?>'">
                <input class="edit-buttons" type='button' value='Logout'
                       onclick='window.location.href = "<?= BASE_URL . "/user/logout/" ?>"'>
            </div>
        <?php } ?>

        <!-- Guest Account-->
        <?php if ($login_status == 4) { ?>
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


                    <input name="guest" class="edit-buttons" type='button' value=' Logout as Guest '
                           onclick='window.location.href = "<?= BASE_URL . "/user/logout/" ?>"'>
                </div>

            </fieldset>
        </div>
        <br>
    <?php } ?>
        <?php
        // only display form if login_status is not set
        if ($login_status == 2) {

            ?>
            <!-- display user details in a form -->
            <br><br><br><br><br>
            <form class="login-form" action='<?= BASE_URL . "/user/verify/" ?>' method="post">
                <table id="menu-detail-all">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <tr class="detail-labels">
                        <th><label for="username">Username</label></th>
                        <th><label for="password">Password</label></th>
                    </tr>
                    <tr class="detail-info">
                        <td><input id="username" name="username" type="text" size="50" placeholder="username"
                                   onfocus="this.placeholder = ' '"></td>
                        <td><input id="password" name="password" type="password" size="50" placeholder="password"
                                   onfocus="this.placeholder = ' '"></td>
                    </tr>
                </table>

                <br>

                <div id="button-group">
                    <input class="edit-buttons" type="submit" name="action" value="Login">

                    <input class="edit-buttons" type="button" value="Cancel"
                           onclick='window.location.href = "<?= BASE_URL ?>"'>

                    <input class="edit-buttons" type="button" value="Signup"
                           onclick='window.location.href = "<?= BASE_URL . "/user/register/" ?>"'>

                    <input class="edit-buttons" type="button" value=" Continue as Guest "
                           onclick='window.location.href = "<?= BASE_URL . "/user/guest/" ?>"'>
                </div>
            </form>
            <br>
        <?php } ?>
        <?php
        //display page footer
        parent::displayFooter();
    }
}