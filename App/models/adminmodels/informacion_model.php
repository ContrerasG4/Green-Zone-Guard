<?php
require_once __DIR__ . "../../../models/conexion.php";

class informacion {
  private $conn;
  public function __construct()
  {
    $this -> conn = Database::getConnection();

    
  }
  public function obtenerInformacion(){
    $sql = "SELECT * FROM informacion";
    return $this ->conn->query($sql);

  }
  public function actualizar ($titulo,$mensaje){
    $stmt = $this->conn->prepare("UPDATE informacion SET Titulo =?,Mensaje = ?");
    $stmt->bind_param("ss", $titulo, $mensaje);
    return $stmt -> execute();
  }
}
?>