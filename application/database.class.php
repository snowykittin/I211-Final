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
        'database' => 'infinibank_db'
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

    //singleton pattern to create a single instance of the database connection object
    static public function getInstance() {
        if (self::$_instance == NULL) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

}