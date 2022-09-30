<?php 
function rellenaVector($cuantos){
    $v = [];
    for ($i=0; $i < $cuantos; $i++) { 
        $v[] = rand(1,10);
    }
    return $v;
}