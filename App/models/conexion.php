<?php
// Datos de la base de datos
$host = "localhost"; // Nombre del servidor
$user = "root"; // Usuario de la base de datos
$password = ""; // Contraseña del usuario
$database = "greenzoneguard"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

$conexion = mysqli_connect($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


class Database {
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            self::$connection = new mysqli('localhost', 'root', '', 'greenzoneguard');
            if (self::$connection->connect_error) {
                die('Error de conexión: ' . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}

?>



