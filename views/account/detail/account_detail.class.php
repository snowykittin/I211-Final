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
            <div class="tab-table">
                <div class="tab-navigation">
                    <button class="tab-nav-item" onclick="openTab('Transactions')">Transactions</button>
                    <button class="tab-nav-item" onclick="openTab('Details')">Details</button>
                </div>

                <div id="Transactions" class="tab-container tab">
                    <h2>Transactions</h2>
                    <p>See all of your transactions below.</p>
                </div>

                <div id="Details" class="tab-container tab" style="display:none">
                    <h2>Details</h2>
                    <p>These are the details of your account.</p>
                </div>

            </div>
        </div>

    <?php
        parent::displayFooter();
    }
}