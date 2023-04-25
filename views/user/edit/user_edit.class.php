<?php


class UserEditView extends IndexView
{

    //put your code here
    public function display($user)
    {
        //display page header
        parent::displayHeader("Edit Details - Infinibank");
        ?>
        <div class="title">
            <h1>Edit Account Details</h1>
        </div>

        <!-- display the user information register in a form -->
        <div class="register-form">
            <form action='<?= BASE_URL . "/user/confirm_edit/" ?>' method="post">


                <label for="firstname">First Name:</label>
                <input name="firstname" type="text" value="<?= $user->getFirstname() ?>">
                <label for="lastname">Last Name:</label>
                <input name="lastname" type="text" placeholder="last name"
                       value="<?= $user->getLastname() ?>">
                <label for="email">Email:</label>
                <input name="email" type="email" placeholder="exampleaddress@iu.edu"
                       value="<?= $user->getEmail() ?>">
                <label for="password">Password:</label>
                <input name="password" type="password" placeholder="password"
                       value="<?= $user->getPassword() ?>">
                <label for="home_address">Address:</label>
                <input name="home_address" type="text" placeholder="123 John St."
                       value="<?= $user->getHomeAddress() ?>">
                <label for="city">City:</label>
                <input name="city" type="text" value="<?= $user->getCity() ?>" id="cityInputBox" onkeyup="registerCityKeyUp(event)">
                <div id="citySuggestionBox"></div>

                <label for="state">State:</label>
                <input name="state" type="text" placeholder="IN"
                       value="<?= $user->getState() ?>" id="stateInputBox">
                <label for="zip">Zip Code:</label>
                <input name="zip" type="number" step="1" value="<?= $user->getZip() ?>">
                <label for="country">Country:</label>
                <input name="country" type="text" value="<?= $user->getCountry() ?>" id="countryInputBox">

                <div class="form-row">
                    <input style="cursor:pointer;" type="submit" name="action" value="Edit">
                    <input style="cursor:pointer;" type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL ?>/user/detail"'>
                </div>
        </div>
        </form>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }
//end of display method
}