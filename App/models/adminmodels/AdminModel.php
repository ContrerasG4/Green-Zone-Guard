<?php

class AdminModel {
    private $conn;

    public function __construct($conn) {
        $conn = Database::getConnection();
        $this->conn = $conn;
    }


    public function getElementById($documento) {
        $stmt = $this->conn->prepare("SELECT * FROM Administracion WHERE Documento_Administrador = ?");
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
   
}
?>