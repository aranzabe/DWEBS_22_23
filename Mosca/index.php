<?php
require_once('mosca_tablero.php');
require_once('simulacion.php');
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $paths = $_SERVER['REQUEST_URI'];

    if($requestMethod != 'GET'){
        $mensaje = [
            'cod' => 405,
            'dec' => 'Verbo no admitido'
        ];
        header("HTTP/1.1 405 Verbo no soportado");
        echo json_encode($mensaje);
    }
    else{
        $parametros = explode('/', $paths);
        unset($parametros[0]);
        if(count($parametros) > 1){
            $mensaje = [
                'cod' => 405,
                'dec' => 'Te has pasado de argumentos '
            ];
            header("HTTP/1.1 405 Te has pasado de argumentos");
            echo json_encode($mensaje);
        }
        else{
            if(empty($parametros[1])){
                $mensaje = [
                    'cod' => 405,
                    'dec' => 'Necesitar poner un numero'
                ];
                header("HTTP/1.1 405 Necesitar poner un numero");
                echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            }
            else{
                if(!is_numeric($parametros[1])){
                    $mensaje = [
                        'cod' => 405,
                        'dec' => 'Necesitar poner un numero, no una letra o varias'
                    ];
                    header("HTTP/1.1 405 Necesitar poner un numero, no una letra o varias");
                    echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
                }
                else{
                    if($parametros[1] < 0 || $parametros[1] > 4 ){
                        $mensaje = [
                            'cod' => 406,
                            'dec' => 'Los numeros que se permiten son del 0 a 4'
                        ];
                        header("HTTP/1.1 406 Los numeros que se permiten son del 0 a 4");
                        echo json_encode($mensaje);
                    }
                    else{    
                        $qhp = simMosca($parametros[1]);
                        
                        echo json_encode($qhp, JSON_UNESCAPED_UNICODE);
                    }
                }
            }
        }
    }

?>