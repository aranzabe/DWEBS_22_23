<?php 
//require_once 'Personaje.php';
require_once 'Morfeo.php';
require_once 'Trinity.php';

header("Content-Type:application/json");
// $p = new Personaje("Mario","Sión");
// echo "Nombre ".$p->getNombre();
// echo Personaje::$N;
// Personaje::$N = 12;
// echo $p->hacerCosas();
// echo "<br>-------------------<br>";
// $p->peleaSable(2,"Jaime");
// Personaje::metodoEstatico();
$m = new Morfeo("Morfeo","Nebuchaneezer",true);
// echo $m.'<br>';
$t = new Trinity("Trinity","Nebuchaneeze",false);
// echo $t.'<br>';
$v = array($m->getNombre() => $m,
           $t->getNombre() => $t);
// foreach ($v as $key => $value) {
//     echo $key."".$value->metodoObligatorio()."<br>";
//     if ($m instanceof Morfeo){
//         if ($m->getDealer()){
//             echo 'Morfeo está en modo trapicheo';
//         }
//     }
// }

echo json_encode($v);