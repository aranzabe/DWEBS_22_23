<?php 
//require '../Factoria.php';  //-->Ejemplo.
class Mina {
    public $items;
    public $tipo;
    public $alds;

    function __contruct($tipo, $items){
        $this->items = $items;
        $this->tipo = $tipo;
        $this->alds = [];
    }

    function addAldeano($a){
        $this->alds[] = $a;
    }


    function curranTodos(){
        foreach ($this->alds as $currante) {
            $civ = $currante->getCiv();
            $civ->setAlmOro($civ->getAlmOro + 1);
            $this->items--;
        }
    }
    

    /**
     * Get the value of items
     */ 
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set the value of items
     *
     * @return  self
     */ 
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }
}