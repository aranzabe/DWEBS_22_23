    <?php
    require_once 'Persona.php';
    //Este ejemplo recoge elementos que se le pasan como json en la petición.
    // echo($_SERVER['REQUEST_METHOD']).'<br>';
    // echo($_SERVER['REQUEST_URI']).'<br>';
    $datosRecibidos = file_get_contents("php://input");
    //echo $datosRecibidos;
    # No los hemos decodificado, así que lo hacemos de una vez:
    $data = json_decode($datosRecibidos, true);
    //print_r($data);
    // echo $data['nombre'];
    //echo $data['apellidos'];
    // echo $data['nacimiento']['anio'];
    
    //header("Content-Type:application/json");
    //respuesta_entregada(200, "Bienvenida: ".$data['nombre'], $data['apellidos']);
    //respuesta_entregada(202, "Bienvenida: ".$data['nombre'], $data);
    respuesta_entregada(200, "Bienvenida: ".$data['nombre'], new Persona($data[nombre], $data[apellidos], $data[nacimiento]));
   
    
    function respuesta_entregada($estado, $mensaje_estado, $datos)
    {
        //cabecera respuesta
        header("HTTP/1.1 ".$estado."  ".$mensaje_estado."");

        //rellenamos array con estado, mensaje y datos
        $respuesta = ['estado' => $estado,
                      'mensaje_estado' => $mensaje_estado,
                      'datos' => $datos];
    
        //codificamos el json
        $respuesta_json = json_encode($respuesta);

        //pintamos el contenido del json
        echo $respuesta_json;
    }
    





        // $jsonString ='{
    //     "nombre":"Olivia",
    //     "apelllidos":"Mason",
    //     "nacimiento":
    //     {
    //         "anio":"1999",
    //         "mes":"06",
    //         "dia":"19"
    //     }
    // }';
    //$data = json_decode($jsonString,true);
    //echo("The data is: \n");
    //var_dump($data);
    //echo($data['nombre']);
    //http://localhost:8000/index.php?nombre=Pepe&peso=75&estatura=183
    //echo "<script>console.log('Console: " . $console . "' );</script>";
    
//    //definimos con header el tipo del documento (JSON)
//    header("Content-Type:application/json");
     
//            //recojemos variables
//            $nombre = $_GET['nombre'];
//            $peso = $_GET['peso'];
//            $estatura = $_GET['estatura'];
     
//            //validamos varaiables vacias
//            if(!empty($nombre) && !empty($peso) && !empty($estatura))
//            {
//                // convertimos cm en m
//                $estatura = $estatura / 100;
    
//                //formula peso(kg)/talla(m2)
//                $imc = $peso / ($estatura * $estatura);
    
//                //redondeamos a dos decimales
//                $imc = round($imc, 2);
    
//                //entregamos respuesta 
//                respuesta_entregada(200, "$nombre tu IMC es de $imc", $imc);
//            }
//            else
//            {
//                //entregamos respuesta 
//                respuesta_entregada(200, "nombre, peso o estatura no validos", null);
//            }