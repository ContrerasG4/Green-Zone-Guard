<?php
session_start();
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

if (!isset($_SESSION['Documento']) || !isset($_SESSION['Nombre'])) {
  echo "<script>
    alert('Para acceder a este apartado debe iniciar sesion primero');
    window.location.href = '/App/view/login.php';
  </script>";
  exit();
}



$ID = $_SESSION['Documento'];
$Usuario = $_SESSION['Nombre'];
$Apellidos = $_SESSION['Apellidos'];
$Email = $_SESSION['Email'];

$conn = new mysqli('localhost', 'root', '', 'greenzoneguard');
if ($conn->connect_error) {
  die('Error' . $conn->connect_error);
}
$Mensaje = "";

if (isset($_POST['enviar'])) {
  $Mensaje = $_POST['Mensaje'];
  $sql = "INSERT INTO contactos (documento,nombre,apellido,email,mensaje) value ('$ID','$Usuario','$Apellidos','$Email','$Mensaje')";
  if ($conn->query($sql) === true) {
    echo "<script> alert('Mensaje enviado correctamente, $Usuario') </script>";
  }
}
$conn->close();

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto</title>

  <link rel="icon" href="/iconos/planta.ico">

  <link rel="stylesheet" type="text/css" href="/styles/reset.css">
  <link rel="stylesheet" type="text/css" href="/styles/global.css">
  <link rel="stylesheet" type="text/css" href="/styles/contacto-styles.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<header class="header">
        <div>
            <h1 class="header__title" id="titulo">"GREEN ZONE GUARD"</h1>
            <p class="header__parrafo">Guardianes de zona verde</p>
        </div>
        <nav class="header__navigation">
            <ul class="header__navigation-list">
                <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/viewsesion/indexsesion.php">Inicio</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/nosotrossesion.html">Nosotros</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/eventossesion.html">Eventos</a></li>
                <li class="header__navigation-li"><a class="header__navigation-item header__navigation-item--selected" href="/App/view/html/contactosesion.php">Contacto</a></li>
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
    <div class="padre__main">

      <img src="/public/images/image contacto_Mesa de trabajo 1.png " alt="" class="contac__image">

      <div>
        <form class="form" name="contact-form" action="/App/view/html/contactosesion.php" method="POST">
          <div class="form-header">
            Formulario de contacto
          </div>

          <div class="form-body">

            <div>
              <label class="label">Documento:</label>
              <input class="input-text" type="number" name="Documento" placeholder="Escriba su nombre" value="<?php echo $_SESSION['Documento'] ?>" readonly>
            </div>

            <div>
              <label class="label">Nombre:</label>
              <input class="input-text" type="text" name="txtNombre" placeholder="Escriba su nombre" value="<?php echo $_SESSION['Nombre'] ?>" readonly>
            </div>

            <div>
              <label class="label">Apellido:</label>
              <input class="input-text" type="text" name="txtApellido" placeholder="Escribe sus apellidos" value="<?php echo $_SESSION['Apellidos'] ?>" readonly>
            </div>

            <div>
              <label class="label">Email:</label>
              <input class="input-text" type="text" name="txtEmail" placeholder="Escriba su correo" value="<?php echo $_SESSION['Email'] ?>" readonly>
            </div>

            <!--<div>
            <label class="label">Telefono:</label>
            <input class="input-text" type="text" name="txtTelefono" placeholder="Escribe su telefono">
          </div>-->

            <div>
              <label class="label" for="Mensaje">Mensaje:</label>
              <textarea name="Mensaje" id="Mensaje" rows="6" cols="60" placeholder="Deja tu comentario aquí" required></textarea>
            </div>
          </div>

          <input class="button" type="submit" name="enviar" value="Enviar">
        </form>
      </div>

      <img src="/public/images/image2contact_Mesa de trabajo 1.png" alt="" class="contac__image">

      <div class="whatsapp-link">
        <p style="color: green; font-size: 20px; font-weight: bold; line-height: 1.3;">Contactanos por whatsapp <br> presionando aqui..!</p>
        <br>
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