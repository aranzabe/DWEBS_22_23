<?php 
class Persona {

    public $nombre;
    public $edad;
    public $nacimiento;
    private $otros;

    public function __construct($n, $e, $na){
        $this->nombre = $n;
        $this->edad = $e;
        $this->nacimiento = $na;
        $this->otros = [];
    }

    public function addElementos($e) {
        $this->otros[] = $e;
    }

    public function addElementos2($i, $e) {
        $this->otros[$i] = $e;
    }
    
    public function __call($name, $arguments){
        // echo "inside the method: ".$name."<br>";
        // echo "id:".$arguments[0]."<br>";
        // echo "name:".$arguments[1]."<br>";
        // echo count($arguments)."<br>";
        if ($name === 'AddEle') {
            //echo 'AddEle'.'<br>';
            //print_r($arguments);
            if (count($arguments) === 1){
                $this->addElementos($arguments[0]);
            }
            else {
                $this->addElementos2($arguments[0],$arguments[1]);
            }
        }
          
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
     * Get the value of edad
     */ 
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set the value of edad
     *
     * @return  self
     */ 
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    public function __toString(){
        return "Persona{".$this->nombre.", ".$this->edad."}";
    }
}
