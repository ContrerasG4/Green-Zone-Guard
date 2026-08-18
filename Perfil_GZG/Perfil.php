<?php
session_start();

// Inicializar variables para los mensajes de éxito
$foto_actualizada = false;
$datos_actualizados = false;

// Verificar si se ha enviado el formulario
if (isset($_POST['submit'])) {
  // Verificar si el archivo fue cargado sin errores
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    // Obtener datos del archivo
    $foto_tmp = $_FILES['foto']['tmp_name'];  // Archivo temporal
    $foto_nombre = uniqid('perfil_', true) . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

    // Validación del tipo de archivo (solo imágenes)
    $tipo_archivo = mime_content_type($foto_tmp);
    $tipos_validos = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($tipo_archivo, $tipos_validos)) {
      echo "<script>alert('Solo se permiten imágenes JPG, PNG o GIF');</script>";
      exit;
    }

    // Validación del tamaño máximo (por ejemplo, 5 MB)
    $tamano_maximo = 5 * 1024 * 1024;  // 5 MB en bytes
    if ($_FILES['foto']['size'] > $tamano_maximo) {
      echo "<script>alert('El archivo es demasiado grande, el tamaño máximo permitido es 5 MB');</script>";
      exit;
    }

    // Ruta en la que se almacenará la foto
    $ruta_destino = 'fotos_perfil/' . $foto_nombre;

    // Mover el archivo a la carpeta 'fotos_perfil'
    if (move_uploaded_file($foto_tmp, $ruta_destino)) {
      // Conectar a la base de datos
      try {
        // Configura la conexión a la base de datos
        $pdo = new PDO("mysql:host=localhost;dbname=greenzoneguard", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener el Documento del usuario de la sesión
        $documento = $_SESSION['Documento'];

        // Guardar la ruta de la foto en la base de datos
        $query = "UPDATE usuario SET Foto_perfil = ? WHERE Documento = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$ruta_destino, $documento]);

        echo "<script>alert('Foto subida correctamente');</script>";
      } catch (PDOException $e) {
        echo "<script>alert('Error al conectar a la base de datos: " . $e->getMessage() . "');</script>";
      }
    } else {
      echo "<script>alert('Error al mover el archivo');</script>";
    }
  } else {
    echo "<script>alert('Error en la carga de la foto');</script>";
  }
}

// Conectar a la base de datos
try {
  // Configura la conexión a la base de datos
  $pdo = new PDO("mysql:host=localhost;dbname=greenzoneguard", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Verificar si el usuario ha iniciado sesión
  if (isset($_SESSION['Documento'])) {
    $documento = $_SESSION['Documento'];

    // Consultar la base de datos para obtener la ruta de la foto de perfil
    $query = "SELECT Foto_perfil FROM usuario WHERE Documento = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$documento]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario tiene una foto de perfil
    if ($usuario && $usuario['Foto_perfil']) {
      $ruta_foto = $usuario['Foto_perfil'];
    } else {
      // Si no tiene foto, usar una imagen predeterminada
      $ruta_foto = 'fotos_perfil/default.jpg';
    }
  } else {
    // Si no hay sesión activa, redirigir o mostrar mensaje
    echo "<script>alert('No haz iniciado sesion');</script>";
  }
} catch (PDOException $e) {
  echo "Error al conectar a la base de datos: " . $e->getMessage();
}

// Verificar si se ha enviado el formulario para actualizar los datos
if (isset($_POST['submit'])) {
  // Obtener los nuevos datos del formulario
  $nuevo_nombre_usuario = trim($_POST['new-username']);
  $nuevo_email = trim($_POST['new-email']);

  try {
    // Configura la conexión a la base de datos
    $pdo = new PDO("mysql:host=localhost;dbname=greenzoneguard", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el Documento del usuario de la sesión
    $documento = $_SESSION['Documento'];

    // Si algún campo viene vacío, obtener el valor actual de la base de datos
    if (empty($nuevo_nombre_usuario) || empty($nuevo_email)) {
      $query = "SELECT Nombre_usuario, Email FROM usuario WHERE Documento = ?";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$documento]);
      $usuario_actual = $stmt->fetch(PDO::FETCH_ASSOC);

      // Usar los valores actuales si los campos están vacíos
      if (empty($nuevo_nombre_usuario)) {
        $nuevo_nombre_usuario = $usuario_actual['Nombre_usuario'];
      }
      if (empty($nuevo_email)) {
        $nuevo_email = $usuario_actual['Email'];
      }
    }

    // Actualizar los datos en la base de datos
    $query = "UPDATE usuario SET Nombre_usuario = ?, Email = ? WHERE Documento = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$nuevo_nombre_usuario, $nuevo_email, $documento]);

    // Actualizar las variables de sesión con los nuevos datos
    $_SESSION['Nombre_usuario'] = $nuevo_nombre_usuario;
    $_SESSION['Email'] = $nuevo_email;

    // Mostrar un mensaje de éxito
    echo "<script>alert('Datos actualizados correctamente');</script>";
  } catch (PDOException $e) {
    echo "<script>alert('Error al actualizar los datos: " . $e->getMessage() . "');</script>";
  }
}

