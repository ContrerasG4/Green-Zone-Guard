
<?php
require_once __DIR__ . '/../models/conexion.php';
class Historial_Participacion{
    private $conn;
    public function __construct(){
        $this -> conn = Database::getConnection();
    }
    public function obtenerHistorial(){
       $sql =  "SELECT * FROM historial_participacion";
       $result = $this -> conn -> query($sql);
       $datos = [];

       if ($result){
        while ($fila = $result -> fetch_assoc()) {
            $datos[] = $fila;
        }
       }
       return $datos;
    }
    public function eliminarHistorial(){
    $sql = "DELETE FROM historial_participacion";
    return $this -> conn -> query($sql);
    }
}