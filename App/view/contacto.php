<?php
// Verificar si se enviaron datos del formulario
if (isset($_POST['enviar'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            title: 'Inicia sesión primero',
            text: 'Para enviar un mensaje debes iniciar sesión.',
            icon: 'warning',
            confirmButtonText: 'Ir a iniciar sesión',
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/App/view/login.php';
            }
        });
    </script>";
    exit; // Finalizar ejecución del script después de la alerta
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto</title>

  <link rel="icon" href="/iconos/planta.ico">
  <link rel="stylesheet" type="text/css" href="../../styles/reset.css">
  <link rel="stylesheet" type="text/css" href="../../styles/global.css">
  <link rel="stylesheet" type="text/css" href="../../styles/contacto-styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/index.php">Inicio</a></li>
        <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/nosotros.html">Nosotros</a></li>
        <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/eventos.html">Eventos</a></li>
        <li class="header__navigation-li"><a class="header__navigation-item header__navigation-item--selected" href="/App/view/contacto.php">Contacto</a></li>
        <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/recompensas.php">Recompensas</a></li>
        <li class="header__navigation-li">
          <a class="header__navigation-item2" href="/App/view/registrarse.php">
            <i class="fa-solid fa-user"></i>
            <span style="margin-left: 4px;">Registrarse</span>
          </a>
          <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/login.php">Iniciar Sesión</a></li>
        </li>
      </ul>
    </nav>
  </header>

  <main>
    <div class="padre__main">
    <img src="/public/images/image contacto_Mesa de trabajo 1.png " alt="" class="contac__image">
    <div class="formulario">
      <form class="form" name="contact-form" action="" method="POST">
        <div class="form-header">
          Formulario de contacto
        </div>
        <div class="form-body">
          <div>
            <label class="label">Documento:</label>
            <input class="input-text" type="number" name="Documento" placeholder="Digite su Numero Documento">
          </div>
          <div>
            <label class="label">Nombre:</label>
            <input class="input-text" type="text" name="txtNombre" placeholder="Escriba su nombre">
          </div>
          <div>
            <label class="label">Apellido:</label>
            <input class="input-text" type="text" name="txtApellido" placeholder="Escribe sus apellidos">
          </div>
          <div>
            <label class="label">Email:</label>
            <input class="input-text" type="text" name="txtEmail" placeholder="Escriba su correo">
          </div>
         
          <div>
            <label class="label" for="Mensaje">Mensaje:</label>
            <textarea name="Mensaje" id="mensaje" rows="6" cols="60" placeholder="Deja tu comentario aquí"></textarea>
          </div>
        </div>
        <input class="button" type="submit" name="enviar" value="Enviar" onclick="checkLogin()">
      </form>
    </div>

    <img src="/public/images/image2contact_Mesa de trabajo 1.png" alt="" class="contac__image">
    <div class="whatsapp-link">
      <p style="color: green; font-size: 20px; font-weight: bold; line-height: 1.3;">Contáctanos por WhatsApp <br> presionando aquí..!</p>
      <span class="whatsapp__icons">
        <a href="https://wa.me/+573053375419" target="_blank">
          <i class="fa-brands fa-square-whatsapp" style="color: green; font-size: 50px;"></i>
        </a>
      </span>
    </div> 
  </div>
  <img src="/public/images/imagecontac3_Mesa de trabajo 1.png" alt="" class="contact__image2">
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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function checkLogin() {
      // Verificar si el usuario está logueado
      // En este caso, sólo simula una verificación (si no está logueado, muestra la alerta)
      let isLoggedIn = false; // Cambia esta variable si se puede verificar si el usuario está logueado

      if (!isLoggedIn) {
        Swal.fire({
            title: 'Inicia sesión primero',
            text: 'Para enviar un mensaje debes iniciar sesión.',
            icon: 'warning',
            confirmButtonText: 'Ir a iniciar sesión',
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/App/view/login.php';
            }
        });
        event.preventDefault(); // Evita que el formulario se envíe
      }
    }
    
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
