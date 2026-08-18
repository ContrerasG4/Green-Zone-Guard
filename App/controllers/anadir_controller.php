<?php
require_once __DIR__ . '/../models/adminmodels/anadir_model.php';

class AdminController
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    public function index()
    {
        $administradores = $this->adminModel->getAll();
        include __DIR__ . '/../view/adminview/anadiradmin.php';
    }

    public function agregar()
    {
        if (isset($_POST['Agregar'])) {
            $documento = $_POST['Documento'];
            $nombre = $_POST['Nombre'];
            $apellido = $_POST['Apellido'];
            $email = $_POST['email'];
            $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);

            if ($this->adminModel->existsByDocumento($documento)) {
                echo "<script>alert('El documento ID ya existe'); window.location.href='/App/view/adminview/anadir.php';</script>";
                
            } elseif ($this->adminModel->existsByEmail($email)) {
                echo "<script>alert('El correo ya existe'); window.location.href='/App/view/adminview/anadir.php';</script>";

            } else {
                if ($this->adminModel->add($documento, $nombre, $apellido, $contraseña, $email)) {
                    echo "<script>alert('Administrador agregado exitosamente.'); window.location.href='/App/view/adminview/anadir.php';</script>";
                }
            }
            exit();
        }
    }

    public function eliminar()
    {
        if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['Documento_Administrador'])) {
            $this->adminModel->delete($_GET['Documento_Administrador']);
            echo "<script>alert('Administrador eliminado correctamente');</script>";
        }
    }
}
