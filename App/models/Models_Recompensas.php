<?php
// Definición de la clase 'recompensas' que se encarga de la lógica de acceso a datos
class recompensas
{
    // Propiedad privada para almacenar la conexión a la base de datos
    private $conexion;

    // Constructor que recibe una instancia de la conexión a la base de datos
    public function __construct($db)
    {
        // Asignar la conexión a la propiedad privada
        $this->conexion = $db;
    }

    // Método para obtener todas las recompensas de la base de datos
    public function obtenerRecompensas()
    {
        // Consulta SQL para seleccionar los campos relevantes de la tabla recompensas
        $sql = "SELECT foto, descripcion, puntos, cantidad, entregadas FROM recompensas";

        // Ejecutar la consulta SQL
        $result_tareas = $this->conexion->query($sql);

        // Crear un array vacío para almacenar los resultados
        $recompensas = [];

        // Verificar si se obtuvieron resultados
        if ($result_tareas->num_rows > 0) {
            // Recorrer cada fila del resultado
            while ($row = $result_tareas->fetch_assoc()) {
                // Calcular la cantidad restante de recompensas disponibles
                $cantidad_restante = max(0, $row['cantidad'] - $row['entregadas']);

                // Agregar la cantidad restante al array de datos de la recompensa
                $row['cantidad_restante'] = $cantidad_restante;

                // Añadir la recompensa al array de recompensas
                $recompensas[] = $row;
            }
        }

        // Devolver el array con todas las recompensas procesadas
        return $recompensas;
    }
}
?>
