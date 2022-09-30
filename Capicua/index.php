<?php
    require_once 'libreria.php';
    //header("Content-Type:application/json");

    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $paths = $_SERVER['REQUEST_URI'];
    if($requestMethod != 'GET'){
        header("HTTP/1.1 405 Método no permitido");
        $mensaje = [
            'cod' => '405',
            'des' => 'Método no permitido'
        ];
    }else{
        $parametros = explode("/",$paths);
        unset($parametros[0]);
        
        
        if(count($parametros) > 1){
            header("HTTP/1.1 400 Petición erronea");
            $mensaje = [
                'cod' => '400',
                'des' => 'Muchos parámetros'
            ];
        }else{
            //echo $parametros[1];
            
            if(empty($parametros[1])){
                header("HTTP/1.1 400 Petición erronea");
                $mensaje = [
                    'cod' => '400',
                    'des' => 'Sin parámetros'
                ];
                
            }else{
                $capicua = esCapicua($parametros[1]);
                if ($capicua){
                    $mensaje = [
                        'cod' => '200',
                        'des' => 'Sí'
                    ];
                }
                else {
                    $mensaje = [
                        'cod' => '200',
                        'des' => 'No'
                    ];
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        }
    }
?>