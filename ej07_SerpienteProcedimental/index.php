<?php
include_once "librerias.php";
header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

if ($requestMethod === 'GET') { 
    $numero = explode('/', $paths);
    unset($numero[0]);
    if (count($numero) <= 1) {
        if (!empty($numero[1])) { //Con argumentos
            if (is_numeric($numero[1])) { //Número
                for ($i = 0; $i < $numero[1]; $i++) { 
                    $serpiente = simularSerpiente();
                    $nidoSerpientes[] = $serpiente;
                }
                $mensaje = [
                    'cod' => '200',
                    'desc' => 'Correcto',
                    'nido' => $nidoSerpientes
                ];
                echo json_encode($mensaje, JSON_UNESCAPED_UNICODE); 
            } else { //Letras
                header("HTTP/1.1 400 El parametro debe ser un numero");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'El parámetro debe ser un número'
                ]; 
                echo json_encode($mensaje, JSON_UNESCAPED_UNICODE); 
            }  
        } else { //Sin argumentos
            $serpiente = simularSerpiente();
            header("HTTP/1.1 200 Correcto");
            $mensaje = [
                'cod' => '200',
                'desc' => 'Correcto',
                'serpiente' => $serpiente
            ];
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE); 
        }
    } else { //Más de un argumento
        header("HTTP/1.1 414 Demasiados parametros");
        $mensaje = [
            'cod' => '414',
            'desc' => 'Demasiados parámetros'
        ];
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE); 
    } 
} else { 
    header("HTTP/1.1 405 Peticion incorrecta");
    $mensaje = [
        'cod' => '405',
        'desc' => 'Petición incorrecta'
    ]; 
    echo json_encode($mensaje, JSON_UNESCAPED_UNICODE); 
}


