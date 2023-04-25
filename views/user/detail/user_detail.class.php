<?php


class UserDetailView extends IndexView
{
    public function display($user)
    {
        $id = $_SESSION['member-id'];
        $name = $user->getFirstname() . " " . $user->getLastname();
        $email = $user->getEmail();
        $street_address = $user->getHomeAddress();
        $location = $user->getCity() . ", " . $user->getState() . " " . $user->getZip() . " " . $user->getCountry();


        parent::displayHeader("Member Details - Infinibank");
        ?>

       <div class="title">
           <h1>Member Details</h1>
       </div>
        <div>
            <p>
                <?= $name ?>
            </p>
            <p>
                <?= $email ?>
            </p>
            <p>
                <?= $street_address ?>
            </p>
            <p>
                <?= $location ?>
            </p>
        </div>

        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}