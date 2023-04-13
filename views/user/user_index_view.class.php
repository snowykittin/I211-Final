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
            <a href="<?= BASE_URL ?>/user/login" style="color:black;">LOGIN</a>
            <a href="<?= BASE_URL ?>/user/register" style="color:black;">REGISTER</a>
            <a href="<?= BASE_URL ?>/user/edit" style="color:black;">EDIT</a>
            <a href="<?= BASE_URL ?>/user/delete" style="color:black;">DELETE</a>


        </nav>

        <?php
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }
}
