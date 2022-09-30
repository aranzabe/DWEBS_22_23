<?php
include_once 'Tablero.php';
header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];


if ($requestMethod === 'GET') { 
    $args = explode('/', $paths);
    unset($args[0]);
    if (count($args) <= 2) { // 2 parámetros o menos
        if (isset($args[2])) { // 2 parámetros
            if  ($args[1] == '' || $args[2] == '') { // Parámetros vacíos
                header("HTTP/1.1 400 Parametro vacios");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Parámetro vacíos'
                ];
            } else if (!is_numeric($args[1]) || !is_numeric($args[2])) { // Parámetros no numéricos
                header("HTTP/1.1 400 Deben ser numeros");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Deben ser números'
                ];
            } else if ($args[1] < 0 || $args[2] < 0) { // Parámetros menores que 0
                header("HTTP/1.1 400 Deben ser mayores que 0");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Deben ser mayores que 0'
                ];
            } else if ($args[2] < $args[1]) { // Segundo param es menor que primer param
                header("HTTP/1.1 400 El segundo parametro debe ser mayor o igual al primero");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'El segundo parámetro debe ser mayor o igual al primero'
                ];
            } else { // Parámetros correctos
                $tablero = new Tablero($args[2]);
            }
        } else { // 1 parámetro
            if ($args[1] == '') { // Primer parámetro vacío
                header("HTTP/1.1 400 Primer parametro vacio");
                $mensaje = [
                    'prueba' => empty($args[1]),
                    'cod' => '400',
                    'desc' => 'Primer parámetro vacío'
                ];
            } else if (!is_numeric($args[1])) { // Primer parámetro letra
                header("HTTP/1.1 400 Deben ser numeros");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Deben ser números'
                ];
            } else if ($args[1] < 0) { // Primer parámetro menor que 0
                header("HTTP/1.1 400 Deben ser mayores que 0");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Deben ser mayores que 0'
                ];
            } else if ($args[1] >= Parametros::$tamMax) { // Primer parámetro mayor que el tablero
                header("HTTP/1.1 400 Debe ser menor que 5");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Debe ser menor que 5'
                ];
            } else {
                $tablero = new Tablero(5);
            }
        }
        if (isset($tablero)) {
            $tablero->iniciarTablero();
            $resultado = $tablero->golpearTablero($args[1]);
            header("HTTP/1.1 200 Correcto");
            $mensaje = [
                'cod' => '200',
                'desc' => 'Correcto',
                'posicion' => $args[1],
                'resultado' => $resultado,
                'tablero' => $tablero
            ];
        }
    } else { // Más de 2 parámetros
        header("HTTP/1.1 400 Demasiados parametros");
        $mensaje = [
            'cod' => '400',
            'desc' => 'Demasiados parámetros'
        ]; 
    }
} else { 
    header("HTTP/1.1 405 Peticion incorrecta");
    $mensaje = [
        'cod' => '405',
        'desc' => 'Petición incorrecta'
    ];   
}
echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);  

/* if ($requestMethod === 'GET') { 
    $args = explode('/', $paths);
    unset($args[0]);
    print_r($args);
    echo '<br>';
    if (count($args) <= 2) { // 2 parámetros o menos
        if (isset($args[2])  || $args[2] != 0 || empty($args[2])) { // 2 parámetros
            echo 'segundo existe y no está vacío<br>';
            if (!is_numeric($args[2])) { // Segundo parámetro no es numérico
                echo 'letras 2 <br>';
                header("HTTP/1.1 400 Deben ser numeros");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Deben ser números'
                ];
            } else if ($args[2] < 0) { // Segundo parámetro es menor que 0
                echo '2 menor que 0<br>';
                header("HTTP/1.1 400 Deben ser mayores que 0");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Deben ser mayores que 0'
                ];
            } else if ($args[2] < $args[1]) { // Segundo param es menor que primer param
                echo '2 menor que primero<br>';
                header("HTTP/1.1 400 El segundo parametro debe ser mayor o igual al primero");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'El segundo parámetro debe ser mayor o igual al primero'
                ];
            } else { // Segundo correcto
                echo 'bien 2<br>';
                $tablero = new Tablero($args[2]);
                $tablero->iniciarTablero();
                $resultado = $tablero->golpearTablero($args[1]);
                header("HTTP/1.1 200 Correcto");
                $mensaje = [
                    'cod' => '200',
                    'desc' => 'Correcto',
                    'resultado' => $resultado,
                    'tablero' => $tablero
                ];
            }
        } else { // 1 parámetro
            if ($args[1] != 0 || empty($args[1])) { // Primer parámetro vacío
                echo 'primero vacío<br>';
                header("HTTP/1.1 400 Primer parametro vacio");
                $mensaje = [
                    'prueba' => empty($args[1]),
                    'cod' => '400',
                    'desc' => 'Primer parámetro vacío'
                ];
            } else if (!is_numeric($args[1])) { // Primer parámetro letra
                echo 'letras 1 <br>';
                echo 'ddfg' . $args[1];
                header("HTTP/1.1 400 Deben ser numeros");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Deben ser números'
                ];
            } else if ($args[1] < 0) { // Primer parámetro menor que 0
                echo '1 menor que 0<br>';
                header("HTTP/1.1 400 Deben ser mayores que 0");
                $mensaje = [
                    'cod' => '400',
                    'desc' => 'Deben ser mayores que 0'
                ];
            } else {
                echo '1 bien<br>';
                $tablero = new Tablero(5);
                $tablero->iniciarTablero();
                $resultado = $tablero->golpearTablero($args[1]);
                header("HTTP/1.1 200 Correcto");
                $mensaje = [
                    'cod' => '200',
                    'desc' => 'Correcto',
                    'resultado' => $resultado,
                    'tablero' => $tablero
                ];
            }
        }
    } else { // Más de 2 parámetros
        header("HTTP/1.1 400 Demasiados parametros");
        $mensaje = [
            'cod' => '400',
            'desc' => 'Demasiados parámetros'
        ]; 
    }
} else { 
    header("HTTP/1.1 405 Peticion incorrecta");
    $mensaje = [
        'cod' => '405',
        'desc' => 'Petición incorrecta'
    ];   
}
echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);   */




