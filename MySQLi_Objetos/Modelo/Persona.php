<?php
class Persona {
    public $dni;
    public $nombre;
    public $tfno;

    // -------------------------------------
    // -------------------------------------
    public function __construct($dni, $nombre, $tfno) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->tfno = $tfno;
    }

    /**
     * Get the value of dni
     */ 
    public function getDni(){
        return $this->dni;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Get the value of tfno
     */ 
    public function getTfno(){
        return $this->tfno;
    }

    /**
     * Set the value of tfno
     *
     * @return  self
     */ 
    public function setTfno($tfno){
        $this->tfno = $tfno;
        return $this;
    }

    public function __toString() {
        return 'Persona { ' . $this->dni . ', ' . $this->nombre . ', ' . $this->tfno . ' }';
    }
}