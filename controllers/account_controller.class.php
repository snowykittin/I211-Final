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

}