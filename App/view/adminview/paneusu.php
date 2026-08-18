<?php
include_once '../../../adminconfig/database.php';

// Variables para los campos del formulario
$Documento = isset($_POST['Documento']) ? $_POST['Documento'] : '';
$Nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : '';
$Apellidos = isset($_POST['Apellidos']) ? $_POST['Apellidos'] : '';
$Edad = isset($_POST['Edad']) ? $_POST['Edad'] : '';
$Nombre_usuario = isset($_POST['Nombre_usuario']) ? $_POST['Nombre_usuario'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : ''; 
$Email = isset($_POST['Email']) ? $_POST['Email'] : '';
$Fecha_registro = isset($_POST['Fecha_registro']) ? $_POST['Fecha_registro'] : '';
$error = "";

// CREATE - Insertar nuevo usuario
if (isset($_POST['guardar'])) {
    try {
        // Generar una contraseña aleatoria y cifrarla
        $password = bin2hex(random_bytes(4)); // Genera una contraseña aleatoria de 8 caracteres
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Encriptar la contraseña generada

        $sql = "INSERT INTO usuario (Documento, Nombre, Apellidos, Edad, Nombre_usuario, Contraseña, Email, Fecha_registro) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la sentencia: " . $conexion->error);
        }
        $stmt->bind_param('sssissss', $Documento, $Nombre, $Apellidos,  $Edad, $Nombre_usuario, $hashed_password, $Email, $Fecha_registro);
        if ($stmt->execute()) {
          echo "<script>alert('Usuario registrado correctamente');</script>";
          echo "<script>alert('Contraseña generada: $password');</script>";// Muestra la contraseña generada al administrador.
            $Documento = $Nombre = $Apellidos = $Edad = $Nombre_usuario = $password = $Email = $Fecha_registro =''; // Limpiar los campos
        } else {
            echo "<script>alert('Error al insertar el registro');</script>";
        }
        $stmt->close();
    } catch (Exception $e) {
        $error = "Ha ocurrido un error al intentar guardar en la base de datos.";
    }
}

// READ - Consultar usuario
if (isset($_POST['consultar'])) {
    $Documento = $_POST['id']; // Asegúrate de capturar correctamente el Documento del formulario
    $sql = "SELECT * FROM usuario WHERE Documento = '$Documento'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        // Usuario encontrado, llenar los datos
        $fila = $resultado->fetch_assoc();
        $Documento = $fila['Documento'];
        $Nombre = $fila['Nombre'];
        $Apellidos = $fila['Apellidos'];
        $Edad = $fila['Edad'];
        $Nombre_usuario = $fila['Nombre_usuario'];
        $Email = $fila['Email'];
        $Fecha_registro = $fila['Fecha_registro'];
    } else {
        // Usuario no encontrado, mostrar mensaje y vaciar campos
        echo "<script>alert('Usuario no existe');</script>";
        $Documento = $Nombre = $Apellidos = $Edad = $Nombre_usuario = $Email = $Fecha_registro = ''; // Vaciar los campos
    }
}

// UPDATE - Actualizar usuario
if (isset($_POST['actualizar'])) {
    if (empty($Documento) || empty($Nombre) || empty($Apellidos) || empty($Edad) || empty($Nombre_usuario) || empty($Email)) {
        echo "<script>alert('Todos los campos son obligatorios para actualizar');</script>";
    } else {
        $sql = "UPDATE usuario SET Nombre = ?, Apellidos = ?, Edad = ?, Nombre_usuario = ?, Email = ? WHERE Documento = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('ssisss', $Nombre, $Apellidos, $Edad, $Nombre_usuario, $Email, $Documento);
        if ($stmt->execute()) {
            echo "<script>alert('Usuario actualizado correctamente');</script>";
            $Documento = $Nombre = $Apellidos = $Edad = $Nombre_usuario = $password = $Email = $Fecha_registro = ''; // Limpiar los campos
        } else {
            echo "<script>alert('Error al actualizar el usuario');</script>";
        }
        $stmt->close();
    }
}

// DELETE - Eliminar usuario
// DELETE - Eliminar usuario
if (isset($_POST['eliminar'])) {
    $Documento = $_POST['id'];
    // Verificar si el usuario está relacionado con otra tabla
    $consultaRelacion = "SELECT COUNT(*) AS total FROM participacion WHERE Documento = '$Documento'";
    $resultadoRelacion = $conexion->query($consultaRelacion);
    $filaRelacion = $resultadoRelacion->fetch_assoc();

    if ($filaRelacion['total'] > 0) {
        // Si está relacionado, mostrar alerta y no eliminar
        echo "<script>alert('Este usuario no se puede eliminar porque está participando.');</script>";
    } else {
        // Si no está relacionado, proceder con la eliminación
        $sql = "DELETE FROM usuario WHERE Documento = '$Documento'";
        if ($conexion->query($sql)) {
            echo "<script>alert('Usuario eliminado correctamente');</script>";
            $Documento = $Nombre = $Apellidos = $Edad = $Nombre_usuario = $password = $Email = $Fecha_registro = ''; // Limpiar los campos
        } else {
            echo "<script>alert('Error al eliminar el usuario');</script>";
        }
    }
}

