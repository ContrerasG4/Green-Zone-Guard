<?php
require_once(__DIR__ . '/../models/models_consultar.php'); 


$mensaje = '';
$participantes = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Consultar'])) {
    $codigoEvento = $_POST['Select'];
    $participantes = ParticipacionModel::obtenerParticipantesPorEvento($codigoEvento);
}

if (isset($_GET['accion']) && isset($_GET['Documento'])) {
    $documento = $_GET['Documento'];

    if ($_GET['accion'] === 'eliminar') {
        if (ParticipacionModel::eliminarParticipacion($documento)) {
            echo "<script>alert('Usuario eliminado correctamente');</script>";
        }
    }

    if ($_GET['accion'] === 'verificar') {
        $resultEventos = ParticipacionModel::obtenerPuntosEventosPorUsuario($documento);
        $puntosTotales = 0;
        while ($evento = $resultEventos->fetch_assoc()) {
            $puntosTotales += intval($evento['Puntos']);
        }

        if (ParticipacionModel::actualizarPuntosUsuario($documento, $puntosTotales)) {
            echo "<script>alert('Puntos actualizados correctamente');</script>";

            $usuarioResult = ParticipacionModel::obtenerUsuarioPorDocumento($documento);
            $eventoResult = ParticipacionModel::obtenerUltimoEvento();

            if ($usuarioResult->num_rows > 0 && $eventoResult->num_rows > 0) {
                $usuario = $usuarioResult->fetch_assoc();
                $evento = $eventoResult->fetch_assoc();

                ParticipacionModel::insertarHistorial($usuario['Documento'], $usuario['Nombre_usuario'], $evento['Nombre_Evento'], $evento['Puntos']);
                ParticipacionModel::eliminarParticipacionesPorDocumento($documento);
            }
        }
    }
}

$eventos = ParticipacionModel::obtenerEventos();
?>