/* if ($requestMethod === 'GET') { 
    $args = explode('/', $paths);
    unset($args[0]);
    if (count($args) <= 2) { // 2 parámetros o menos
        if (empty($args[1])) { // Parámetro 1 vacío
            header("HTTP/1.1 400 Primer parametro vacio");
            $mensaje = [
                'cod' => '400',
                'desc' => 'Primer parámetro vacío'
            ];
        } else if (!is_numeric($args[1])) { // Parámetro 1 letra
            header("HTTP/1.1 400 Deben ser numeros");
            $mensaje = [
                'cod' => '400',
                'desc' => 'Deben ser números'
            ];
        } else { // Parámetro 1 correcto
            if (isset($args[2])) { // 2 Parámetros
                if (empty($args[2])) { // Parámetro 2 vacío
                    header("HTTP/1.1 400 Segundo parametro vacio");
                    $mensaje = [
                        'cod' => '400',
                        'desc' => 'Segundo parámetro vacío'
                    ];
                } else if (!is_numeric($args[2])) { // Parámetro 2 letra
                    header("HTTP/1.1 400 Deben ser números");
                    $mensaje = [
                        'cod' => '400',
                        'desc' => 'Deben ser números'
                    ];
                } else if ($args[2] < $args[1]) {
                    header("HTTP/1.1 400 El segundo parametro debe ser mayor o igual al primero");
                    $mensaje = [
                        'cod' => '400',
                        'desc' => 'El segundo parámetro debe ser mayor o igual al primero'
                    ]; 
                } else {// Parámetro 2 correcto
                    $tablero = new Tablero($args[2]);
                }
            } else { // Solo 1 Parámetro
                $tablero = new Tablero();
            }
            $tablero->iniciarTablero();
            $resultado = $tablero->golpearTablero($args[1]);
        }
    } else { // Más de 2 parámetros
        header("HTTP/1.1 400 Demasiados parametros");
        $mensaje = [
            'cod' => '400',
            'desc' => 'Demasiados parámetros'
        ]; 
    }
} else { 
    header("HTTP/1.1 405 Peticion incorrecta");
    $mensaje = [
        'cod' => '405',
        'desc' => 'Petición incorrecta'
    ];   
}
echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);  */




/* if ($requestMethod === 'GET') { 
    $args = explode('/', $paths);
    unset($args[0]);
    print_r($args); //sfdf
    if (count($args) <= 2) { // 2 parámetros o menos
        if (!empty($args[1])) {
            if (!isset($args[2])) { //Solo 1 parámetro
                if (is_numeric($args[1])) {
                    $tablero = new Tablero();
                } else { // Parámetros no numéricos
                    header("HTTP/1.1 400 Los parámetros deben ser números");
                    $mensaje = [
                        'cod' => '400',
                        'desc' => 'Los parámetros deben ser números'
                    ]; 
                }
            } else { // 2 parámetros
                if (is_numeric($args[1]) && is_numeric($args[2])) {     
                    if ($args[2] >= $args[1]) {
                        $tablero = new Tablero($args[2]);
                        $tablero->iniciarTablero();
                        $res = $tablero->golpearTablero($args[1]);
                        header("HTTP/1.1 200 Correcto");
                        $mensaje = [
                            'cod' => '200',
                            'desc' => 'Correcto',
                            'resultado' => $res
                        ];
                    } else {
                        header("HTTP/1.1 400 Primer parámetro mayor que el segundo");
                        $mensaje = [
                            'cod' => '400',
                            'desc' => 'Primer parámetro mayor que el segundo'
                        ];
                    }
                } else { // Parámetros no numéricos
                    header("HTTP/1.1 400 Los parámetros deben ser números");
                    $mensaje = [
                        'cod' => '400',
                        'desc' => 'Los parámetros deben ser números'
                    ];  
                }
            }
        } else { // Parámetro 1 vacío
            header("HTTP/1.1 400 Sin primer parámetro");
            $mensaje = [
                'cod' => '400',
                'desc' => 'Sin primer parámetro'
            ]; 
        }      
       
    } else { // Más de 2 parámetros
        header("HTTP/1.1 400 Demasiados parámetros");
        $mensaje = [
            'cod' => '400',
            'desc' => 'Demasiados parámetros'
        ]; 
    }
} else { 
    header("HTTP/1.1 405 Peticion incorrecta");
    $mensaje = [
        'cod' => '405',
        'desc' => 'Petición incorrecta'
    ];   
}
echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);  */
