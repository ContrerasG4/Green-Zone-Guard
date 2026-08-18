<?php
require_once 'conexion.php';

class UsuarioModel{
private $conn;

public function __construct(){
    $this ->conn = Database::getConnection();

}
public function existeEmail($email){
$stmt = $this ->conn->prepare("SELECT Documento FROM usuario where Email = ?");
$stmt ->bind_param("s",$email);
$stmt -> execute();
return $stmt -> get_result()->fetch_assoc();
}


public function guardarcodigo($email,$codigo){
  
        $stmt = $this->conn->prepare("UPDATE usuario SET codigo_recuperacion = ? where Email = ?");
        $stmt ->bind_param("ss",$codigo,$email);
  

return $stmt -> execute();

}

public function verificarCodigo($email,$codigo){
$stmt = $this->conn->prepare("SELECT Documento FROM usuario where Email = ? AND codigo_recuperacion =?");
$stmt->bind_param("ss",$email,$codigo);
$stmt->execute();
return $stmt->get_result()->fetch_assoc();


}
public function actualizarPassword($email,$password){
    $hash = password_hash ($password, PASSWORD_DEFAULT);
    $stmt = $this->conn->prepare("UPDATE usuario SET Contraseña = ?, codigo_recuperacion = NULL WHERE Email = ?");
    $stmt->bind_param("ss", $hash, $email);
    return $stmt->execute();
}
}

?>