<?php

class RegisterSuccessView extends IndexView
{

    public function display(){

        //display page header
        parent::displayHeader("Registration Success - Infinibank");
        ?>

        <div class="title">
            <h1>Success!</h1>
            <p>Your account has been registered. Please contact an admin to open your first bank account.</p>
        </div>

        <?php
        //display page footer
        parent::displayFooter();
    }
}
