<?php

class Transaction
{
    private $id, $transaction_date, $transaction_type, $amount, $description;

    public function __construct($transaction_date, $transaction_type, $amount, $description){
        $this->transaction_date = $transaction_date;
        $this->transaction_type = $transaction_type;
        $this->amount = $amount;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTransactionDate()
    {
        return $this->transaction_date;
    }

    /**
     * @param mixed $transaction_date
     */
    public function setTransactionDate($transaction_date)
    {
        $this->transaction_date = $transaction_date;
    }

    /**
     * @return mixed
     */
    public function getTransactionType()
    {
        return $this->transaction_type;
    }

    /**
     * @param mixed $transaction_type
     */
    public function setTransactionType($transaction_type)
    {
        $this->transaction_type = $transaction_type;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }



}