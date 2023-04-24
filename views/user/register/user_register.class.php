<?php


class UserRegister extends IndexView
{

    //put your code here
    public function display()
    {
        //display page header
        parent::displayHeader("Register - Infinibank");
        ?>

        <div class="title">
            <h1>Register</h1>
        </div>

        <!-- display the user information register in a form -->
        <div class="register-form">
            <form action='<?= BASE_URL . "/user/add/" ?>' method="post">


                <label for="firstname">First Name:</label>
                <input name="firstname" type="text" placeholder="first name"
                       onfocus="this.placeholder = ' '">
                <label for="lastname">Last Name:</label>
                <input name="lastname" type="text" placeholder="last name"
                       onfocus="this.placeholder = ' '">
                <label for="email">Email:</label>
                <input name="email" type="email" placeholder="exampleaddress@iu.edu"
                       onfocus="this.placeholder = ' '">
                <label for="password">Password:</label>
                <input name="password" type="text" placeholder="password"
                       onfocus="this.placeholder = ' '">
                <label for="home_address">Address:</label>
                <input name="home_address" type="text" placeholder="123 John St."
                       onfocus="this.placeholder = ' '">
                <label for="city">City:</label>
                <input name="city" type="text" placeholder="Indianapolis"
                       onfocus="this.placeholder = ' '" id="cityInputBox" onkeyup="registerCityKeyUp(event)">
                <div id="citySuggestionBox"></div>

                <label for="state">State:</label>
                <input name="state" type="text" placeholder="IN"
                       onfocus="this.placeholder = ' '" id="stateInputBox">
                <label for="zip">Zip Code:</label>
                <input name="zip" type="number" step="1" placeholder="46202"
                       onfocus="this.placeholder = ' '">
                <label for="country">Country:</label>
                <input name="country" type="text" placeholder="USA"
                       onfocus="this.placeholder = ' '" id="countryInputBox">

                <div class="form-row">
                    <input style="cursor:pointer;" type="submit" name="action" value="Register">
                    <input style="cursor:pointer;" type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL ?>"'>
                </div>
        </div>
        </form>
        </div>
        <?php
        //display page footer
        parent::displayFooter();
    }
}
