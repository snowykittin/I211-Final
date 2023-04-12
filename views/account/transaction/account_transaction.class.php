<?php

class AccountTransaction extends IndexView
{
    public function display($account){
    parent::displayHeader("Infinibank - Make a Transaction");

    $account_id = $account->getId();
    $account_balance = $account->getValue();


    ?>

        <div class="title">
            <h1>Make a Transaction</h1>
        </div>
        <div class="create-account-form">
            <form action="<?= BASE_URL ?>/account/transaction/<?= $account_id ?>" method="post">
                <label for="account_id">Account Number:</label>
                <input name="account_id" id="account_id" type="number" value="<?= $account_id ?>" required>

                <label for="transaction_type">Transaction Type:</label>
                <select id="transaction_type" name="transaction_type" required>
                        <option value="deposit">Deposit</option>
                        <option value="withdrawal">Withdrawal</option>
                </select>

                <label for="amount">Transaction Amount:</label>
                <input name="amount" type="number" step="0.01" required>
                <input type="hidden" name="current_balance" value="<?= $account_balance ?>">

                <label for="description">Description:</label>
                <input type="text" name="description" maxlength="500" required>

                <div class="form-row">
                    <input type="submit" name="submit" value="Make Transaction">
                    <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL ?>/account/detail/<?= $account_id ?>"'>
                </div>
            </form>
        </div>

    <?php
    parent::displayFooter();
}


}