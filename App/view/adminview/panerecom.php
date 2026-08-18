<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'greenzoneguard');

if ($conn->connect_error) {
  die("Conexión Fallida: " . $conn->connect_error);
}

// Guardar nueva recompensa
if (isset($_POST['guardar'])) {
  $codigo = $_POST['codigo'];
  $descripcion = $_POST['descripcion'];
  $puntos = $_POST['puntos'];
  $cantidad = $_POST['cantidad'];

  // Manejo de la foto
  $foto = null;
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $permitidos = ['image/jpeg', 'image/png', 'image/gif'];
    $fotoTipo = $_FILES['foto']['type'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoNombre = uniqid() . '-' . basename($_FILES['foto']['name']);
    $directorioFotos = '../uploads/';

    if (in_array($fotoTipo, $permitidos)) {
      if ($_FILES['foto']['size'] <= 2097152) { // 2MB máximo
        if (!is_dir($directorioFotos)) {
          mkdir($directorioFotos, 0755, true);
        }
        if (move_uploaded_file($fotoTmp, $directorioFotos . $fotoNombre)) {
          $foto = $fotoNombre;
        } else {
          echo "<script>alert('Error al mover la foto.');</script>";
        }
      } else {
        echo "<script>alert('La foto excede el tamaño máximo de 2MB.');</script>";
      }
    } else {
      echo "<script>alert('Formato de foto no permitido.');</script>";
    }
  }

  $sql = "INSERT INTO recompensas (codigo, descripcion, puntos, cantidad, foto) VALUES ('$codigo', '$descripcion', '$puntos', '$cantidad', '$foto')";

  if ($conn->query($sql) === TRUE) {
    // echo "<script>alert('Recompensa guardada correctamente.');</script>";
    echo "<script>alert('Recompensa guardada correctamente.'); window.location.href = '../../view/adminview/panerecom.php';</script>";

  } else {
    // echo "<script>alert('Error al guardar la recompensa: " . $conn->error . "');</script>";
    echo "<script>alert('Error al guardar la recompensa.'); window.location.href = '../../view/adminview/panerecom.php';</script>";
  }
}

// Eliminar recompensa
if (isset($_POST['eliminar'])) {
  $id = $_POST['id'];
  $sql = "DELETE FROM recompensas WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    // echo "<script>alert('Recompensa eliminada correctamente.');</script>";
    echo "<script>alert('Recompensa eliminada correctamente.'); window.location.href = '../../view/adminview/panerecom.php';</script>";

  } else {
    // echo "<script>alert('Error al eliminar la recompensa: " . $conn->error . "');</script>";
    echo "<script>alert('Error al eliminar la recompensa.'); window.location.href = '../../view/adminview/panerecom.php';</script>";

  }
}

// Actualizar recompensa
if (isset($_POST['actualizar'])) {
  $id = $_POST['id'];
  $codigo = $_POST['codigo'];
  $descripcion = $_POST['descripcion'];
  $puntos = $_POST['puntos'];
  $cantidad = $_POST['cantidad'];

  // Manejo de la foto al actualizar
  $foto = null;
  if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $permitidos = ['image/jpeg', 'image/png', 'image/gif'];
    $fotoTipo = $_FILES['foto']['type'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoNombre = uniqid() . '-' . basename($_FILES['foto']['name']);
    $directorioFotos = '../uploads/';

    if (in_array($fotoTipo, $permitidos)) {
      if ($_FILES['foto']['size'] <= 2097152) {
        if (!is_dir($directorioFotos)) {
          mkdir($directorioFotos, 0755, true);
        }
        if (move_uploaded_file($fotoTmp, $directorioFotos . $fotoNombre)) {
          $foto = $fotoNombre;
        } else {
          echo "<script>alert('Error al mover la foto.');</script>";
        }
      } else {
        echo "<script>alert('La foto excede el tamaño máximo de 2MB.');</script>";
      }
    } else {
      echo "<script>alert('Formato de foto no permitido.');</script>";
    }
  } else {
    // Si no se sube una nueva foto, mantener la existente
    $fotoQuery = $conn->query("SELECT foto FROM recompensas WHERE id = $id");
    $foto = $fotoQuery->fetch_assoc()['foto'];
  }

  $sql = "UPDATE recompensas SET codigo = '$codigo', descripcion = '$descripcion', puntos = '$puntos', cantidad = '$cantidad', foto = '$foto' WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Recompensa actualizada correctamente.');</script>";
    
  } else {
    echo "<script>alert('Error al actualizar la recompensa: " . $conn->error . "');</script>";
  }
}

// Entregar recompensa
if (isset($_POST['entregar'])) {
  $id = $_POST['id'];
  $cantidad_entregada = $_POST['cantidad_entregada'];

  $sql = "SELECT cantidad, entregadas FROM recompensas WHERE id = $id";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if ($row['cantidad'] - $row['entregadas'] >= $cantidad_entregada) {
    $nueva_entregada = $row['entregadas'] + $cantidad_entregada;
    $sql = "UPDATE recompensas SET entregadas = $nueva_entregada WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
      // echo "<script>alert('Recompensa entregada correctamente.');</script>";
      echo "<script>alert('Recompensa entregada correctamente.'); window.location.href = '../../view/adminview/panerecom.php';</script>";

    } else {
      // echo "<script>alert('Error al actualizar la entrega: " . $conn->error . "');</script>";
      echo "<script>alert('Error al actualizar la entrega.'); window.location.href = '../../view/adminview/panerecom.php';</script>";

    }
  } else {
    // echo "<script>alert('No hay suficientes unidades disponibles para entregar.');</script>";
    echo "<script>alert('No hay suficientes unidades disponibles para entregar.'); window.location.href = '../../view/adminview/panerecom.php';</script>";

  }
}

