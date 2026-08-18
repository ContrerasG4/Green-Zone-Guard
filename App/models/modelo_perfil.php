<?php
namespace App\Model;

use PDO;
use PDOException;

class Usuario
{
    private $pdo;

    public function __construct($dbConfig)
    {
        try {
            $this->pdo = new PDO("mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['dbname'], $dbConfig['username'], $dbConfig['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public function obtenerFotoPerfil($documento)
    {
        $query = "SELECT Foto_perfil FROM usuario WHERE Documento = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$documento]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario ? $usuario['Foto_perfil'] : null;
    }
 
    public function actualizarFotoPerfil($documento, $rutaFoto)
    {
        $query = "UPDATE usuario SET Foto_perfil = ? WHERE Documento = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$rutaFoto, $documento]);
    }

    public function obtenerDatosUsuario($documento)
    {
        $query = "SELECT Nombre_usuario, Email, Puntos, Nombre FROM usuario WHERE Documento = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$documento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarDatosUsuario($documento, $nombreUsuario, $email)
    {
        $query = "UPDATE usuario SET Nombre_usuario = ?, Email = ? WHERE Documento = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$nombreUsuario, $email, $documento]);
    }

    public function obtenerPuntosUsuario($documento)
    {
        $query = "SELECT Puntos FROM usuario WHERE Documento = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$documento]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['Puntos'] : 0;
    }
}