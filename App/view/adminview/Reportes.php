<?php
session_start();
include '../../../adminconfig/database.php';

// 1. Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\Gzg\App\libs\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\Gzg\App\libs\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\Gzg\App\libs\PHPMailer\src\SMTP.php';

// 2. Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conn = Database::getConnection();
  $id = $_POST['id'];
  $respuesta = $_POST['respuesta'];

  // 3. Escapar entradas
  $id = $conn->real_escape_string($id);
  $respuesta = $conn->real_escape_string($respuesta);

  // 4. Obtener el correo del usuario
  $query = "SELECT email FROM contactos WHERE id = $id";
  $result = $conn->query($query);

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $emailUsuario = $row['email'];

    // 5. Guardar la respuesta en la base de datos
    $update = "UPDATE contactos SET respuesta = '$respuesta' WHERE id = $id";

    if ($conn->query($update) === TRUE) {

      // 6. Enviar correo con PHPMailer
      $mail = new PHPMailer(true);
      try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';       // <- CAMBIA ESTO
        $mail->SMTPAuth = true;
        $mail->Username = 'greenzoneguard@gmail.com';  // <- CAMBIA ESTO
        $mail->Password = 'xlbu jdxs smgd njqq';           // <- CAMBIA ESTO
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('tucorreo@tudominio.com', 'GREEN ZONE GUARD" Guardianes de zona verde');
        $mail->addAddress($emailUsuario);
        $mail->Subject = 'Respuesta a su reporte';
        $mail->Body = "Gracias por escribirnos. Esta es nuestra respuesta:\n\n$respuesta";

        $mail->send();
        echo "<script>alert('Respuesta guardada y correo enviado exitosamente');</script>";
      } catch (Exception $e) {
        echo "<script>alert('Respuesta guardada, pero error al enviar el correo: {$mail->ErrorInfo}');</script>";
      }

    } else {
      echo "<script>alert('Error al guardar la respuesta');</script>";
    }
  } else {
    echo "<script>alert('No se encontró el contacto');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión - Reportes</title>
  <link rel="stylesheet" type="text/css" href="/styles/reset.css">
  <link rel="stylesheet" type="text/css" href="/styles/global.css">
  <link rel="stylesheet" type="text/css" href="/styles/panel-styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

  <link rel="icon" href="../../../public/images/iconos/planta.ico">
  <link rel="shortcut icon" href="../../../public/images/iconos/planta.ico" type="image/x-icon">

</head>

<body>

  <main>
    <h1 class="titulo__principal">"Gestión de Reportes"</h1>
    <br>
    <div class="container">
      <!-- Barra lateral de navegación -->
      <?php include __DIR__ . '/../adminview/layouts/Menu_PanelAdmin.php'; ?>


      <!-- Sección principal -->
      <div class="main-content">
        <h2>Reportes Recibidos</h2>

        <!-- Tabla de contactos -->
        <table>
          <thead>
            <tr>
              <th>Documento</th>
              <th>Email</th>
              <th>Mensaje</th>
              <th>Fecha</th>
              <th>Respuesta</th>
            </tr>
          </thead>
          <tbody>
            <!-- Mostrar contactos desde la base de datos -->
            <?php
            $conn = Database::getConnection();
            $result = $conn->query("SELECT * FROM contactos");
            while ($contacto = $result->fetch_assoc()) {
              $isRespuestaEnviada = !empty($contacto['respuesta']); // Verifica si ya hay una respuesta
              echo "<tr>";
              echo "<td>" . $contacto['documento'] . "</td>";
              echo "<td>" . $contacto['email'] . "</td>";
              echo "<td>" . $contacto['mensaje'] . "</td>";
              echo "<td>" . $contacto['fecha'] . "</td>";
              echo "<td>
            <form method='POST' action=' '>
                <input type='hidden' name='id' value='" . $contacto['id'] . "'>
                <textarea name='respuesta' placeholder='Escriba su respuesta' " . ($isRespuestaEnviada ? "disabled" : "") . ">" . ($isRespuestaEnviada ? htmlspecialchars($contacto['respuesta']) : '') . "</textarea>
                <button type='submit' class='btn' " . ($isRespuestaEnviada ? "disabled" : "") . ">Guardar</button>
            </form>
          </td>";
              echo "</tr>";
            }
            ?>


          </tbody>
        </table>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/../adminview/layouts/footer.php'; ?>

</body>

</html>