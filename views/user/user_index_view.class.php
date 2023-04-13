<?php

class UserIndexView extends IndexView
{
    public static function displayHeader($title)
    {
        parent::displayHeader($title);
        ?>
        <script>

            //the media type
            var media = "users";
        </script>
        <form>
            <label>Please log in or register to access the page:</label><br><br>
            <a href="user_login.class.php">Log In</a><br><br>
            <a href="register.php">Register</a><br><br>
        </form>

        <?php
        echo "Please display SOMETHING";
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }
}
