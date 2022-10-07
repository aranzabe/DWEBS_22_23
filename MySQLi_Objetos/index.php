<?php
require_once 'Auxiliar/Conexion.php';
require_once 'Auxiliar/Parametros.php';
require_once 'Modelo/Persona.php'; //dir

header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

$verbosParametro = ['GET', 'PUT', 'DELETE'];
if (in_array($requestMethod, $verbosParametro)) {
    $args = explode('/', $paths);
    unset($args[0]);
}

switch ($requestMethod) {
    case 'GET':
        if (empty($args[1])) {
            if ($res = Conexion::getPersonaTodas()) {// Cambiar
                $cod = '200';
                $desc = 'OK';
                $mensajeAdicional = ['datos' => $res]; 
            } else {
                $cod = '400';
                $desc = 'Error';
            }
        } else {
            if ($res = Conexion::getPersona($args[1])) { // Cambiar
                $cod = '200';
                $desc = 'OK';
                $mensajeAdicional = ['datos' => $res]; 
            } else {
                $cod = '202';
                $desc = 'No encontrado'; 
            }
        }
        break;

    case 'POST': 
        $datosRecibidos = file_get_contents("php://input");
        $datos = json_decode($datosRecibidos, true);
        if ($res = Conexion::addPersona($datos['dni'], $datos['nombre'], $datos['clave'], $datos['telefono'])) {// Cambiar
            $cod = '200';
            $desc = 'OK';
        } else {
            $cod = '400';
            $desc = 'Error';
        }
        break;
        
    case 'PUT':
        if (!empty($args[1])) {
            $datosRecibidos = file_get_contents("php://input");
            $datos = json_decode($datosRecibidos, true);
            if (Conexion::editarPersona($args[1], $datos['nombre'], $datos['clave'], $datos['telefono'])) {// Cambiar
                $cod = '200';
                $desc = 'OK';
            } else {
                $cod = '202';
                $desc = 'No encontrado'; 
            }
        } else {
            $cod = '400';
            $desc = 'Error'; 
        }
        break;

    case 'DELETE':
        if (!empty($args[1])) {
            if (Conexion::borrarPersona($args[1])) {// Cambiar
                $cod = '200';
                $desc = 'OK'; 
            } else {
                $cod = '202';
                $desc = 'No encontrado'; 
            }
        } else {
            $cod = '400';
            $desc = 'Error'; 
        }
        break;
    default:
        $cod = '405';
        $desc = 'Petición incorrecta'; 
}

header("HTTP/1.1 " . $cod . " " . $desc );
$mensaje = [
    'cod' => $cod,
    'desc' => $desc
];
if (isset($mensajeAdicional)) {
    $mensaje = array_merge($mensaje, $mensajeAdicional);
}
echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);