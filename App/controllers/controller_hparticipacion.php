<?php
require_once __DIR__ . '/../models/models_hparticipacion.php';

class historialcontroller{
    private $modelo;
    public function __construct(){
        $this->modelo = new Historial_Participacion();

    }

    public function manejar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
            $exito = $this->modelo->eliminarHistorial();
            if ($exito) {
                $mensaje = "Todos los registros han sido eliminados.";
            } else {
                $mensaje = "Error al eliminar los registros.";
            }
            header("Location: /App/view/adminview/Historial_Participacion.php?mensaje=" . urlencode($mensaje));
            exit();
        }
         return $this->modelo->obtenerHistorial();
       
    }
}
