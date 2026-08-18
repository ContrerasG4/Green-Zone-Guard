<?php

require_once __DIR__ . "/../models/modelo_unete.php";

session_start();
class unetecontroller
{
    private $modelo_unete;
    public function __construct()
    {
        $this->modelo_unete = new unete();
    }
    public function mostrarevento()
    {
        return $this->modelo_unete->obtenerevento();
    }
    public function inscribir()
    {
        if (!isset($_SESSION['Documento']) || !isset($_SESSION['Nombre_usuario'])) {
            echo "<script>alert('Debe iniciar sesión para inscribirse.'); window.location.href = '/App/view/login.php';</script>";
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Unirse'])) {
            $documento = $_SESSION['Documento'];
            $usuario = $_SESSION['Nombre_usuario'];
            $codigoEvento = $_POST['Codigo_Evento'];
            $mensaje = $this->modelo_unete->inscribirse($documento, $usuario, $codigoEvento);
            echo "<script>alert('$mensaje'); window.location.href = '/App/view/viewsesion/indexsesion.php';</script>";
            exit();
        }
    }
}
$controller = new unetecontroller();
$controller->inscribir();
