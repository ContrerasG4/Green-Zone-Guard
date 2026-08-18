<?php
require_once __DIR__ . '/../conexion.php';

class Admin
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM administracion";
        return $this->conn->query($query);
    }

    public function existsByDocumento($documento)
    {
        $query = "SELECT * FROM administracion WHERE Documento_Administrador = '$documento'";
        return $this->conn->query($query)->num_rows > 0;
    }

    public function existsByEmail($email)
    {
        $query = "SELECT * FROM administracion WHERE Email = '$email'";
        return $this->conn->query($query)->num_rows > 0;
    }

    public function add($documento, $nombre, $apellido, $contraseña, $email)
    {
        $query = "INSERT INTO administracion (Documento_Administrador, Nombre_Administrador, Apellido_Administrador, Contraseña, Email)
                  VALUES ('$documento', '$nombre', '$apellido', '$contraseña', '$email')";
        return $this->conn->query($query);
    }

    public function delete($documento)
    {
        $query = "DELETE FROM administracion WHERE Documento_Administrador = '$documento'";
        return $this->conn->query($query);
    }
}
