<?php

class Account{
    private $id, $member_no, $account_type, $currency_type, $value;

    public function __construct($account_type, $currency_type, $value){
        $this->account_type = $account_type;
        $this->currency_type = $currency_type;
        $this->value = $value;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }


    public function getMemberNo()
    {
        return $this->member_no;
    }


    public function setMemberNo($member_no): void
    {
        $this->member_no = $member_no;
    }


    public function getAccountType()
    {
        return $this->account_type;
    }


    public function setAccountType($account_type)
    {
        $this->account_type = $account_type;
    }


    public function getCurrencySymbol()
    {
        return $this->currency_type;
    }

    public function setCurrencyType($currency_type)
    {
        $this->currency_type = $currency_type;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }


}
