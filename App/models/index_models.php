<?php
require_once 'conexion.php'; 

class InformacionModel {
    public static function obtenerInformacion() {
        $conn = Database::getConnection();
        $consulta = "SELECT * FROM informacion";
        $resultado = $conn->query($consulta);
        
        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC); // Devuelve un array con todos los registros
        }
        
        return [];
    }
}
