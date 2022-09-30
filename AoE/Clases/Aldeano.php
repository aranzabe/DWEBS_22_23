<?php 
class Aldeano {
    public $vida;
    public $civ;

    function __construct($v, $c){
        $this->civ = $c;
        $this->vida = $v;
    }

    /**
     * Get the value of civ
     */ 
    public function getCiv()
    {
        return $this->civ;
    }
}