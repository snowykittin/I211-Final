<?php

class AccountController
{
    private $account_model;

    public function __construct(){
        $this->account_model = AccountModel::getAccountModel();

        //verify session has been started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
//
//        //check the user's admin access and member-id
//        if(!isset($_SESSION['privilege'])){
//            $_SESSION['privilege'] = true;
//        }
//        if(!isset($_SESSION['member-id'])){
//            $_SESSION['member-id'] = 8;
//        }
    }

    //index will display all of a user's accounts
    public function index(){
        //check to see if admin. if not, don't allow them to see new account button
        if($_SESSION['privilege'] === true){
            $make_account = "true";
        }else{
            $make_account = "false";
        }
        try{
            $accounts = $this->account_model->list_accounts();
            if(!$accounts) {
                //show an error
                throw new PageloadException("We're sorry, this page cannot be loaded. If you do not have an account with Infinibank, please call a representative to sign up for an account.");
            }
            $view = new AccountIndex();
            $view->display($accounts, $make_account);
        }catch (PageloadException $e) {
            $this->error($e->getMessage());
        }

    }

    //error function
    public function error($message){
        $view = new ErrorView();
        $view->display($message);
    }

//    //show a specific account's details
    public function details($id){
        try{
            //retrieve specific account
            $account = $this->account_model->view_account($id);
            $transactions = $this->account_model->list_transactions($id);

            if(!$account){
                //display error
                throw new PageloadException("We're sorry, this page cannot be loaded. If you do not have an account with Infinibank, please call a representative to sign up for an account.");
            }

            $view = new AccountDetail();
            $view->display($account, $transactions);
        }catch (PageloadException $e) {
            $this->error($e->getMessage());
        }

    }

    // account search
    public function search_accounts(){
        //retrieve terms from search
        $query_terms = trim($_GET['query-terms']);

        //if empty, simply go back to listing all accounts
        if($query_terms == "")
            $this->index();

        //search database for matching accounts
        $accounts = $this->account_model->search_accounts($query_terms);

        if($accounts === false){
            // handle error
            $this->index();
        }
        //display matched accounts
        $search = new AccountSearch();
        $search->display($accounts);
    }

    //transaction search
    public function search_transactions(){
        //retrieve items from search, retrieve account id
        $query_terms = trim($_GET['query-terms']);
        $id = trim($_GET['acct-id']);

        //if empty, simply go back to the accounts view
        if($query_terms == ""){
            $this->details($id);
            exit();

        }

        //retrieve account details
        $account = $this->account_model->view_account($id);
        //search database for matching transactions

        try{
            $transactions = $this->account_model->search_transactions($query_terms, $id);

            if($transactions === false){
                throw new PageloadException("We're sorry, your transactions could not be obtained. Please try again.");
            }

            //display transactions
            $search = new TransactionSearch();
            $search->display($account, $transactions);
        }catch (PageloadException $e){
            $this->error($e->getMessage());

        }


    }

    //make a transaction page
    public function make_transaction($id){
        //retrieve specific account
        $account = $this->account_model->view_account($id);

        if(!$account){
            //display error
            return "We're sorry, your account cannot be found to make a transaction.";
        }

        $view = new AccountTransaction();
        $view->display($account);
    }

    //make a transaction
    public function transaction($id){
        //make the transaction
        $transaction = $this->account_model->make_transaction();

        if(!$transaction){
            $this->error($transaction);
        }else{
            //go back to account details page
            $this->details($id);
        }
    }

    //create a new bank account page - visible to admin's only
    public function new_account(){
        try{
            if(!$_SESSION['privilege']){
                throw new UnauthorizedAccessException("You do not have access to view this page.");
            }

            //get the currency types
            $currencies = $this->account_model->list_currencies();
            $types = $this->account_model->list_types();

            $view = new AccountCreate();
            $view->display($types, $currencies);
        }catch (UnauthorizedAccessException $e){
            $this->error($e->getMessage());
        }

    }
    //run sql to create account, then take to account listing
    public function create(){
        try{
            //create new account
            $new_account = $this->account_model->create_account();
            if (!$new_account) {
                //display an error
                throw new PageloadException("There was a problem in making your account.");
            }

            $accounts = $this->account_model->list_accounts();
            $make_account = "true";
            $view = new AccountIndex();
            $view->display($accounts, $make_account);
        }catch (PageloadException $e){
            $this->error($e->getMessage());
        }

    }

    //ajax suggestion
    public function suggest_transactions(){
        //retrieve query terms
        $query_terms = trim($_GET['terms']);
        $id = trim($_GET['id']);
        $transactions = $this->account_model->search_transactions($query_terms, $id);

        $descriptions = array();
        if ($transactions){
            foreach ($transactions as $transaction){
                $descriptions[] = $transaction->getDescription();
            }
        }

        echo json_encode($descriptions);
    }
}