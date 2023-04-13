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
        <div class="user-actions">
            <!--                    ADD NAVIGATION -->
            <?php
//                check if logged in
            if(isset($_SESSION['member-id'])){
                echo "<a href='" . BASE_URL . "/user/edit'>EDIT</a>
                       <a href='". BASE_URL ."/user/delete'>DELETE</a>";
            }else{
                echo "<a href='" . BASE_URL . "/user/login'>LOGIN</a>
            <a href='" . BASE_URL . "/user/register'>REGISTER</a>";
            }

            ?>
        </div>

        <?php
    }

    public static function displayFooter()
    {
        parent::displayFooter();
    }
}
