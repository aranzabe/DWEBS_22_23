<?php 
require_once 'libreria.php';
header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

// echo $requestMethod.'<br>';
// echo $paths;

if ($requestMethod != 'GET'){
    header("HTTP/1.1 405 Verbo no soportado");
    // $mensaje = [];
    // $mensaje['cod'] = '405';
    // $mensaje['dec'] = 'Verbo no admitido';
    $mensaje = [
        'cod' => '405',
        'dec' => 'Verbo no admitido 2'
    ];
    echo json_encode($mensaje); 
}
else {
    //echo $paths.'<br>';
    $parametros = explode("/",$paths);
    unset($parametros[0]);
    //print_r($parametros);
    //echo '<br>';
    if (count($parametros) > 1){
        header("HTTP/1.1 405 Te has pasado de argumentos");
        $mensaje = [
            'cod' => '405',
            'dec' => 'Muchos argumentos'
        ];
        echo json_encode($mensaje); 
    }
    else {
        $vector = rellenaVector(4);
        //print_r($vector);
        //print_r($parametros);
        if (empty($parametros[1])){
            echo json_encode($vector);
        }
        else {
            $mensajeEncontrado = "";
            $cod = 0;
            if (in_array($parametros[1],$vector)){
                $mensajeEncontrado = "Encontrado";
                $cod = 200;
            }
            else {
                $cod = 201;
                $mensajeEncontrado = "No eoncontrado";
            }
            $mensaje = [
                'cod' => $cod,
                'dec' => $mensajeEncontrado,
                'datos' => $vector
            ];
            header("HTTP/1.1 ".$cod." ".$mensajeEncontrado);
            echo json_encode($mensaje); 
        }
        //
    }
    
}