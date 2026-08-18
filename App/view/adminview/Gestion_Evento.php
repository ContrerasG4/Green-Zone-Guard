<?php

include __DIR__ . '/../../../adminconfig/database.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión - Eventos</title>
    <link rel="stylesheet" type="text/css" href="../../../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/global.css">
    <!-- <link rel="stylesheet" type="text/css" href="../../../styles/entrar-styles.css"> -->
    <link rel="stylesheet" type="text/css" href="../../../styles/panel-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
   
   
    <link rel="icon" href="../../../public/images/iconos/planta.ico">
    <link rel="shortcut icon" href="../../../public/images/iconos/planta.ico" type="image/x-icon">

    <style>
        .event-form {
            display: block;
            position: relative;
            right: -.5rem;
            height: 80%;
            border: 1px solid black;
        }
        
        .main-content {
            border: 1px solid black;
            height: 80%;
        }
    </style>
</head>

<body>

    <main>
        <!-- <h1 class="titulo__principal">"PROTEGE Y CUIDA NUESTRAS ZONAS VERDES"</h1> -->
        <br>
        <div class="container">
            <!-- Barra lateral de navegación -->
            <?php include __DIR__ . '/../adminview/layouts/Menu_PanelAdmin.php'; ?>

            <!-- Formulario para crear o editar eventos -->
            <div class="event-form">
                <h3><?php echo isset($eventoEditar) ? 'Editar evento' : 'Crear nuevo evento'; ?></h3>
                <form id="miFormulario" action="../../controllers/admincontrollers/EventoController.php" method="POST">
                    <input type="hidden" name="accion" value="<?php echo isset($eventoEditar) ? 'editar' : 'agregar'; ?>">
                    <input type="hidden" name="codigo" value="<?php echo isset($eventoEditar) ? $eventoEditar['Codigo_Evento'] : ''; ?>">

                    <label for="codigo">Código:</label>
                    <input type="text" id="codigo" name="codigo"
                        value="<?php echo isset($eventoEditar) ? $eventoEditar['Codigo_Evento'] : ''; ?>"
                        placeholder="Ingrese el código del evento" required <?php echo isset($eventoEditar) ? 'readonly' : ''; ?>>

                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre"
                        value="<?php echo isset($eventoEditar) ? $eventoEditar['Nombre_Evento'] : ''; ?>"
                        placeholder="Ingrese el nombre del evento" required>

                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion"
                        value="<?php echo isset($eventoEditar) ? $eventoEditar['Descripcion_Evento'] : ''; ?>"
                        placeholder="Ingrese la descripción" required>

                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha"
                        value="<?php echo isset($eventoEditar) ? $eventoEditar['Fecha_Evento'] : ''; ?>"
                        required>

                    <label for="ubicacion">Ubicación:</label>
                    <input type="text" id="ubicacion" name="ubicacion"
                        value="<?php echo isset($eventoEditar) ? $eventoEditar['Ubicacion_Evento'] : ''; ?>"
                        placeholder="Ingrese la ubicación" required>

                    <label for="puntos">Puntos:</label>
                    <input type="number" id="puntos" name="puntos"
                        value="<?php echo isset($eventoEditar) ? $eventoEditar['Puntos'] : ''; ?>"
                        placeholder="Ingrese los puntos" required>

                    <label for="hora">Hora:</label>
                    <input type="time" id="hora" name="hora"
                        value="<?php echo isset($eventoEditar) ? $eventoEditar['Hora_Evento'] : ''; ?>"
                        required>

                    <button type="submit" class="btn"><?php echo isset($eventoEditar) ? 'Actualizar' : 'Guardar'; ?></button>
                </form>
            </div>

            <div class="main-content">
                <h2>Gestión de Eventos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Ubicación</th>
                            <th>Puntos</th>
                            <th>Hora</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $conn = Database::getConnection();
                        $result = $conn->query("SELECT * FROM eventos");
                        while ($evento = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($evento['Codigo_Evento']); ?></td>
                                <td><?php echo htmlspecialchars($evento['Nombre_Evento']); ?></td>
                                <td><?php echo htmlspecialchars($evento['Descripcion_Evento']); ?></td>
                                <td><?php echo htmlspecialchars($evento['Fecha_Evento']); ?></td>
                                <td><?php echo htmlspecialchars($evento['Ubicacion_Evento']); ?></td>
                                <td><?php echo htmlspecialchars($evento['Puntos']); ?></td>
                                <td><?php echo htmlspecialchars($evento['Hora_Evento']); ?></td>
                                <td>
                                    <!-- Botón para editar -->
                                    <a href="/App/view/adminview/editar_evento.php?accion=editar&codigo=<?php echo htmlspecialchars($evento['Codigo_Evento']); ?>" class="btn-edit"
                                        onclick="return confirm('¿Estas seguro de que deseas editar este evento?');">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <!-- Botón para eliminar -->
                                    <a href="/App/controllers/admincontrollers/EventoController.php?accion=eliminar&codigo=<?php echo htmlspecialchars($evento['Codigo_Evento']); ?>" class="btn-delete"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>