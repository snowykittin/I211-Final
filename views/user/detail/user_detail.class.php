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
        <div class="member-details">
            <div class="personal-details">
                <h4>Personal Details</h4>
                <p>
                    <strong>Name:</strong> <?= $name ?>
                </p>
                <p>
                    <strong>Email:</strong> <?= $email ?>
                </p>
            </div>
            <div class="mailing-details">
                <h4>Mailing Details</h4>
                <p>
                    <strong>Address:</strong> <?= $street_address ?>
                </p>
                <p>
                    <?= $location ?>
                </p>
            </div>
        </div>

        <div class="actions">
            <a href="<?= BASE_URL ?>/user/edit"><button>Edit Details</button></a>
        </div>


        <div class="bottom-banner">

        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}