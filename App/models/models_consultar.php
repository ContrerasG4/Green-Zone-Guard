<?php
require_once(__DIR__ . '/../models/conexion.php'); // ✅ Siempre correcta


class ParticipacionModel {
    public static function obtenerParticipantesPorEvento($codigoEvento) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM participacion WHERE Codigo_Evento = ?");
        $stmt->bind_param("s", $codigoEvento);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function eliminarParticipacion($documento) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM participacion WHERE Documento = ?");
        $stmt->bind_param("s", $documento);
        return $stmt->execute();
    }

    public static function obtenerPuntosEventosPorUsuario($documento) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT e.Puntos 
            FROM eventos e
            INNER JOIN participacion p ON e.Codigo_Evento = p.Codigo_Evento
            WHERE p.Documento = ?");
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function actualizarPuntosUsuario($documento, $puntosTotales) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE usuario SET Puntos = COALESCE(Puntos, 0) + ? WHERE Documento = ?");
        $stmt->bind_param("is", $puntosTotales, $documento);
        return $stmt->execute();
    }

    public static function obtenerUsuarioPorDocumento($documento) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE Documento = ?");
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function obtenerEventos() {
        $conn = Database::getConnection();
        return $conn->query("SELECT DISTINCT e.Codigo_Evento, e.Nombre_Evento FROM eventos e INNER JOIN participacion p ON e.Codigo_Evento = p.Codigo_Evento");
    }

    public static function obtenerUltimoEvento() {
        $conn = Database::getConnection();
        return $conn->query("SELECT * FROM eventos ORDER BY Codigo_Evento DESC LIMIT 1");
    }

    public static function insertarHistorial($documento, $nombreUsuario, $nombreEvento, $puntos) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO historial_participacion (Documento, Nombre_Usuario, Nombre_Evento, puntos) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $documento, $nombreUsuario, $nombreEvento, $puntos);
        return $stmt->execute();
    }

    public static function eliminarParticipacionesPorDocumento($documento) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM participacion WHERE Documento = ?");
        $stmt->bind_param("s", $documento);
        return $stmt->execute();
    }
}
?>
