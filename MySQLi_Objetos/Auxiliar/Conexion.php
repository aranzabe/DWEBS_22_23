<?php
class Conexion {
    private static $conexion;
    private static $resultado;
    private static $query;

    static function abrirConexion() {
        try {
            self::$conexion = new mysqli(Parametros::$host, Parametros::$usuario, Parametros::$password, Parametros::$BBDD);
        } catch (Exception $e) {
            die();
        }
    }

    static function getPersona($dni) {
        $persona = NULL;
        self::abrirConexion();
        self::$query = "SELECT * FROM " . Parametros::$accesoPersonas . " WHERE dni = ?";
        
        $stmt = self::$conexion->prepare(self::$query);
        $stmt->bind_param("s", $dni);
        
        try {
            $stmt->execute();
            self::$resultado = $stmt->get_result();
            if ($fila = self::$resultado->fetch_array()) {
                $persona = new Persona($fila["DNI"], $fila["Nombre"], $fila["Tfno"]); 
            }         
        } catch (Exception $e) {
            $persona = ['codigo' => $e->getCode(), 'mensaje' => $e->getMessage()];
        } finally {
            self::$resultado->free_result();
            self::cerrarConexion();
        }
        return $persona;
    }

    static function getPersonaTodas() {
        $personas = NULL;
        self::abrirConexion();
        self::$query = "SELECT * FROM " . Parametros::$accesoPersonas;
        
        try {
            if (self::$resultado = self::$conexion->query(self::$query)) {
                while ($fila = self::$resultado->fetch_array()) {
                    $personas[] = new Persona($fila["DNI"], $fila["Nombre"], $fila["Tfno"]);
                }
            }
        } catch (Exception $e) {
            $personas = ['codigo' => $e->getCode(), 'mensaje' => $e->getMessage()];
        } finally {
            self::$resultado->free_result();
            self::cerrarConexion();
        }
        return $personas;
    }

    static function addPersona($dni, $nombre, $clave, $tfno) {
        self::abrirConexion();
        self::$query = "INSERT INTO " . Parametros::$accesoPersonas . " VALUES (?, ?, ?, ?)";
       
        $stmt = self::$conexion->prepare(self::$query);
        $stmt->bind_param("ssss", $dni, $nombre, $clave, $tfno);
        try {
            $res = $stmt->execute();
        } catch (Exception $e) {
            $res = ['codigo' => $e->getCode(), 'mensaje' => $e->getMessage()];
        } finally {
            self::cerrarConexion();
        }
        return $res;
    }
    
    static function borrarPersona($dni) {
        $borrada = false;
        self::abrirConexion();
        self::$query = "DELETE FROM " . Parametros::$accesoPersonas . " WHERE dni LIKE ?";

        $stmt = self::$conexion->prepare(self::$query);
        $stmt->bind_param("s", $dni);
        try {
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $borrada = true;
            }
        } catch (Exception $e) {
            $borrada = ['codigo' => $e->getCode(), 'mensaje' => $e->getMessage()];
        } finally {
            self::cerrarConexion();
        }
        return $borrada;
    }

    static function editarPersona($dni, $nombre, $clave, $tfno) {
        $editada = false;
        self::abrirConexion();
        self::$query = "UPDATE " . Parametros::$accesoPersonas . " SET Nombre = ?, Clave = ?, Tfno = ? WHERE DNI = ?";
        
        $stmt = self::$conexion->prepare(self::$query);
        $stmt->bind_param("ssss", $nombre, $clave, $tfno, $dni);
        try {
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $editada = true;
            }
        } catch (Exception $e) {
            $editada = ['codigo' => $e->getCode(), 'mensaje' => $e->getMessage()];
        } finally {
            self::cerrarConexion();
        }
        return $editada;
    }

    static function cerrarConexion() {
        self::$conexion->close();
    }
}