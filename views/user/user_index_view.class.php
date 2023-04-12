<?php


class UserIndexView extends IndexView
{
    public static function displayHeader($title)
    {
        parent::displayHeader($title)
        ?>
        <script>
            //the media type
            var media = "users";
        </script>
        <?php
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }
}