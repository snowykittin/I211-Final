<?php

class AccountIndex extends IndexView
{
    public function display($accounts){
        parent::displayHeader("Infinibank - Account Summary");
        ?>

        <div class="title">
            <h1>Showing All Accounts</h1>
        </div>
        <div class="accounts-container">
            <table>
                <tr>
                    <th>Account Type</th>
                    <th>Balance</th>
                    <th>Transactions</th>
                </tr>
            <?php
                if($accounts === 0){
                    echo "Sorry, no accounts have been found.";
                }
                else{
                    foreach($accounts as $i => $account){
                        $id = $account->getId();
                        $account_type = $account->getAccountType();
                        $currency_type = $account->getCurrencyType();
                        $balance = $account->getValue();
                        echo "<tr>";
                        echo "<td>", $account_type, "</td>";
                        echo "<td>", $currency_type . $balance, "</td>";
                        echo "<td>View All</td>";

                        echo "</tr>";
                    }

                }

            ?>
            </table>

            <div class="actions">
                <button>New Account</button>
                <button>eDeposit</button>
                <button>Transfer</button>
            </div>
        </div>

        <?php
        parent::displayFooter();
    }


}