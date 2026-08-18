<?php
require_once __DIR__ . "/../../../adminconfig/database.php";
require_once __DIR__ . "/../../models/adminmodels/AdminModel.php";

class AdminController
{
    private $Modeladmin;

    public function __construct($db)
    {
        $this->Modeladmin = new AdminModel($db); // Usamos AdminModelo
    }

    public function Login_Admin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar si se enviaron los campos requeridos
            if (
                !isset($_POST['Documento_Administrador'], $_POST['Contraseña']) ||
                empty($_POST['Documento_Administrador']) ||
                empty($_POST['Contraseña'])
            ) {
                echo "<script>alert('Por favor, completa todos los campos.'); window.location.href='../../view/adminview/Login_Admin.php';</script>";
                exit;
            }

            $documento = $_POST['Documento_Administrador'];
            $contraseña = $_POST['Contraseña'];

            // Intentar obtener datos del administrador
            $datosAdmin = $this->Modeladmin->getElementById($documento);

            if (!$datosAdmin) {
                // Usuario no encontrado
                echo "<script>alert('El usuario no existe.'); window.location.href='../../view/adminview/Login_Admin.php';</script>";
                exit;
            }

            // Verificar la contraseña
            if (password_verify($contraseña, $datosAdmin["Contraseña"])) {
                session_start();
                $_SESSION["Documento_Administrador"] = $datosAdmin["Documento_Administrador"];
                $_SESSION["Nombre_Administrador"] = $datosAdmin["Nombre_Administrador"];
                $_SESSION["Apellido_Administrador"] = $datosAdmin["Apellido_Administrador"];
                $_SESSION["Email"] = $datosAdmin["Email"];

                echo "<script>alert('Bienvenido a tu aventura como administrador " . $datosAdmin['Nombre_Administrador'] . "'); window.location.href='../../view/adminview/Gestion_Evento.php';</script>";
                exit;
            } else {
                // Contraseña incorrecta
                echo "<script>alert('Usuario o contraseña incorrectos.'); window.location.href='../../view/adminview/Login_Admin.php';</script>";
                exit;
            }
        }
    }
}

// Instanciamos el controlador
global $conn;
$AdminController = new AdminController($conn);
$AdminController->Login_Admin();
