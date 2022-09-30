<?php
class Tablero {
    //---------------------------------------------------
    //---------------------------------------------------
    public $t;
    private $tam = 5;
    

    //---------------------------------------------------
    //---------------------------------------------------
    public function __construct($tam) {   
        $this->tam = $tam;  
    }

    /* public function __call($nombre, $args) {
        if (count($args) == 0) {
            $this->__call('__construct0', $args);
        } else if (count($args) == 1) {
            $this->__call('__construct1', $args);
        }
    }

    private function __construct0($tam) {
        $this->tam = $tam;
    }  */


    public function iniciarTablero() {
        for ($i = 0; $i < $this->tam; $i++) { 
            $this->t[] = '-';
        }
        $this->t[rand(0, $this->tam - 1)] = 'M';
    }

    public function golpearTablero($pos) {
        $posMosca = array_search('M', $this->t);
        if ($posMosca == $pos) {
            $res = 'cazada';
        } else if ($posMosca + 1 == $pos || $posMosca - 1 == $pos) {
            $res = 'casi';
        } else {
            $res = 'agua';
        }
        return $res;
    }

    /**
     * Get the value of tam
     */ 
    public function getTam(){
        return $this->tam;
    }

    public function __toString() {
        return '{ Tablero: ' .$t. ', Tamaño: ' .$tam. ' }';
    }
}
?>