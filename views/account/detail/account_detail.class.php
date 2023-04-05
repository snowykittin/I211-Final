<?php

class AccountDetail extends IndexView
{
    public function display($account){
    //display page header
    parent::displayHeader("Infinibank - Account Details");

    $account_id = $account->getId();
    $account_type = $account->getAccountType();
    $balance = $account->getCurrencySymbol() . $account->getValue();

    ?>

        <div class="title">
            <h1><?php echo $account_type ?> Account Overview</h1>
            <?php echo "Current Balance: ". $balance ?>
        </div>

        <div class="account-details">
            TODO: Add details for the account.
        </div>

    <?php
        parent::displayFooter();
    }
}