<?php
require_once __DIR__ . '/../models/conexion.php';

class InformacionModel
{
    public static function obtenerInformacion()
    {
        $conn = Database::getConnection();
        $consulta = "SELECT * FROM informacion";
        $resultado = $conn->query($consulta);

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }
}
