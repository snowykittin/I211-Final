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
        <nav>
            <!--                    ADD NAVIGATION -->
            <a href="<?= BASE_URL ?>/user/login">LOGIN</a>
            <a href="<?= BASE_URL ?>/user/register">REGISTER</a>
            <a href="<?= BASE_URL ?>/user/edit">EDIT</a>
            <a href="<?= BASE_URL ?>/user/delete">DELETE</a>


        </nav>

        <?php
        echo "Please display SOMETHING";
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }
}
