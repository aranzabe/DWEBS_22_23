<?php
require_once('mosca_tablero.php');
function simMosca($posicion){
    $mosca = new Mosca();
    $tabla = new Tablero();
    $mosca->TipoMosca();
    $tabla->escondidaMosca();
    $tabla->colocandoMosca();
    $ocurrido = 'Fallo pero no asusto a la mosca';
    if($tabla->getTabla($posicion) == "*"){
        $ocurrido = 'Mato a la mosca';
    }
    else{
        if($posicion - 1 >= 0){
            if($tabla->getTabla($posicion - 1) == "*"){
                $ocurrido = 'Fallo y le asusto a la mosca';
            }
        }
        if($posicion + 1 <= $tabla->getMaximo()){
            if($tabla->getTabla($posicion + 1) == "*"){
                $ocurrido = 'Fallo y le asusto a la mosca';
            }
        }
        
    }

    $mensajeTabla = $tabla->mostrandoTablas();
    $qhp = [
        'pos' => $posicion,
        'ocurrido' => $ocurrido,
        'Tablas' => $tablero
    ];
    return $qhp;
}


?>