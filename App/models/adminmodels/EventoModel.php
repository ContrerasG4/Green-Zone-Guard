<?php

require_once __DIR__ . '../../../../adminconfig/database.php';

class EventoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = DatabasePDO::getConnection(); // Asegúrate de que esta clase esté correctamente definida.
    }

    // Crear un nuevo evento
    public function create($data)
    {
        $query = "INSERT INTO eventos 
                  (Codigo_Evento, Nombre_Evento, Descripcion_Evento, Fecha_Evento, Ubicacion_Evento, Puntos, Hora_Evento) 
                  VALUES 
                  (:codigo, :nombre, :descripcion, :fecha, :ubicacion, :puntos, :hora)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Actualizar un evento existente
    public function update($data)
    {
        $query = "UPDATE eventos 
                  SET Nombre_Evento = :nombre, 
                      Descripcion_Evento = :descripcion, 
                      Fecha_Evento = :fecha, 
                      Hora_Evento = :hora, 
                      Ubicacion_Evento = :ubicacion, 
                      Puntos = :puntos 
                  WHERE Codigo_Evento = :codigo";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Obtener un evento por su código
    public function obtenerEventoPorCodigo($codigo)
    {
        $query = "SELECT * FROM eventos WHERE Codigo_Evento = :codigo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un array asociativo con los datos del evento
    }

    // Eliminar un evento
    public function delete($codigo)
    {
        $query = "DELETE FROM eventos WHERE Codigo_Evento = :codigo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
