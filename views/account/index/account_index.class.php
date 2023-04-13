<?php

class AccountIndex extends IndexView
{
    public function display($accounts, $make_account){
        parent::displayHeader("Infinibank - Account Summary");
        ?>

        <div class="title">
            <h1>Showing All Accounts</h1>
        </div>
        <div class="accounts-container">
            <table>
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 20%;">Account Type</th>
                    <th style="width: 50%;">Balance</th>
                    <th class="acctSearch">
                        <form method="get" action="<?= BASE_URL ?>/account/search_accounts">
                        <input type="text" placeholder="Search accounts..." name="query-terms" id="accountsearchbox" />
                        <input type="submit" value="Search" />
                        </form>
                    </th>
                </tr>
            <?php
                if($accounts === 0){
                    echo "Sorry, no accounts have been found.";
                }
                else{
                    foreach($accounts as $i => $account){
                        $id = $account->getId();
                        $account_type = $account->getAccountType();
                        $currency_symbol = $account->getCurrencySymbol();
                        $balance = $account->getValue();
                        echo "<tr>";
                        echo "<td>", $id, "</td>";
                        echo "<td>", $account_type, "</td>";
                        echo "<td>", $currency_symbol . $balance, "</td>";
                        echo "<td style='text-align: right;'><a href='".BASE_URL."/account/details/$id'>View Details</a></td>";

                        echo "</tr>";
                    }

                }

            ?>
            </table>

<!--            ADMIN VIEW ONLY -->
            <?php
                if($make_account == "true"){
                    echo "<div class='actions'>";
                    echo  "<a href='". BASE_URL . "/account/new_account'><button>New Account</button></a>";
                    echo "</div>";
                }else{

                }

            ?>
        </div>

        <?php
        parent::displayFooter();
    }


}