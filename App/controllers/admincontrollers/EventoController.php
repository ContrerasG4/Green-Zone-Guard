<?php

require_once __DIR__ . '../../../models/adminmodels/EventoModel.php';
require_once __DIR__ . '../../../../adminconfig/database.php';

class EventoController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new EventoModel();
    }

    public function manejarSolicitud()
    {
        $accion = $_POST['accion'] ?? ($_GET['accion'] ?? null);

        switch ($accion) {
            case 'agregar':
                $this->agregarEvento();
                break;
            case 'editar':
                $this->editarEvento();
                break;
            case 'eliminar':
                $this->eliminarEvento();
                break;
            default:
                // echo "<script>alert('Acción no válida esta aqui!.'); window.location.href = '../view/admin/Gestion_Evento.php';</script>";
                // exit;

                echo "<script> alert('Acción no válida.'); window.history.back(); </script>";
        }
    }

    private function agregarEvento()
    {
        $data = [
            'codigo' => $_POST['codigo'],
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'fecha' => $_POST['fecha'],
            'hora' => $_POST['hora'],
            'ubicacion' => $_POST['ubicacion'],
            'puntos' => $_POST['puntos']
        ];
        // Verificar si el código ya existe
        if ($this->modelo->obtenerEventoPorCodigo($data['codigo'])) {
            echo "<script>
                alert('El código del evento ya existe. No se permite duplicar.');
                window.history.back();
              </script>";
            exit;
        }

        if ($this->modelo->create($data)) {
            echo "<script>alert('Evento agregado exitosamente.'); window.location.href = '../../view/adminview/Gestion_Evento.php';</script>";
        } else {
            echo "<script>alert('Error al agregar el evento.'); window.location.href = '../../view/adminview/Gestion_Evento.php';</script>";
        }
    }

    private function editarEvento()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'codigo' => $_POST['codigo'] ?? null,
                'nombre' => $_POST['nombre'] ?? null,
                'descripcion' => $_POST['descripcion'] ?? null,
                'fecha' => $_POST['fecha'] ?? null,
                'ubicacion' => $_POST['ubicacion'] ?? null,
                'puntos' => $_POST['puntos'] ?? null,
                'hora' => $_POST['hora'] ?? null
            ];

            // Validar que no haya campos nulos
            if (in_array(null, $data, true)) {
                echo "<script>alert('Todos los campos son obligatorios.'); window.location.href = '../../view/adminview/Gestion_Evento.php';</script>";
                return;
            }

            if ($this->modelo->update($data)) {
                echo "<script>alert('Evento editado exitosamente.'); window.location.href = '../../view/adminview/Gestion_Evento.php';</script>";
            } else {
                echo "<script>alert('Error al editar el evento.'); window.location.href = '../../view/adminview/Gestion_Evento.php';</script>";
            }
        }
    }

    private function eliminarEvento()
    {
        $codigo = $_GET['codigo'] ?? null;

        if (!$codigo) {
            echo "<script>alert('Código de evento no proporcionado.'); window.location.href = '../../view/adminview/Gestion_Evento.php.php';</script>";
            return;
        }

        if ($this->modelo->delete($codigo)) {
            echo "<script>alert('Evento eliminado exitosamente.'); window.location.href = '../../view/adminview/Gestion_Evento.php';</script>";
        } else {
            echo "<script>alert('Error al eliminar el evento.'); window.location.href = '../../view/adminview/Gestion_Evento.php';</script>";
        }
    }
}

// Manejar la solicitud
$controller = new EventoController();
$controller->manejarSolicitud();
