<?php
require_once 'Factoria.php';
require_once './Clases/Mina.php';
require_once './Clases/Civilizacion.php';

$esp = Factoria::generarCivilizacion("Españoles","Isabel II");
$biz = Factoria::generarCivilizacion("Bizantinos","Constantino Romero");

$mina = Factoria::factoriaMina("ORO",500);

$tiempo = 0;
while($tiempo <= $tiempoFinal){

    $mina->curranTodos();

    if ($tiempo % 4 == 0){
        $alea = rand(1,100);
        if ($alea <= 40){
            $a = $esp->extraerAldeano();
            if ($a != null){
                $mina->addAldeano($a);
            }
        }
        if ($alea <= 20){
            $a = $biz->extraerAldeano();
            if ($a != null){
                $mina->addAldeano($a);
            }
        }
        sleep(1);
        $tiempo++;
    }

    //a)
    echo json_encode($esp);

    //b)
    echo json_encode($biz);
    
    //c)
    echo json_encode($mina);
    
    //d)
    // $todo['Esp'] =  $esp;
    // $todo['Biz'] = $biz;
    // $todo['Mina'] = $mina;


    $todo = [
        'Esp' => $esp,
        'Biz' => $biz,
        'Mina' => $mina
    ];
    echo json_encode($todo);
}

