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

        if(!$account){
            //display error
            return "We're sorry, your account cannot be found.";
        }

        $view = new AccountDetail();
        $view->display($account);
    }

}