<?php
session_start();
require_once(__DIR__ . '/../../controllers/Controller_index_sesion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="/styles/reset.css">
    <link rel="stylesheet" type="text/css" href="/styles/global.css">
    <link rel="stylesheet" type="text/css" href="/styles/index-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="../../iconos/planta.ico">
    <link rel="shortcut icon" href="../../iconos/planta.ico" type="image/x-icon">

</head>

<body>
    <header class="header">
        <div>
            <h1 class="header__title" id="titulo">"GREEN ZONE GUARD"</h1>
            <p class="header__parrafo">Guardianes de zona verde</p>
        </div>
        <nav class="header__navigation">
            <ul class="header__navigation-list">
                <li class="header__navigation-li"><a class="header__navigation-item header__navigation-item--selected" href="/App/view/viewsesion/indexsesion.php">Inicio</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/nosotrossesion.html">Nosotros</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/eventossesion.html">Eventos</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/contactosesion.php">Contacto</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/recompensassesion.php">Recompensas</a></li>
                <li class="header__navigation-li">
                    <a class="header__navigation-item2" href="/App/view/perfil.php">
                        <i class="fa-solid fa-user"></i>
                        <span style="margin-left: 4px;">Perfil</span>
                <li class="header__navigation-li"><a class="header__navigation-item" href="../logout.php">Salir</a></li>
                </a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <h1 class="titulo__principal">"PROTEGE Y CUIDA NUESTRAS ZONAS VERDES"</h1>
        <div class="contenedor-informacion">
            <h2><?php echo $Titulo; ?></h2>
            <br>
            <p><?php echo $Mensaje; ?></p>
            <!-- Puedes agregar más contenido aquí -->
        </div>

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
</body>

</html>