// Consultar recompensas para mostrar en la tabla
$query = "SELECT * FROM recompensas";
$result_tareas = mysqli_query($conn, $query);

// Obtener los datos de la recompensa seleccionada si estamos en modo de edición
$recompensa_editada = null;
if (isset($_POST['editar'])) {
  $id = $_POST['id'];
  $sql = "SELECT * FROM recompensas WHERE id = $id";
  $recompensa_editada = $conn->query($sql)->fetch_assoc();
}

// Cerrar conexión
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión - Recompensas</title>



  <link rel="stylesheet" type="text/css" href="../../../styles/reset.css">
  <link rel="stylesheet" type="text/css" href="../../../styles/global.css">
  <link rel="stylesheet" type="text/css" href="../../../styles/panel-styles.css">
  <link rel="stylesheet" type="text/css" href="../../../styles/table-styles.css">
  <link rel="stylesheet" type="text/css" href="../../../styles/fromrecom.css">

  <link rel="icon" href="../../../public/images/iconos/planta.ico">
  <link rel="shortcut icon" href="../../../public/images/iconos/planta.ico" type="image/x-icon">

</head>

<body>

  <main>
    <!-- <h1 class="titulo__principal">"PROTEGE Y CUIDA NUESTRAS ZONAS VERDES"</h1> -->
    <br>
    <div class="container">
      <!-- Barra lateral de navegación -->
      <?php include __DIR__ . '/../adminview/layouts/Menu_PanelAdmin.php'; ?>

      <!-- Sección principal -->
      <div class="main-content">
        <h2>Recompensas</h2>

        <!-- Tabla de recompensas -->
        <table>
          <thead>
            <tr>
              <th>Foto</th>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Valor recompensa</th>
              <th>Cant. disponible</th>
              <th>Unidades Disponibles</th>
              <th>Cant. entregadas</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_array($result_tareas)) {
              // Calcular las unidades restantes
              $cantidad = is_numeric($row['cantidad']) ? (int)$row['cantidad'] : 0;
              $entregadas = is_numeric($row['entregadas']) ? (int)$row['entregadas'] : 0;
              $unidades_restantes = max(0, $cantidad - $entregadas);
            ?>
              <tr>
                <td>
                  <?php if ($row['foto']) { ?>
                    <img src="../uploads/<?php echo $row['foto']; ?>" alt="Foto" style="width: 50px;">
                  <?php } else { ?>
                    Sin Foto
                  <?php } ?>
                </td>

                <td><?php echo $row['codigo']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['puntos']; ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo $unidades_restantes; ?></td>
                <td><?php echo $row['entregadas']; ?></td> <!-- Mostrar la cantidad entregada -->
                <td>
                  <!-- Formulario de edición -->
                  <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="editar" class="btn btn-secondary">
                      <i class="fa-solid fa-pen-to-square"></i> Editar
                    </button>
                  </form>

                  <!-- Formulario de eliminación -->
                  <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="eliminar" class="btn btn-danger">
                      <i class="fa-solid fa-trash-can"></i> Eliminar
                    </button>
                  </form>
                  <br>
                  <br>
                  <!-- Formulario de entrega -->
                  <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="cantidad_entregada">Cantidad entregada:</label><br>
                    <?php if ($unidades_restantes > 0) { ?>
                      <input type="number" name="cantidad_entregada" min="1" max="<?php echo $unidades_restantes; ?>" required>
                      <button type="submit" name="entregar" class="btn btn-primary">
                        <i class="fa-solid fa-gift"></i> Entregar
                      </button>
                    <?php } else {
                      echo "<span>No hay unidades disponibles.</span>";
                    } ?>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <!-- Formulario para agregar nueva recompensa o editar una existente -->
        <div class="formulario">
          <form class="A123" action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="codigo" value="<?php echo $recompensa_editada['codigo'] ?? ''; ?>" placeholder="Código" required><br>
            <textarea name="descripcion" placeholder="Descripción" required><?php echo $recompensa_editada['descripcion'] ?? ''; ?></textarea><br>
            <input type="number" name="puntos" value="<?php echo $recompensa_editada['puntos'] ?? ''; ?>" placeholder="Valor en puntos" required><br>
            <input type="number" name="cantidad" value="<?php echo $recompensa_editada['cantidad'] ?? ''; ?>" placeholder="Cantidad disponible" required><br>
            <!-- Nuevo campo para cargar la foto -->
            <label for="foto">Subir foto de la recompensa:</label><br>
            <input type="file" name="foto" id="foto" accept="image/*" <?php echo isset($recompensa_editada) ? '' : 'required'; ?>><br>
            <?php if (isset($recompensa_editada)) { ?>
              <input type="hidden" name="id" value="<?php echo $recompensa_editada['id']; ?>">
              <button type="submit" name="actualizar" class="btnA">Actualizar Recompensa</button>
            <?php } else { ?>
              <button type="submit" name="guardar" class="btnB">Guardar Recompensa</button>
            <?php } ?>
          </form>
        </div>

      </div>
    </div>
    </div>

  </main>

</body>

</html>