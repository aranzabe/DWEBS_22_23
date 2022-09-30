<?php 
class Civilizacion {
    public $nombre;
    public $rey;
    public $almOro;
    public $almPiedra;
    private $alds;

    function __contruct($nombre, $rey){
        $this->nombre = $nombre;
        $this->rey = $rey;
        $this->alds = [];
        $this->almOro = 0;
        $this->almPiedra = 0;
    }

    function addAldeano($a){
        $this->alds[] = $a;
    }

    function extraerAldeano(){
        $a = null;
        if (count($this->alds) > 0){
            $a = $this->alds[count - 1];
            unset($this->alds[count - 1]);
        }
        return $a;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of rey
     */ 
    public function getRey()
    {
        return $this->rey;
    }

    /**
     * Get the value of almOro
     */ 
    public function getAlmOro()
    {
        return $this->almOro;
    }

    /**
     * Set the value of almOro
     *
     * @return  self
     */ 
    public function setAlmOro($almOro)
    {
        $this->almOro = $almOro;

        return $this;
    }

    /**
     * Get the value of almPiedra
     */ 
    public function getAlmPiedra()
    {
        return $this->almPiedra;
    }

    /**
     * Set the value of almPiedra
     *
     * @return  self
     */ 
    public function setAlmPiedra($almPiedra)
    {
        $this->almPiedra = $almPiedra;

        return $this;
    }
}