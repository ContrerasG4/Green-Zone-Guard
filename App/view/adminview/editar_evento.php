<?php
require_once __DIR__ . '/../../controllers/admincontrollers/EventoController.php';
require_once __DIR__ . '/../../models/adminmodels/EventoModel.php';

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // Crear instancia del modelo y obtener el evento
    $eventoModel = new EventoModel();
    $evento = $eventoModel->obtenerEventoPorCodigo($codigo);

    if (!$evento) {
        echo "<script>
        alert('Evento no encontrado.');
        window.location.href = 'Gestion_Evento.php';
            </script>";
    }
} else {
    echo "<script>
            alert('Código de evento no proporcionado.');
            window.location.href = 'Gestion_Evento.php'; 
            </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>

    <link rel="icon" href="../../../public/images/iconos/planta.ico">
    <link rel="shortcut icon" href="../../../public/images/iconos/planta.ico" type="image/x-icon">

    <!-- Estilos CSS -->
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }

        /* Contenedor principal */
        h1 {
            color: #333;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 15px;
        }

        form {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 40%;
            max-width: 600px;
            margin: 20px;
            box-sizing: border-box;
        }

        /* Etiquetas */
        label {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        /* Inputs y Textarea */
        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Botón de submit */
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 1.1rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Estilo para texto de alerta */
        .alert {
            color: red;
            font-size: 1rem;
            margin-top: 10px;
            font-weight: bold;
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            form {
                width: 80%;
            }
        }

        @media (max-width: 480px) {
            form {
                width: 90%;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>

    <form action="../../controllers/admincontrollers/EventoController.php" method="POST">

        <h1>Editar Evento</h1>
        <!-- Acción que define la operación -->
        <input type="hidden" name="accion" value="editar">
        <!-- Código del evento -->
        <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($evento['Codigo_Evento']); ?>">

        <label for="nombre">Nombre del Evento:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($evento['Nombre_Evento']); ?>" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required><?php echo htmlspecialchars($evento['Descripcion_Evento']); ?></textarea><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($evento['Fecha_Evento']); ?>" required><br>

        <label for="ubicacion">Ubicación:</label>
        <input type="text" name="ubicacion" id="ubicacion" value="<?php echo htmlspecialchars($evento['Ubicacion_Evento']); ?>" required><br>

        <label for="puntos">Puntos:</label>
        <input type="number" name="puntos" id="puntos" value="<?php echo htmlspecialchars($evento['Puntos']); ?>" required><br>

        <label for="hora">Hora:</label>
        <input type="time" name="hora" id="hora" value="<?php echo htmlspecialchars($evento['Hora_Evento']); ?>" required><br>

        <button type="submit">Actualizar Evento</button>
    </form>
</body>

</html>