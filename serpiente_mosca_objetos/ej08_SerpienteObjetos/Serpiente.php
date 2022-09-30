<?php
class Serpiente {
    //---------------------------------------------------
    //---------------------------------------------------
    public $cuerpo;
    public $edad;
    private $viva;
    public $tipoMuerte;


    //---------------------------------------------------
    //---------------------------------------------------
    public function __construct() {
        $this->cuerpo = $this->nacer();
        $this->edad = 1;
        $this->viva = true;
    }

    private function generarAnilla() {
        $colores = ['R', 'V', 'A'];
        return $colores[rand(0, count($colores) - 1)];
    }
    
    function nacer() {
        $v[] = '>~C·';
        $v[] = $this->generarAnilla();
        $v[] = 'D>';
        $this->edad++;
        return $v;
    }
    
    function crecer() {
        $aux = array_pop($this->cuerpo);
        $this->cuerpo[] = $this->generarAnilla();
        $this->cuerpo[] = $aux;
        $this->edad++;
    }
    
    function decrecer() {
        if (count($this->cuerpo) > 2) {
            unset($this->cuerpo[count($this->cuerpo) - 2]); 
            $this->cuerpo = array_values($this->cuerpo);
        }
        $this->edad++;
    }
    
    function mudarPiel() {
        $cabeza = array_shift($this->cuerpo);
        $cola = array_pop($this->cuerpo);
        foreach ($this->cuerpo as $key => $value) {
            $this->cuerpo[$key] = $this->generarAnilla();
        }
        array_unshift($this->cuerpo, $cabeza);
        $this->cuerpo[] = $cola;
    }
    
    function simularVida () {
        while ($this->viva && $this->edad > 0) {   
            if ($this->edad < 10) {
                if (rand(0,3) == 0) {
                    $this->decrecer();
                } else {
                    $this->crecer();
                } 
            } else {
                if (rand(0,1) == 0) {
                    $this->decrecer();
                } else {
                    $this->crecer();
                } 
            }
    
            if (rand(0, 10) > 4) {
                $this->mudarPiel();
            }
    
            if (rand(0, 10) == 0 || count($this->cuerpo) == 2) {
                $this->viva = false;
                if (count($this->cuerpo) == 2) {
                    $this->tipoMuerte = 'Decrecimiento';
                } else {
                    $this->tipoMuerte = 'Comida';
                }
            }
            $this->edad++;
        }
        // return [
        //     'edad' => $this->edad,
        //     'cuerpo' => $this->cuerpo,
        //     'tipoMuerte' => $this->tipoMuerte
        // ];
    }


    /**
     * Get the value of cuerpo
     */ 
    public function getCuerpo(){
        return $this->cuerpo;
    }

    /**
     * Set the value of cuerpo
     *
     * @return  self
     */ 
    public function setCuerpo($cuerpo){
        $this->cuerpo = $cuerpo;
        return $this;
    }

    /**
     * Get the value of edad
     */ 
    public function getEdad(){
        return $this->edad;
    }

    /**
     * Set the value of edad
     *
     * @return  self
     */ 
    public function setEdad($edad){
        $this->edad = $edad;
        return $this;
    }

    /**
     * Get the value of estaViva
     */ 
    public function getViva(){
        return $this->viva;
    }

    /**
     * Set the value of estaViva
     *
     * @return  self
     */ 
    public function setEstaViva($viva){
        $this->viva = $viva;
        return $this;
    }

    public function __toString() {
        return '{ Edad: ' .$this->edad. ',  Cuerpo: ' .$this->cuerpo. ', Causa de muerte: ' .$this->tipoMuerte. ' }';
    }
}
