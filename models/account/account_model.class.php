<?php

class AccountModel
{
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblAccounts;

    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblAccounts = $this->db->getAccountsTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //static method to ensure there is just one AccountModel instance
    public static function getAccountModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new AccountModel();
        }
        return self::$_instance;
    }


    //list all of a user's accounts
    public function list_accounts(){
        $sql = "SELECT a.account_id, t.type_name, c.currency_symbol, a.value FROM account AS a LEFT JOIN acct_types AS t ON a.account_type = t.type_id LEFT JOIN currency AS c ON a.currency_type = c.currency_id";
        //execute
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false.
        if (!$query)
            return false;

        //if the query succeeded, but no accounts found.
        if ($query->num_rows == 0)
            return 0;

        $accounts = array();
        //loop recordsets
        while ($obj = $query->fetch_object()){
            $account = new Account(stripslashes($obj->type_name),stripslashes($obj->currency_symbol),stripslashes($obj->value));

            $account->setId($obj->account_id);

            $accounts[] = $account;
        }

        return $accounts;
    }
}