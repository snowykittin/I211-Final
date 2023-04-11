<?php

class Currency{
    private $id, $name, $symbol, $type;

    public function __construct($name, $symbol, $type)
    {
        $this->name = $name;
        $this->symbol = $symbol;
        $this->type = $type;
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function getSymbol()
    {
        return $this->symbol;
    }


    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;
    }



}