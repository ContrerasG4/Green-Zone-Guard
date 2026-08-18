<?php
require_once __DIR__ . "/../models/conexion.php";
require_once __DIR__ . "/../models/ModeloUsuario.php"; // Archivo renombrado

class LoginController
{
    private $usuarioModel;

    public function __construct($db)
    {
        $this->usuarioModel = new ModeloUsuario($db); // Usamos ModeloUsuario
    }

    public function iniciarSesion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar si se enviaron los campos requeridos
            if (
                !isset($_POST['Usuario'], $_POST['Contraseña']) ||
                empty($_POST['Usuario']) ||
                empty($_POST['Contraseña'])
            ) {
                echo "<script>alert('Por favor, completa todos los campos.'); window.location.href='../view/Login.php';</script>";
                exit;
            }

            $usuario = $_POST['Usuario'];
            $contraseña = $_POST['Contraseña'];
            $datosUsuario = $this->usuarioModel->getUserByUsername($usuario);

            // DEPURACIÓN: Verificamos si obtiene datos
            if (!$datosUsuario) {
                echo "<script>alert('El usuario no existe.'); window.location.href='../view/Login.php';</script>";
                exit;
            }

            if (password_verify($contraseña, $datosUsuario["Contraseña"])) {
                session_start();
                $_SESSION["Nombre_usuario"] = $datosUsuario["Nombre_usuario"];
                $_SESSION["Documento"] = $datosUsuario["Documento"];
                $_SESSION["Nombre"] = $datosUsuario["Nombre"];
                $_SESSION["Apellidos"] = $datosUsuario["Apellidos"];
                $_SESSION["Email"] = $datosUsuario["Email"];

                echo "<script>alert('Bienvenido " . $datosUsuario['Nombre_usuario'] . "'); window.location.href='/App/view/viewsesion/indexsesion.php';</script>";
                exit;
            } else {
                echo "<script>alert('Usuario o contraseña incorrectos.'); window.location.href='../view/Login.php';</script>";
                exit;
            }
        }
        // return null;
    }
}

// Instanciamos el controlador
global $conn;
$loginController = new LoginController($conn);
$mensaje = $loginController->iniciarSesion();
