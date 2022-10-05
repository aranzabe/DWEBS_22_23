<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        
        // Utilizando la forma OO.
        try {
                $conexion = new mysqli('localhost', 'fernando', 'Chubaca2023', 'ejemplo');
        }
        catch (Exception $e){
                echo "Fallo al conectar a MySQL: (" . $e->getMessage() . ") <br>";
                die();
        }
        echo $conexion->host_info . "<br>";

       
        //Bind param OO.
        $consulta = "SELECT * FROM personas WHERE DNI = ?";
        $stmt = $conexion->prepare($consulta);
        $dni = '1A';
        $stmt->bind_param("s", $dni); 
        $stmt->execute();
        $resultados = $stmt->get_result();
        if ($resultados->num_rows != 0){
            //print_r($resultados);
            //print_r($resultados->fetch_array());
            while( $fila = $resultados->fetch_array()) 
            {
                //print_r($fila);
                print $fila["DNI"] . "," . $fila[1] . "," . $fila[2] . "<br>";
            }
            // while ($fieldinfo = $resultados -> fetch_field()) {
            //     echo 'Nombre del campo: '. $fieldinfo -> name.'<br>';
            //     echo 'Tabla: '. $fieldinfo -> table.'<br>';
            // }
            $resultados -> free_result();
        }
        else {
            echo 'No se ha encontrado ningún registro'.'<br>';
        }
        


        //************* Insertar *********************
        /* Sentencias de preparación de la inserción y de la inserción propiamente. 
           Con esta forma se evitará la inyección de SQL.         */
       $query = "INSERT INTO personas (DNI, Nombre, Tfno, Clave) VALUES (?,?,?, '1234')"; //Estos parametros seran sustituidos mas adelante por valores.
       $stmt = $conexion->prepare($query);
       $val1 = '27J';
       $val2 = 'Persona humana';
       $val3 = '323';
       $stmt->bind_param("sss", $val1, $val2, $val3);
       /* Ejecución de la sentencia. */
       try {
            $stmt->execute();
            echo 'Inserción correcta: '.$stmt->affected_rows .' fila afectada... <br>';
       }
       catch (Exception $e){
          echo 'Inserción incorrecta: (Cod: '.$conexion->errno.') --> '.$conexion->error.'<br>';
       }


       //Dejamos UPDATE y DELETE para 'investigar'...
      
       /* Cerrar la conexión */
       $conexion->close();
       print "Conexión 2 cerrada" . "<br>";
      ?>
    </body>
</html>
