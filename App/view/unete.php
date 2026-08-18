<?php
require_once __DIR__ . '/../controllers/Controller_unete.php';
$controller = new unetecontroller();
$eventos = $controller->mostrarevento();

// Validar si el usuario está logueado
if (!isset($_SESSION['Documento']) || !isset($_SESSION['Nombre_usuario'])) {
    echo "<script>alert('Debe iniciar sesión para acceder.'); window.location.href = '/App/view/login.php';</script>";
    exit();
}

$ID = $_SESSION['Documento'];
$Usuario = $_SESSION['Nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Únete a la Revolución Verde</title>
    <link rel="stylesheet" href="../../styles/reset.css">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/unete-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="../iconos/planta.ico">
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
                <li class="header__navigation-li"><a class="header__navigation-item" href="logout.php">Salir</a></li>
                </a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div>
            <h1 class="title__main">Unete a la revolución verde</h1>
            <div class="container">
                <article class="unete__article">
                    <h2 class="unete__title">¡Tu ciudad te necesita!</h2>
                    <p>Te invitamos a ser parte de un cambio positivo en nuestra comunidad, ven y participa de los eventos de limpieza, pintura y tala de árboles en nuestro parque y ayuda a transformar este hermoso espacio en un lugar más vibrante y acogedor para todos.</p>
                </article>

                <form class="form" name="contact-form" action="" method="POST">
                    <div class="form-header">Formulario de participación</div>

                    <div class="form-body">
                        <div>
                            <label class="label">Documento ID:</label>
                            <input class="input-text" type="text" name="Documento" id="Documento" value="<?php echo $_SESSION['Documento'] ?>" required readonly>
                        </div>

                        <div>
                            <label class="label">Usuario:</label>
                            <input class="input-text" type="text" name="Usuario" id="Usuario" value="<?php echo $_SESSION['Nombre_usuario'] ?>" required readonly>
                        </div>

                        <div>
                            <label class="label">Evento:</label>
                            <select class="input-text" name="Codigo_Evento" id="Codigo_Evento" required>
                                <option value="">Selecciona un evento</option>
                                <?php
                                $conn = new mysqli('localhost', 'root', '', 'greenzoneguard');
                                $sqlEventos = "SELECT Codigo_Evento, Nombre_Evento, Puntos, Descripcion_Evento FROM eventos";
                                $resultEventos = $conn->query($sqlEventos);
                                while ($evento = $resultEventos->fetch_assoc()) {
                                    echo "<option value='{$evento['Codigo_Evento']}' data-puntos='{$evento['Puntos']}' data-descripcion='{$evento['Descripcion_Evento']}'>{$evento['Nombre_Evento']}</option>";
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>

                        <div>
                            <label class="label">Puntos:</label>
                            <input class="input-text" type="text" id="Puntos" name="Puntos" readonly>
                        </div>

                        <div>
                            <label class="label">Descripcion</label>
                            <textarea class="input-text" name="Descripcion_Evento" id="Descripcion_Evento" rows="4" cols="200" required readonly></textarea>
                        </div>
                    </div>

                    <input class="button" type="submit" value="Unirse" name="Unirse">
                </form>

                <article class="unete__article">
                    <h2 class="unete__title">¿Por qué participar?</h2>
                    <p>Tu esfuerzo ayudará a mejorar la apariencia del parque y contribuirá a un ambiente más saludable para toda la comunidad. Con tu participación, estarás apoyando la conservación del medio ambiente y la importancia de mantener nuestros espacios limpios.</p>

                    <h2 class="article__uneteh2">¡Inscríbete, prepárate y participa..!</h2>
                    <img src="/public/images/caneca_Mesa de trabajo 1.png" alt="" class="unete__image2" style="width: 180px;">
                </article>
            </div>
        </div>
        <img src="/public/images/imagecontac3_Mesa de trabajo 1.png" alt="" class="unete__image" style="width: 715px;">
    </main>

    <footer>
        <ul class="footer__ul">
            <li class="footer__icons">
                <a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-square-facebook"></i></a>
            </li>
            <li class="footer__icons">
                <a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </li>
            <li class="footer__icons">
                <a href="https://www.tiktok.com" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
            </li>
        </ul>
        <p class="parrafo">&copy; 2024 Mi Página Web. Todos los derechos reservados Green Zone Guard</p>
        <div class="hora">
            <p><span id="hora"></span></p>
            <p><span id="fecha"></span></p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectEvento = document.getElementById("Codigo_Evento");
            const puntosInput = document.getElementById("Puntos");
            const descripcionTextarea = document.getElementById("Descripcion_Evento");

            selectEvento.addEventListener("change", function() {
                const selectedOption = selectEvento.options[selectEvento.selectedIndex];

                puntosInput.value = selectedOption.getAttribute("data-puntos") || '';
                descripcionTextarea.value = selectedOption.getAttribute("data-descripcion") || '';
            });
        });
    </script>
</body>

</html>