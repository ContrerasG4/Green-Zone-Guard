<?php
class Usuario
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registrarUsuario($datos)
    {
        $ID = $this->conn->real_escape_string($datos['Documento']);
        $Nombre = $this->conn->real_escape_string($datos['Nombre']);
        $Apellidos = $this->conn->real_escape_string($datos['Apellidos']);
        $Edad = $this->conn->real_escape_string($datos['Edad']);
        $Usuario = $this->conn->real_escape_string($datos['Usuario']);
        $Email = $this->conn->real_escape_string($datos['Email']);
        $Contraseña = password_hash($datos['Contraseña'], PASSWORD_BCRYPT);

        // Validaciones de duplicados
        if ($this->existeDocumento($ID)) {
            return "El Documento ID ya está registrado.";
        }
        if ($this->existeUsuario($Usuario)) {
            return "El nombre de usuario ya está en uso.";
        }
        if ($this->existeEmail($Email)) {
            return "Este correo ya está en uso.";
        }

        // Inserción
        $sql = "INSERT INTO usuario (Documento, Nombre, Apellidos, Edad, Nombre_usuario, Contraseña, Email) 
                VALUES ('$ID', '$Nombre', '$Apellidos', '$Edad', '$Usuario', '$Contraseña', '$Email')";

        return $this->conn->query($sql) ? "Registrado exitosamente" : "Error en el registro: " . $this->conn->error;
    }

    private function existeDocumento($ID)
    {
        return $this->conn->query("SELECT * FROM usuario WHERE Documento = '$ID'")->num_rows > 0;
    }

    private function existeUsuario($Usuario)
    {
        return $this->conn->query("SELECT * FROM usuario WHERE Nombre_usuario = '$Usuario'")->num_rows > 0;
    }

    private function existeEmail($Email)
    {
        return $this->conn->query("SELECT * FROM usuario WHERE Email = '$Email'")->num_rows > 0;
    }
}