try {
  // Conectar a la base de datos
  $pdo = new PDO("mysql:host=localhost;dbname=greenzoneguard", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Asegúrate de que el documento del usuario esté en la sesión
  if (isset($_SESSION['Documento'])) {
    // Obtener el Documento del usuario 
    $documento = $_SESSION['Documento'];

    // Consulta para obtener los puntos del usuario desde la base de datos
    $query = "SELECT Puntos FROM usuario WHERE Documento = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$documento]);

    // Obtener los puntos
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontraron puntos para el usuario
    if ($result) {
      // Almacenar los puntos en una variable de sesión
      $_SESSION['Puntos'] = $result['Puntos'];
    } else {
      echo "<script>alert('No se encontraron puntos para este usuario.');</script>";
    }
  } else {
    echo "No se ha iniciado sesión o no se ha encontrado el documento del usuario.";
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

//Insignias
try {
  $pdo = new PDO("mysql:host=localhost;dbname=greenzoneguard", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Obtener el Documento del usuario de la sesión
  $documento = $_SESSION['Documento'];

  // Obtener los puntos del usuario desde la base de datos
  $stmt = $pdo->prepare("SELECT Puntos FROM usuario WHERE Documento = ?");
  $stmt->execute([$documento]);
  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
  $puntos = $usuario['Puntos']; // Puntos del usuario

} catch (PDOException $e) {
  echo "Error de conexión: " . $e->getMessage();
  exit;
}

// Determinar qué insignias desbloquear en base a los puntos
$insignias = [];
if ($puntos >= 100) {
  $insignias[] = 'Bronce.jpg'; // Insignia de bronce
}
if ($puntos >= 200) {
  $insignias[] = 'Plata.jpg'; // Insignia de Plata
}
if ($puntos >= 300) {
  $insignias[] = 'Oro.jpg'; // Insignia de Oro
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Mi Perfil</title>

  <link rel="stylesheet" type="text/css" href="styles/reset.css">
  <link rel="stylesheet" type="text/css" href="styles/global.css">
  <link rel="stylesheet" type="text/css" href="styles_perfil.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/viewsesion/indexsesion.php">Inicio</a></li>
        <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/nosotrossesion.html">Nosotros</a></li>
        <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/eventossesion.html">Eventos</a></li>
        <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/contactosesion.php">Contacto</a></li>
        <li class="header__navigation-li"><a class="header__navigation-item" href="/App/view/html/recompensassesion.php">Recompensas</a></li>
        <li class="header__navigation-li">
          <a class="header__navigation-item2 header__navigation-item--selected" href="../../../Perfil_GZG/Perfil.php">
            <i class="fa-solid fa-user"></i>
            <span style="margin-left: 4px;">Perfil</span>
        <li class="header__navigation-li"><a class="header__navigation-item" href="../App/view/logout.php">Salir</a></li>
        </a>
        </li>
      </ul>
    </nav>
  </header>

  <main>
    <h1 class="titulo__principal">"MI PERFIL"</h1>
    <!-- Sección del perfil -->
    <div class="profile-container">
      <h1>Bienvenido a tu perfil, <span id="user-name"><?php echo $_SESSION["Nombre"]; ?></span></h1>

      <div class="profile-info">
        <img src="<?php echo "$ruta_foto"; ?>" alt="Foto de perfil" class="profile-avatar">
        <div class="profile-details">
          <p><strong>Nombre de usuario:</strong> <span id="name"><?php echo $_SESSION["Nombre_usuario"]; ?></span></p>
          <p><strong>Email:</strong> <span id="email"><?php echo $_SESSION["Email"]; ?></span></p>
          <p><strong>Puntos obtenidos:</strong> <span id="events-count"><?php echo $_SESSION['Puntos']; ?></span></p>
          <p><strong>Insignia(s) obtenida(s):</strong></p>
          <div id="insignias-container">
            <?php if (!empty($insignias)): ?>
              <div class="insignias-container">
                <?php foreach ($insignias as $insignia): ?>
                  <img src="insignias/<?php echo htmlspecialchars($insignia); ?>" alt="Insignia <?php echo htmlspecialchars($insignia); ?>" style="width:80px; margin:10px;">
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

      <!-- Formulario de edición -->
      <form id="edit-form" action="Perfil.php" method="POST" enctype="multipart/form-data" class="edit-form">
        <h2>Editar Información</h2>
        <input type="file" id="foto" name="foto" accept="image/*">
        <label for="edit-name">Nuevo Nombre de Usuario:</label>
        <input type="text" id="edit-name" name="new-username" placeholder="Escriba su nuevo nombre" <?php echo $_SESSION["Nombre_usuario"]; ?>>
        <label for="edit-email">Nuevo Email:</label>
        <input type="email" id="edit-email" name="new-email" placeholder="Escriba su nuevo correo" <?php echo $_SESSION["Email"]; ?>>
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
  </script>
  <script src="scripts.js"></script>
</body>

</html>