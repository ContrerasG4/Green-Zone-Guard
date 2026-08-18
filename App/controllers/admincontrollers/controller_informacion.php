<?php
require_once __DIR__ . '/../../models/conexion.php';
require_once __DIR__ . '/../../models/adminmodels/informacion_model.php';

class InformacionController
{
    private $model;

    public function __construct()
    {
        $this->model = new informacion();
    }

    public function manejarSolicitud()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Actualizar'])) {
            $titulo = $_POST['Titulo'];
            $mensaje = $_POST['Mensaje'];
            $actualizado = $this->model->actualizar($titulo, $mensaje);

            if ($actualizado) {
                echo "<script>alert('Mensaje actualizado correctamente');</script>";
            }
        }

        $datos = $this->model->obtenerInformacion();
        include __DIR__ . '/../../view/adminview/informacion.php';
    }
}
