<?php
// Se incluyen los archivos necesarios: conexión a la base de datos y el modelo de recompensas
require_once __DIR__ . "/../models/conexion.php";
require_once __DIR__ . "/../models/Models_Recompensas.php";

// Definición de la clase del controlador de recompensas
class Controller_Recompensas
{
    // Propiedad privada para el modelo de recompensas
    private $Models_Recompensas;

    // Constructor del controlador que recibe la conexión a la base de datos
    public function __construct($db)
    {
        // Se crea una instancia del modelo de recompensas pasando la base de datos
        $this->Models_Recompensas = new Recompensas($db);
    }

    // Método para mostrar las recompensas
    public function mostrarRecompensas()
    {
        // Obtener todas las recompensas desde el modelo
        return $this->Models_Recompensas->obtenerRecompensas();

        // Este bloque nunca se ejecutará porque el return anterior termina la ejecución del método.
        // Si se desea mostrar recompensas con HTML, este return debe eliminarse o moverse después del foreach.

        // Recorrer las recompensas obtenidas (nota: la variable $recompensas no está definida aquí)
        foreach ($recompensas as $row) {
            // Calcular la cantidad restante de recompensas disponibles
            $cantidad_restante = max(0, $row['cantidad'] - $row['entregadas']);

            // Verificar si existe una foto asociada a la recompensa
            if ($row['foto']) { ?>
                <!-- Contenedor de imagen con atributos adicionales para mostrar más información -->
                <div class="image-container">
                    <!-- Imagen con atributos personalizados para ser usados en JavaScript -->
                    <img src="../../uploads/<?php echo $row['foto']; ?>" alt="Imagen"
                        data-description="<?php echo htmlspecialchars($row['descripcion']); ?>"
                        data-puntos="<?php echo htmlspecialchars($row['puntos']); ?>"
                        data-cantidad="<?php echo htmlspecialchars($row['cantidad']); ?>"
                        data-entregadas="<?php echo htmlspecialchars($row['entregadas']); ?>"
                        data-restantes="<?php echo $cantidad_restante; ?>" onclick="showDescription(this)">
                </div>
            <?php } else { ?>
                <!-- Mensaje si no hay imagen disponible -->
                <div>Sin Foto</div>
            <?php }
        }
    }
}
?>
