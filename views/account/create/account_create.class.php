<?php

class AccountCreate extends IndexView
{
    public function display($types, $currencies){
        parent::displayHeader("Infinibank - New Account");
        ?>

        <div class="title">
            <h1>Create a Bank Account</h1>
        </div>

        <div class="create-account-form">
            <form action="<?= BASE_URL ?>/account/create" method="post">
                <label for="member_no">Member Number:</label>
                <input name="member_no" type="number">

                <label for="account_type">Account Type:</label>
                <select id="account_type" name="account_type">
                    <!-- PHP TO LOOP THROUGH TYPES HERE -->
                    <?php
                        foreach($types as $i => $type){
                            $idType = $type->getId();
                            $nameType = $type->getName();
                            echo "<option value='$idType'>$nameType</option>";
                        }

                    ?>
                </select>

                <label for="currency_type">Currency Type:</label>
                <select id="currency_type" name="currency_type">
                    <!-- PHP TO LOOP THROUGH TYPES HERE -->
                    <?php
                    foreach($currencies as $i => $currency){
                        $id = $currency->getId();
                        $name = $currency->getName();
                        echo "<option value='$id'>$name</option>";
                    }

                    ?>
                </select>

                <div class="form-row">
                    <input type="submit" name="action" value="Create Account">
                    <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL ?>/account"'>
                </div>
            </form>
        </div>

        <?php
        parent::displayFooter();
    }


}