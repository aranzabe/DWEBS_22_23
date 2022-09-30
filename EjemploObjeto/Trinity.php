<?php
require_once 'Personaje.php';
require_once 'Metodos.php';

class Trinity extends Personaje implements Metodos {
    public $hacerGrulla;

    function __construct($n,$l,$d){
        parent::__construct($n,$l);
        //super($n,$l); En JAVA.
        $this->hacerGrulla = $d;
    }

    function metodoObligatorio(){
        return "Obligatorio en Trinity";
    }

    function __toString(){
        return "Trinity={".parent::__toString()." Modo: ".$this->hacerGrulla."}";
    }

    function obligatorioInterface(){
        return "Obligatorio Interface Trinity";
    }
}