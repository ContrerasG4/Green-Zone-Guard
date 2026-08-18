<?php
// Verificar si las constantes ya están definidas
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
}

if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'greenzoneguard');
}

// Clase para manejar la conexión a la base de datos utilizando MySQLi
if (!class_exists('Database')) {
    class Database
    {
        private static $connection;

        public static function getConnection()
        {
            if (!self::$connection) {
                self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                if (self::$connection->connect_error) {
                    die('Error de conexión (MySQLi): ' . self::$connection->connect_error);
                }
            }
            return self::$connection;
        }
    }
}

// Clase para manejar la conexión a la base de datos utilizando PDO
if (!class_exists('DatabasePDO')) {
    class DatabasePDO
    {
        private static $connection;

        public static function getConnection()
        {
            if (!self::$connection) {
                try {
                    self::$connection = new PDO(
                        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                        DB_USER,
                        DB_PASSWORD,
                        [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        ]
                    );
                } catch (PDOException $e) {
                    die('Error de conexión (PDO): ' . $e->getMessage());
                }
            }
            return self::$connection;
        }
    }
}
?>
