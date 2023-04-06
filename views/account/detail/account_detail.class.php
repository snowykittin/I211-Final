<?php

class AccountDetail extends IndexView
{
    public function display($account, $transactions){
    //display page header
    parent::displayHeader("Infinibank - Account Details");

    $account_id = $account->getId();
    $account_type = $account->getAccountType();
    $currency_type = $account->getCurrencyType();
    $balance = $account->getCurrencySymbol() . $account->getValue();

    ?>

        <div class="title">
            <h1><?php echo $account_type ?> Account Information</h1>
            <?php echo "Current Balance: ". $balance ?>
        </div>

        <div class="account-details">
            <div class="tab-table">
                <div class="tab-navigation">
                    <button class="tab-nav-item" onclick="openTab('Transactions')">Transactions</button>
                    <button class="tab-nav-item" onclick="openTab('Details')">Account Details</button>
                </div>

                <div id="Transactions" class="tab-container tab">
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                        <?php
                            if($transactions === 0){
                                echo "<tr><td colspan='4'>No transactions exist at this time.</td></tr>";
                            }
                            else{
                                foreach($transactions as $i => $transaction){
                                    $date = $transaction->getTransactionDate();
                                    $type = $transaction->getTransactionType();
                                    $amount = $transaction->getAmount();
                                    $description = $transaction->getDescription();
                                    echo "<tr>";
                                    echo "<td>", $date, "</td>";
                                    echo "<td>", $amount, "</td>";
                                    echo "<td>", $type, "</td>";
                                    echo "<td>", $description, "</td>";
                                    echo "</tr>";
                                }
                            }

                        ?>
                    </table>
                </div>

                <div id="Details" class="tab-container tab" style="display:none">
                    <h2>Details about your account</h2>
                    <div class="details-info">
                        <p>Account ID: <?php echo $account_id ?></p>
                        <p>Account Type: <?php echo $account_type ?></p>
                        <p>Currency Type: <?php echo $currency_type ?></p>
                        <p>Current Balance: <?php echo $balance ?></p>

                    </div>
                </div>

            </div>
        </div>

    <?php
        parent::displayFooter();
    }
}