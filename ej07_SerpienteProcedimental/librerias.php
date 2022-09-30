<?php
function generarAnilla() {
    $colores = ['R', 'V', 'A'];
    return $colores[rand(0, count($colores) - 1)];
}

function nacer() {
    $v[] = '>~C·';
    $v[] = generarAnilla();
    $v[] = 'D>';
    return $v;
}

function crecer(&$s) {
    $aux = array_pop($s);
    $s[] = generarAnilla();
    $s[] = $aux;
}

function decrecer(&$s) {
    unset($s[count($s) - 2]); 
    $s = array_values($s);
}

function mudarPiel(&$s) {
    $cabeza = array_shift($s);
    $cola = array_pop($s);
    foreach ($s as $key => $value) {
        $s[$key] = generarAnilla();
    }
    array_unshift($s, $cabeza);
    $s[] = $cola;
}

function simularSerpiente () {
    $serp = nacer();
    $viva = true;
    $edad = 1;

    while ($viva && $edad > 0) {   
        if ($edad < 10) {
            if (rand(0,3) == 0) {
                decrecer($serp);
            } else {
                crecer($serp);
            } 
        } else {
            if (rand(0,1) == 0) {
                decrecer($serp);
            } else {
                crecer($serp);
            } 
        }

        if (rand(0, 10) > 4) {
            mudarPiel($serp);
        }

        if (rand(0, 10) == 0 || count($serp) == 2) {
            $viva = false;
            if (count($serp) == 2) {
                $tipoMuerte = 'vieja';
            } else {
                $tipoMuerte = 'comida';
            }
        }
        $edad++;
    }
    $serpienteFinal = [
        'edad' => $edad,
        'cuerpo' => $serp,
       /*  'cuerpo' => implode($serp), */
        'tipoMuerte' => $tipoMuerte
    ];
    return $serpienteFinal;
}