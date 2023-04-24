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
                        <form id="transaction-search-form">
                            <input type="text" placeholder="Search transactions..." name="query-terms" id="transactionsearchbox" />
                            <input type="hidden" name="acct-id" value="<?= $account_id ?>" />
                            <button type="submit">Search</button>
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
?>
<!-- Add this script tag inside your HTML head tag or before the closing body tag -->
<script>
    function openTab(tabName) {
        const tabContainers = document.getElementsByClassName("tab-container");

        for (let i = 0; i < tabContainers.length; i++) {
            tabContainers[i].style.display = "none";
        }

        document.getElementById(tabName).style.display = "block";
    }

    function searchTransactions(event) {
        event.preventDefault();

        const queryTerms = document.getElementById('transactionsearchbox').value;
        const accountId = document.getElementsByName('acct-id')[0].value;
        const xhr = new XMLHttpRequest();

        xhr.open('GET', `<?= BASE_URL ?>/account/search_transactions?query-terms=${queryTerms}&acct-id=${accountId}`, true);
        xhr.onload = function() {
            if (this.status == 200) {
                const transactions = JSON.parse(this.responseText);
                let output = '';

                if (transactions.length === 0) {
                    output = "<tr><td colspan='5'>No transactions found.</td></tr>";
                } else {
                    transactions.forEach(transaction => {
                        output += `<tr>
                        <td>${transaction.id}</td>
                        <td>${transaction.date}</td>
                        <td>${transaction.amount}</td>
                        <td>${transaction.type}</td>
                        <td>${transaction.description}</td>
                    </tr>`;
                    });
                }

                document.querySelector('#Transactions table').innerHTML = output;
            }
        };

        xhr.send();
    }

    // Add this script to the end of your HTML file or inside a DOMContentLoaded event listener
    document.getElementById('transaction-search-form').addEventListener('submit', searchTransactions);
</script>
