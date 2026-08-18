<?php

require_once __DIR__ . '/../../controllers/controller_hparticipacion.php';
$controlador = new historialcontroller();
$historial = $controlador->manejar();
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historial de Participación</title>
    <link rel="stylesheet" type="text/css" href="/styles/reset.css">
    <link rel="stylesheet" type="text/css" href="/styles/global.css">
    <link rel="stylesheet" type="text/css" href="/styles/panel-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body>

    <main>
        <h1 class="titulo__principal">"PROTEGE Y CUIDA NUESTRAS ZONAS VERDES"</h1>
        <div class="container">
            <?php include __DIR__ . '/layouts/Menu_PanelAdmin.php'; ?>

            <div class="main-content">
                <h2>Historial De Participación</h2>

                <table>
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nombre de Usuario</th>
                            <th>Nombre del Evento</th>
                            <th>Puntos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($historial)) : ?>
                            <?php foreach ($historial as $fila) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($fila['Documento']) ?></td>
                                    <td><?= htmlspecialchars($fila['Nombre_Usuario']) ?></td>
                                    <td><?= htmlspecialchars($fila['Nombre_Evento']) ?></td>
                                    <td><?= htmlspecialchars($fila['puntos']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">No hay datos disponibles.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <form method="post" action="">
                    <button type="submit" id="eliminar" name="eliminar" class="btn" onclick="return confirm('¿Seguro que deseas eliminar todos los registros?')">Eliminar Registros</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <ul class="footer__ul">
            <li class="footer__icons"><a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-square-facebook"></i></a></li>
            <li class="footer__icons"><a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li class="footer__icons"><a href="https://www.tiktok.com" target="_blank"><i class="fa-brands fa-tiktok"></i></a></li>
        </ul>
        <p class="parrafo">&copy; 2024 Green Zone Guard. Todos los derechos reservados.</p>
        <div class="hora">
            <p><span id="hora"></span></p>
            <p><span id="fecha"></span></p>
        </div>
    </footer>

    <script>
        function actualizarHora() {
            const ahora = new Date();
            document.getElementById('hora').textContent =
                ahora.getHours().toString().padStart(2, '0') + ':' +
                ahora.getMinutes().toString().padStart(2, '0') + ':' +
                ahora.getSeconds().toString().padStart(2, '0');
        }

        setInterval(actualizarHora, 1000);
        actualizarHora();

        const fecha = new Date();
        document.getElementById("fecha").textContent =
            fecha.getDate() + "/" + (fecha.getMonth() + 1) + "/" + fecha.getFullYear();
    </script>

</body>

</html>