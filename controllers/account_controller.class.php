<?php

class AccountController
{
    private $account_model;

    public function __construct(){
        $this->account_model = AccountModel::getAccountModel();
    }

    //index will display all of a user's accounts
    public function index(){
        $accounts = $this->account_model->list_accounts();
        if(!$accounts) {
            //show an error
            $message = "We're sorry, your accounts are not available.";
        }
        $view = new AccountIndex();
        $view->display($accounts);
    }

//    //show a specific account's details
    public function details($id){
        //retrieve specific account
        $account = $this->account_model->view_account($id);
        $transactions = $this->account_model->list_transactions($id);

        if(!$account){
            //display error
            return "We're sorry, your account cannot be found.";
        }

        $view = new AccountDetail();
        $view->display($account, $transactions);
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
        if($query_terms == "")
            $this->details($id);

        //retrieve account details
        $account = $this->account_model->view_account($id);
        //search database for matching transactions
        $transactions = $this->account_model->search_transactions($query_terms, $id);

        if($transactions === false){
            //handle error
            $this->details($id);
        }

        //display transactions
        $search = new TransactionSearch();
        $search->display($account, $transactions);

    }

    //make a deposit page
    public function deposit(){

        $view = new AccountDeposit();
        $view->display();
    }

    //make a transfer page
    public function transfer(){

        $view = new AccountTransfer();
        $view->display();
    }

    //create a new bank account page - visible to admin's only
    public function new_account(){
        //get the currency types
        $currencies = $this->account_model->list_currencies();
        $types = $this->account_model->list_types();

        $view = new AccountCreate();
        $view->display($types, $currencies);
    }
    //run sql to create account, then take to account listing
    public function create(){
        //create new account
        $new_account = $this->account_model->create_account();
        if (!$new_account) {
            //display an error
            $message = "There was a problem making your account.";
            $this->error($message);
            return;
        }

        $accounts = $this->account_model->list_accounts();
        //show accounts page
        $view = new AccountIndex();
        $view->display($accounts);

    }
}