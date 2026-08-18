<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recompensas</title>
    <link rel="stylesheet" type="text/css" href="/styles/reset.css">
    <link rel="stylesheet" type="text/css" href="/styles/global.css">
    <link rel="stylesheet" type="text/css" href="/styles/recompensa-styles.css">
    <link rel="stylesheet" href="/../styles/recompnsas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="../iconos/planta.ico">
    <link rel="shortcut icon" href="../iconos/planta.ico" type="image/x-icon">


</head>

<body>
    <header class="header">
        <div>
            <h1 class="header__title" id="titulo">"GREEN ZONE GUARD"</h1>
            <p class="header__parrafo">Guardianes de zona verde</p>
        </div>
        <nav class="header__navigation">
            <ul class="header__navigation-list">
                <li class="header__navigation-li"><a class="header__navigation-item"
                        href="/App/view/viewsesion/indexsesion.php">Inicio</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item"
                        href="/App/view/html/nosotrossesion.html">Nosotros</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item"
                        href="/App/view/html/eventossesion.html">Eventos</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item"
                        href="/App/view/html/contactosesion.php">Contacto</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item header__navigation-item--selected"
                        href="/App/view/html/recompensassesion.php">Recompensas</a></li>
                <li class="header__navigation-li">
                    <a class="header__navigation-item2" href="../../../Perfil_GZG/Perfil.php">
                        <i class="fa-solid fa-user"></i>
                        <span style="margin-left: 4px;">Perfil</span>
                <li class="header__navigation-li"><a class="header__navigation-item" href="../logout.php">Salir</a></li>
                </a>
                </li>
            </ul>
        </nav>
    </header>


    <main class="recompensas">
        <section class="titulo-seccion">
            <h1>¡Gana Recompensas Por Cuidar Nuestras Zonas Verdes!</h1>
            <p>Descubre las increíbles recompensas que puedes ganar mientras proteges nuestros espacios.</p>
            <br>
        </section>
        <div class="image-gallery">
            <?php
      // Ejemplo de conexión a la base de datos
      $conexion = new mysqli("localhost", "root", "", "greenzoneguard");
      if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
      }

      // Consulta para obtener imágenes e información adicional
      $sql = "SELECT * FROM recompensas";
      $result_tareas = $conexion->query($sql);

      if ($result_tareas->num_rows > 0) {
        while ($row = $result_tareas->fetch_assoc()) {
          // Calcular las unidades restantes
          $cantidad_restante = max(0, $row['cantidad'] - $row['entregadas']);

          if ($row['foto']) { ?>
            <div class="image-container">
                <!-- Imagen con información adicional almacenada en atributos -->
                <img src="../uploads/<?php echo $row['foto']; ?>" alt="Imagen"
                    data-description="<?php echo htmlspecialchars($row['descripcion']); ?>"
                    data-puntos="<?php echo htmlspecialchars($row['puntos']); ?>"
                    data-cantidad="<?php echo htmlspecialchars($row['cantidad']); ?>"
                    data-entregadas="<?php echo htmlspecialchars($row['entregadas']); ?>"
                    data-id="<?php echo htmlspecialchars($row['id']); ?>" data-restantes="
        <?php echo $cantidad_restante; ?>" onclick="showDescription(this)">
            </div>
            <?php } else { ?>
            <div>Sin Foto</div>
            <?php }
        }
      } else {
        echo "<p>No hay imágenes disponibles.</p>";
      }

      $conexion->close();
      ?>
        </div>


        <!-- Modal -->
        <div id="descriptionModal">
            <div class="modal-header">
                Información Detallada
                <button id="closeModal">&times;</button>
            </div>
            <div class="modal-content">
                <div>
                    <strong>Descripción</strong>
                    <span id="modalDescription">No disponible</span>
                </div>
                <div>
                    <strong>Puntos Requeridos</strong>
                    <span id="modalPuntos">No disponible</span>
                </div>
                <div>
                    <strong>Cantidad Disponible</strong>
                    <span id="modalCantidad">No disponible</span>
                </div>
                <div>
                    <strong>Cantidad Entregada</strong>
                    <span id="modalEntregadas">No disponible</span>
                </div>
                <div>
                    <strong>Disponibles</strong>
                    <span id="modalDisponibles">No disponible</span>
                </div>

                <div>
                    <!-- Botón para reclamar recompensa -->
                    <form id="claimForm" action="verificar_recompensa.php" method="POST">
                        <input type="hidden" name="id" id="rewardIdInput">
                        <button type="submit">Reclamar Recompensa</button>
                    </form>

                </div>
            </div>
        </div>
        <div id="modalBackdrop"></div>


        <script>
        // Mostrar la información en el modal
        function showDescription(image) {
            const description = image.getAttribute('data-description');
            const puntos = image.getAttribute('data-puntos');
            const cantidad = image.getAttribute('data-cantidad');
            const entregadas = image.getAttribute('data-entregadas');
            const restantes = image.getAttribute('data-restantes');
            const rewardId = image.getAttribute('data-id'); // ID único de la recompensa

            // Asignar valores a los elementos del modal
            document.getElementById('modalDescription').textContent = description || 'No disponible';
            document.getElementById('modalPuntos').textContent = puntos || 'No disponible';
            document.getElementById('modalCantidad').textContent = cantidad || 'No disponible';
            document.getElementById('modalEntregadas').textContent = entregadas || 'No disponible';
            document.getElementById('modalDisponibles').textContent = restantes || 'No disponible';

            // Asignar el ID de la recompensa al campo oculto del formulario
            document.getElementById('rewardIdInput').value = rewardId || 'No disponible';

            // Mostrar el modal
            document.getElementById('descriptionModal').style.display = 'block';
            document.getElementById('modalBackdrop').style.display = 'block';
        }

        // Cerrar el modal al hacer clic en el botón de cierre
        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('descriptionModal').style.display = 'none';
            document.getElementById('modalBackdrop').style.display = 'none';
        });

        // Cerrar el modal al hacer clic fuera del contenido
        document.getElementById('modalBackdrop').addEventListener('click', () => {
            document.getElementById('descriptionModal').style.display = 'none';
            document.getElementById('modalBackdrop').style.display = 'none';
        });
        </script>

        <!-- Descripción de recompensas -->
        <section class="detalles-recompensas">
            <h2>¿Qué puedes ganar?</h2>
            <p>Desde libretas personalizadas, hasta hermosos bolsos donde podras llevar lo que mas gustes, estas
                recompensas
                están diseñadas para premiar <br> tu esfuerzo y compromiso con el
                cuidados de nuestros parques y se obtienen por la participación a los diferentes eventos de cuidado.
                Mientras
                <br> mas participes mayor sera tu premio (acepta terminos y condiciones).
            </p>
        </section>

        <!-- Niveles de recompensas -->
        <section class="niveles-recompensas">
            <h2>Niveles de Recompensas </h2>
            <div class="nivel">
                <h3>Nivel 1: Eco-Amigable <span class="stars">★</span></h3>
                <br>
                <p>Acumula puntos y gana pequeños obsequios ecológicos.</p>
            </div>
            <div class="nivel">
                <h3>Nivel 2: Guardián Verde <span class="stars">★★</span></h3>
                <br>
                <p>Gana entradas a eventos exclusivos y productos personalizados.</p>
            </div>
            <div class="nivel">
                <h3>Nivel 3: Héroe de Nuetro Parque <span class="stars">★★★</span></h3>
                <br>
                <p>Accede a experiencias VIP y grandes recompensas a eventos en la ciudad.</p>
            </div>
        </section>

        <!-- Beneficios adicionales -->
        <section class="beneficios-adicionales">
            <h2>Beneficios Adicionales</h2>
            <ul>
                <li>Cupones de descuento en tiendas ecológicas.</li>
                <li>Participación en sorteos mensuales de productos.</li>
                <li>Invitaciones a eventos de concienciación ambiental.</li>
            </ul>
        </section>

        <!-- Testimonios -->
        <section class="testimonios">
            <h2>Testimonios</h2>
            <div class="testimonio">
                <p>"He ganado entradas para ir al zoologico y productos increíbles solo por hacer cuidado de mi parque.
                    ¡Es una
                    gran iniciativa!"</p>
                <p class="autor">- Nelsy Hernandez</p>
            </div>
            <div class="testimonio">
                <p>"Participar en esta campaña me ha permitido conocer más sobre la importancia de nuestras zonas
                    verdes, ¡y
                    además he recibido excelentes recompensas!"</p>
                <p class="autor">- Anyer Martinez</p>
            </div>
        </section>
    </main>

    <footer>
        <ul class="footer__ul">
            <li class="footer__icons">
                <a href="https://www.facebook.com" target="_blank">
                    <i class="fa-brands fa-square-facebook"></i></a>
            </li>
            <li class="footer__icons">
                <a href="https://www.instagram.com" target="_blank">
                    <i class="fa-brands fa-instagram"></i></a>
            </li>
            <li class="footer__icons">
                <a href="https://www.tiktok.com" target="_blank">
                    <i class="fa-brands fa-tiktok"></i></a>
            </li>
        </ul>
        <p class="parrafo">&copy; 2024 Mi Página Web. Todos los derechos reservados Green Zone Guard</p>
        <div class="hora">
            <p><span id="hora"></span></p>
            <p><span id="fecha"></span></p>
        </div>
    </footer>

    <script>
    function actualizarHora() {
        const ahora = new Date();
        const horas = ahora.getHours().toString().padStart(2, '0');
        const minutos = ahora.getMinutes().toString().padStart(2, '0');
        const segundos = ahora.getSeconds().toString().padStart(2, '0');
        const horaActual = `${horas}:${minutos}:${segundos}`;
        document.getElementById('hora').textContent = horaActual;


    }
    setInterval(actualizarHora, 1000);

    window.onload = actualizarHora;

    const fechaActual = new Date();
    const dia = fechaActual.getDate();
    const mes = fechaActual.getMonth() + 1;
    const año = fechaActual.getFullYear();


    const fechaFormateada = `${dia}/${mes}/${año}`;
    document.getElementById("fecha").textContent = fechaFormateada;
    </script>

    <script>
    let indice = 0;

    function moverCarrusel(direccion) {
        const carruselItems = document.querySelector('.carrusel-items');
        const items = document.querySelectorAll('.carrusel-items img');
        const itemWidth = items[0].offsetWidth + 20; // Ancho de la imagen + margen
        const totalItems = items.length;

        // Ajustar el índice según la dirección
        indice += direccion;

        // Si el índice es menor a 0, volver al último elemento
        if (indice < 0) {
            indice = totalItems - 1;
        }

        // Si el índice supera el número de elementos, volver al primero
        if (indice >= totalItems) {
            indice = 0;
        }

        // Mover el carrusel según el índice actual
        const offset = -indice * itemWidth; // Cada imagen ocupa su ancho más el margen
        carruselItems.style.transform = `translateX(${offset}px)`;
    }
    </script>

</body>

</html>