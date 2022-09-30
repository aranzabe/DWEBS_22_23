<?php 
require_once 'Personaje.php';

class Morfeo extends Personaje {
    public $dealer;

    function __construct($n,$l,$d){
        parent::__construct($n,$l);
        //super($n,$l); En JAVA.
        $this->dealer = $d;
    }

    /**
     * Get the value of dealer
     */ 
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * Set the value of dealer
     *
     * @return  self
     */ 
    public function setDealer($dealer)
    {
        $this->dealer = $dealer;

        return $this;
    }

    function __toString(){
        return "Morfeo={".parent::__toString()." Modo: ".$this->dealer."}";
    }

    function metodoObligatorio(){
        return "Obligatorio de Morfeo";
    }
}