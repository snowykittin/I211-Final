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
                    <div class="tab-navs">
                    <button class="tab-nav-item" onclick="openTab('Transactions')">Transactions</button>
                    <button class="tab-nav-item" onclick="openTab('Details')">Account Details</button>
                    </div>
                    <div class="tab-search">
                        <form method="get" action="<?= BASE_URL ?>/account/search_transactions">
                            <input type="text" placeholder="Search transactions..." name="query-terms" id="transactionsearchbox" />
                            <input type="hidden" name="acct-id" value="<?= $account_id ?>" />
                            <input type="submit" value="Search" />
                        </form>
                    </div>
                </div>

                <div id="Transactions" class="tab-container tab">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                        <?php
                            if($transactions === 0){
                                echo "<tr><td colspan='5'>No transactions exist at this time.</td></tr>";
                            }
                            else{
                                foreach($transactions as $i => $transaction){
                                    $id = $transaction->getId();
                                    $date = $transaction->getTransactionDate();
                                    $type = $transaction->getTransactionType();
                                    $amount = $account->getCurrencySymbol() . $transaction->getAmount();
                                    $description = $transaction->getDescription();
                                    echo "<tr>";
                                    echo "<td>", $id, "</td>";
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

            <div class="actions">
                <a href="<?= BASE_URL ?>/account/make_transaction/<?= $account_id ?>"><button>Make a Transaction</button></a>
            </div>
        </div>

    <?php
        parent::displayFooter();
    }
}