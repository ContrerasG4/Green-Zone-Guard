<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Eventos</title>
  <link rel="stylesheet" type="text/css" href="/styles/reset.css">
  <link rel="stylesheet" type="text/css" href="/styles/global.css">
  <link rel="stylesheet" type="text/css" href="/styles/panel-styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

  <link rel="icon" href="/iconos/planta.ico">
  <link rel="shortcut icon" href="/iconos/planta.ico" type="image/x-icon">

</head>

<body>

  <main>
    <h1 class="titulo__principal">"PROTEGE Y CUIDA NUESTRAS ZONAS VERDES"</h1>
    <br>
    <div class="container">
      <!-- Barra lateral de navegación -->
      <?php include __DIR__ . '/../adminview/layouts/Menu_PanelAdmin.php'; ?>

      <!-- Sección principal -->
      <div class="main-content">
        <h2>Lista de Administradores</h2>

        <!-- Tabla de eventos -->
        <table>
          <thead>
            <tr>
              <th>Título</th>
              <th>Mensaje</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($datos && $datos->num_rows > 0): ?>
              <?php while ($row = $datos->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['Titulo']) ?></td>
                  <td><?= htmlspecialchars($row['Mensaje']) ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="2">No hay información disponible.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <div class="event-form">
          <form action="" method="POST">
            <label for="Titulo">Titulo</label>
            <input type="text" name="Titulo" id="Titulo">

            <label for="Mensaje">Mensaje:</label>
            <input type="text" name="Mensaje" id="Mensaje">

            <button type="submit" name="Actualizar" class="btn">Actualizar mensaje</button>
          </form>
        </div>
      </div>
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
  <script type="text/javascript" src="/Scripts/Añadiradmins.js"></script>
</body>

</html>