<?php
require_once(__DIR__ . '/../../controllers/controllers_consultar.php');

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
<style>
  #Select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    color: #333;
    background-color: #f9f9f9;
    font-size: 20px;
    width: 40%;
    text-align: center;
  }

  button[name="Consultar"] {
    background-color: #28a745;
    /* Color verde */
    color: white;
    /* Color del texto */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;

  }

  button[name="Consultar"]:hover {
    background-color: #218838;
    /* Verde más oscuro al pasar el mouse */
  }

  form {
    height: 284px;

  }

  .btn-verify {
    display: inline-block;
    padding: 6px 10px;
    background-color: #28a745;
    /* Verde */
    color: #fff;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s ease;
  }

  .btn-verify:hover {
    background-color: #218838;
    /* Verde oscuro */
  }
</style>

<body>

  <main>
    <h1 class="titulo__principal">"PROTEGE Y CUIDA NUESTRAS ZONAS VERDES"</h1>
    <br>
    <div class="container">
      <!-- Barra lateral de navegación -->
      <?php include __DIR__ . '/layouts/Menu_PanelAdmin.php'; ?>

      <!-- Sección principal -->
      <div class="main-content">
        <h2>Usuarios inscritos a eventos</h2>

        <!-- Tabla de eventos -->
        <table>
          <thead>
            <tr>
              <td>Documento</td>
              <td>Nombre Usuario</td>
              <td>Acciones</td>
            </tr>
          </thead>
          <tbody>
            <?php
            /** @var mysqli_result $participantes */
            if ($participantes && $participantes->num_rows > 0) {
              while ($row = $participantes->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['Documento']}</td>
                    <td>{$row['Nombre_usuario']}</td>
                    <td>
                      <a href='?accion=eliminar&Documento={$row['Documento']}' class='btn-delete' onclick='return confirm(\"¿Eliminar?\");'>
                        <i class='fa-solid fa-trash'></i>
                      </a>
                      <a href='?accion=verificar&Documento={$row['Documento']}' class='btn-verify' onclick='return confirm(\"¿Verificar?\");'>
                        <i class='fa-solid fa-check'></i>
                      </a>
                    </td>
                  </tr>";
              }
            } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              echo "<script>alert('No se encontraron usuarios');</script>";
            }
            ?>
          </tbody>
        </table>


        <div class="event-form">
          <form action="" method="POST">
            <select name="Select" id="Select">
              <option value="">Seleccione el ID correspondiente al evento</option>
              <?php
              if ($eventos->num_rows > 0) {
                while ($evento = $eventos->fetch_assoc()) {
                  echo "<option value='{$evento['Codigo_Evento']}'>{$evento['Nombre_Evento']}</option>";
                }
              }
              ?>
            </select>
            <button type="submit" name="Consultar">Consultar</button>
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

</body>

</html>