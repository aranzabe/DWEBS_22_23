<?php 

class Personaje {
    public $nombre;
    public $localizacion;
    public static $N = 0;

    function __construct($n, $l){
        $this->nombre = $n;
        $this->localizacion = $l;
    }

    function __toString(){
        return "Personaje{".$this->nombre.", ".$this->localizacion."}";
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of localizacion
     */ 
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * Set the value of localizacion
     *
     * @return  self
     */ 
    public function setLocalizacion($localizacion)
    {
        $this->localizacion = $localizacion;

        return $this;
    }

    public function hacerCosas(){
        return "El personaje ".$this->nombre." hace ".self::$N." cosas";
    }

    function __call($nombre, $args){
        echo $nombre."<br>";
        print_r($args);
    }

    static function metodoEstatico(){

    }

    private function peleasSable1($a){

    }
    private function peleasSable2($a,$b){

    }

    //abstract function metodoObligatorio();
}