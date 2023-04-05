<?php

/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * File: database,class.php
 * Description: Description: the Database class sets the database details.
 *
 */

class Database
{

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'infinibank_db',
        'tblAccounts' => 'account',
        'tblMembers' => 'member',
        'tblTransactions' => 'transactions',
        'tblCurrency' => 'currency'
    );
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct()
    {
        $this->objDBConnection = @new mysqli(
            $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
        );
        if (mysqli_connect_errno() != 0) {
            $message = "Connecting database failed: " . mysqli_connect_error() . ".";
            include 'error.php';
            exit();
        }
    }
    //static method to ensure there is just one Database instance
    static public function getDatabase() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    public function getConnection() {
        return $this->objDBConnection;
    }

    //get table that stores accounts
    public function getAccountsTable() {
        return $this->param['tblAccounts'];
    }
    //get table that stores members
    public function getMembersTable() {
        return $this->param['tblMembers'];
    }
    //get table that stores transactions
    public function getTransactionsTable() {
        return $this->param['tblTransactions'];
    }
    //get currency types
    public function getCurrencyTable(){
        return $this->param['tblCurrency'];
    }

}