// Obtener todos los usuarios para mostrar en la tabla

$conexion = Database::getConnection();
$sql = "SELECT * FROM usuario";
$resultado = $conexion->query($sql);

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Usuarios</title>
    <link rel="stylesheet" type ="text/css" href="../../../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/global.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/panel-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="icon" href="../../../public/images/iconos/planta.ico">
    <link rel="shortcut icon" href="../../../public/images/iconos/planta.ico" type="image/x-icon">

</head>
<body>
<main>
    <!-- <h1 class="titulo__principal">"PROTEGE Y CUIDA NUESTRAS ZONAS VERDES"</h1> -->
    <br>
    <?php if ($error !== "") echo "<div class='alert-error'>$error</div>"; ?>
    <div class="container">
        <!-- Barra lateral de navegación -->
        <?php include __DIR__ . '/../adminview/layouts/Menu_PanelAdmin.php'; ?>

        <!-- Sección principal -->
        <div class="main-content">
            <h2>Gestionar Usuarios</h2>

            <!-- Tabla de usuarios -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>apellido</th>
                        <th>edad</th>
                        <th>Nick</th>
                        <th>Correo</th>
                        <th>Fecha de registro</th>
                        <th>Puntos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $fila["Documento"] ?></td>
                        <td><?php echo $fila["Nombre"] ?></td>
                        <td><?php echo $fila["Apellidos"] ?></td>
                        <td><?php echo $fila["Edad"] ?></td>
                        <td><?php echo $fila["Nombre_usuario"] ?></td>
                        <td><?php echo $fila["Email"] ?></td>
                        <td><?php echo $fila["Fecha_registro"] ?></td>
                        <td><?php echo $fila["Puntos"] ?></td>
                        <td>
                            <button class="btn-edit" 
                                onclick="document.getElementById('Documento').value='<?php echo $fila['Documento']; ?>'; 
                                         document.getElementById('Nombre').value='<?php echo $fila['Nombre']; ?>'; 
                                         document.get
                                         document.getElementById('Apellidos').value='<?php echo $fila['Apellidos']; ?>';
                                         document.getElementById('Edad').value='<?php echo $fila['Edad']; ?>';
                                         document.getElementById('Nombre_usuario').value='<?php echo $fila['Nombre_usuario']; ?>';  
                                         document.getElementById('Email').value='<?php echo $fila['Email']; ?>';">
                            <i class="fas fa-edit"></i>
                            </button>

                            <form action="paneusu.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $fila['Documento']; ?>">
                                <button type="submit" name="eliminar" class="btn-delete"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Formulario de usuarios -->
            <div class="event-form">
                <h3>Gestionar Usuario</h3>
                <form action="paneusu.php" method="POST">
                    <label for="Documento">ID:</label>
                    <input type="text" id="Documento" name="Documento" class="form-input" value="<?php echo $Documento; ?>" placeholder="Ingrese el ID del usuario" required>

                    <label for="Nombre">Nombres:</label>
                    <input type="text" id="Nombre" name="Nombre" class="form-input" value="<?php echo $Nombre; ?>" placeholder="Ingrese el nombre">

                    <label for="Apellidos">Apellidos:</label>
                    <input type="text" id="Apellidos" name="Apellidos" class="form-input" value="<?php echo $Apellidos; ?>" placeholder="Ingrese su apellido">

                    <label for="Edad">Edad:</label>
                    <input type="text" id="Edad" name="Edad" class="form-input" value="<?php echo $Edad; ?>" placeholder="Ingrese su edad">

                    <label for="Nombre_usuario">Nick:</label>
                    <input type="text" id="Nombre_usuario" name="Nombre_usuario" class="form-input" value="<?php echo $Nombre_usuario; ?>" placeholder="Agregue un nombre para el usuario">

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-input" value="<?php echo $password; ?>" placeholder="Contraseña generada automáticamente" disabled>

                    <label for="Email">Correo:</label>
                    <input type="email" id="Email" name="Email" class="form-input" value="<?php echo $Email; ?>" placeholder="Ingrese el correo">

                    <label for="Fecha_registro">Fecha de Registro:</label>
                    <input type="date" id="Fecha_registro" name="Fecha_registro" class="form-input" value="<?php echo $Fecha_registro; ?>" placeholder="Ingrese la fecha de registro">
                    <div class="contenedor_btn">
                    <button type="submit" name="guardar" class="btn">Guardar</button>
                    <button type="submit" name="consultar" class="btn">Consultar</button> 
                    <button type="submit" name="actualizar" class="btn">Actualizar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <br>
</main>
</body>
</html>
