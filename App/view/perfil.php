<?php
session_start();

// Verificar si los datos del usuario ya están en la sesión
if (!isset($_SESSION['nombreUsuario']) || !isset($_SESSION['email']) || !isset($_SESSION['puntos'])) {
    // Si faltan datos, redirigir al controlador para que los obtenga
    header("Location: /App/controllers/controller_perfil.php");
    exit();
}

$nombre = $_SESSION['nombre'];
$nombreUsuario = $_SESSION['nombreUsuario'];
$email = $_SESSION['email'];
$puntos = $_SESSION['puntos'];
$rutaFoto = $_SESSION['rutaFoto'] ?? '/Perfil_GZG/fotos_perfil/';
$insignias = $_SESSION['insignias'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inicio</title>

    <link rel="stylesheet" type="text/css" href="../../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../../styles/global.css">
    <link rel="stylesheet" type="text/css" href="../../styles/index-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/Perfil_GZG/styles_perfil.css">
    <link rel="icon" href="/public/images/iconos/planta.ico">
    <link rel="shortcut icon" href="/public/images/iconos/planta.ico" type="image/x-icon">

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
                <li class="header__navigation-li"><a class="header__navigation-item" href="../view/logout.php">Salir</a></li>
                </a>
                </li>
            </ul>
        </nav>
    </header>


    <main>
        <h1 class="titulo__principal">"MI PERFIL"</h1>
        <div class="profile-container">
            <h1>Bienvenido a tu perfil, <span id="user-name"><?php echo htmlspecialchars($nombre); ?></span></h1>

            <div class="profile-info">

                <img src="<?php echo htmlspecialchars('/Perfil_GZG/' . $rutaFoto); ?>" alt="Foto de perfil" class="profile-avatar">
                <div class="profile-details">
                    <p><strong>Nombre de usuario:</strong> <span id="name"><?php echo htmlspecialchars($nombreUsuario); ?></span></p>
                    <p><strong>Email:</strong> <span id="email"><?php echo htmlspecialchars($email); ?></span></p>
                    <p><strong>Puntos obtenidos:</strong> <span id="events-count"><?php echo htmlspecialchars($puntos); ?></span></p>
                    <p><strong>Insignia(s) obtenida(s):</strong></p>
                    <div id="insignias-container">
                        <?php if (!empty($insignias)): ?>
                            <div class="insignias-container">
                                <?php foreach ($insignias as $insignia): ?>
                                    <img src="/Perfil_GZG/insignias/<?php echo htmlspecialchars($insignia); ?>" alt="Insignia <?php echo htmlspecialchars($insignia); ?>" style="width:80px; margin:10px;">
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>No has desbloqueado ninguna insignia aún.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="edit-profile">
                <button onclick="toggleEditProfile()">Editar Perfil</button>
            </div>

            <form id="edit-form" action="/App/controllers/controller_perfil.php" method="POST" enctype="multipart/form-data" class="edit-form">
                <h2>Editar Información</h2>
                <input type="file" id="foto" name="foto" accept="image/*">
                <label for="edit-name">Nuevo Nombre de Usuario:</label>
                <input type="text" id="edit-name" name="new-username" placeholder="Escriba su nuevo nombre" value="<?php echo htmlspecialchars($nombreUsuario ?? ''); ?>">
                <label for="edit-email">Nuevo Email:</label>
                <input type="email" id="edit-email" name="new-email" placeholder="Escriba su nuevo correo" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                <input type="hidden" name="action" value="1">
                <input type="submit" name="submit" class="btn-save" value="Guardar" style="background-color: #4CAF50; color: white;">
            </form>
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

        function toggleEditProfile() {
            const editForm = document.getElementById('edit-form');
            editForm.style.display = (editForm.style.display === 'none' || editForm.style.display === '') ? 'block' : 'none';
        }
        document.addEventListener('DOMContentLoaded', function() {
            const editForm = document.getElementById('edit-form');
            editForm.style.display = 'none';
        });
    </script>
    <script src="/Perfil_GZG/scripts.js"></script>
</body>

</html>