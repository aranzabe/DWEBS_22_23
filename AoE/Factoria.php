<?php 
require_once './Clases/Civilizacion.php';
require_once './Clases/Aldeano.php';
require_once './Clases/Mina.php';

class Factoria {
    static function generarCivilizacion($nombre, $rey, $vidaDefecto){
        $civ = new Civilizacion($nombre, $rey);
        for ($i=0; $i < 100; $i++) { 
            $civ->addAldeano(new Aldeano($vidaDefecto, $civ));
        }
        return $civ;
    }

    static function generaAldeano($vi,$ci){
        return new Aldeano($vi,$ci);
    }

    static function factoriaMina($tipo,$cant){
        return new Mina($tipo, $cant);
    }
}