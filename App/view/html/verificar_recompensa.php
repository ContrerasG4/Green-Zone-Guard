<?php
session_start();

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['Documento'])) {
    echo "<script>alert('Debes iniciar sesión para acceder a esta función.'); window.location.href='login.php';</script>";
    exit();
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "greenzoneguard";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificamos la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$id_usuario = $_SESSION['Documento'];  // Documento del usuario logueado

// Obtenemos la información del usuario
$sql_usuario = "SELECT * FROM usuario WHERE Documento = ?";
$stmt = $conn->prepare($sql_usuario);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Usuario no encontrado.');</script>";
    exit();
}

$usuario = $result->fetch_assoc();
$stmt->close();

// Validamos que tenga al menos 100 puntos
if ($usuario['Puntos'] < 100) {
    // echo "<script>alert('Necesitas tener al menos 100 puntos para reclamar una recompensa.');</script>";
    echo "<script>alert('Necesitas tener al menos 100 puntos para reclamar una recompensa.'); 
    window.location.href='../html/recompensassesion.php';</script>";
    exit();
}

// // Obtenemos el ID de la recompensa seleccionada (por GET o POST)
// if (!isset($_POST['id'])) {

//     

// }
if (isset($_POST["id"])) {

    $id_recompensa = $_POST["id"];

    // Obtenemos los puntos requeridos para la recompensa
    // Consulta segura con prepared statement
    $sql_recompensa = "SELECT * FROM recompensas WHERE id = ?";
    $stmt_recompensa = $conn->prepare($sql_recompensa);
    $stmt_recompensa->bind_param("i", $id_recompensa);
    $stmt_recompensa->execute();
    $result = $stmt_recompensa->get_result();

    if ($result->num_rows > 0) {
        $recompensa = $result->fetch_assoc();
        $_SESSION['idRecom'] = $recompensa['id']; // o guarda otros datos si necesitas
        $_SESSION['codigo'] = $recompensa['codigo'];
        $_SESSION['codigo'] = $recompensa['entregadas'];
        echo "<script>alert('Recompensa encontrada: " . addslashes($recompensa['descripcion']) . "');</script>";
    } else {
        // echo "No se encontró la recompensa.";
        echo "<script>alert('Necesitas tener el ID de la recompensa para reclamar una recompensa.'); 
        window.location.href='../html/recompensassesion.php';
        </script>";
        //     exit();
    }

    $stmt_recompensa->close();
    $conn->close();
}

if (isset($_POST["stock"])) {
    $id_recompensa = $_POST["stock"];      // ID de la recompensa
    $entregadas = $_POST["stock2"] + 1;    // Aumentar entregadas en 1

    // Consulta SQL corregida
    $sql_recompensa = "UPDATE recompensas SET entregadas = ? WHERE id = ?";
    $stmt_recompensa = $conn->prepare($sql_recompensa);
    if (!$stmt_recompensa) {
        die("Error en prepare: " . $conn->error);
    }

    // Enlazar parámetros
    $stmt_recompensa->bind_param("ii", $entregadas, $id_recompensa);

    // Ejecutar la consulta
    if (!$stmt_recompensa->execute()) {

        echo "Error al actualizar: " . $stmt_recompensa->error;
    }
    $puntos = ($usuario['Puntos'] - $_POST["puntosRe"]);
    $sql_usuario = "UPDATE usuario SET Puntos = ? WHERE Documento = ?";
    $stmt_puntos = $conn->prepare($sql_usuario);

    if (!$stmt_puntos) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt_puntos->bind_param("ii", $puntos, $id_usuario);

    if ($stmt_puntos->execute()) {
        echo "<script>
                alert('Puntos actualizados correctamente.');
                window.location.href = 'recompensassesion.php';
              </script>";
        exit;
    } else {
        echo "Error al actualizar puntos: " . $stmt_puntos->error;
    }

    $stmt_puntos->close();
    $stmt_recompensa->close();


    // Verificamos si tiene suficientes puntos
    if ($usuario['Puntos'] >= $puntos_requeridos) {
        echo "<script>alert('¡Recompensa reclamada exitosamente!');</script>";
        // Aquí puedes colocar la lógica para descontar puntos y registrar la entrega
    } else {
        echo "<script>alert('No tienes suficientes puntos para reclamar esta recompensa.');</script>";
        exit();
    }
}



// Mostrar formulario con datos del usuario
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Datos del Usuario</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            height: 100vh;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }

        .contenedor {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 7px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #eee;
        }

        button {
            width: 100%;
            margin-top: 15px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <div class="contenedor">
        <h2>Información del Usuario</h2>
        <form>
            <label>Documento:</label>
            <input type="text" value="<?= $recompensa['id'] ?>" readonly>

            <label>Nombre:</label>
            <input type="text" value="<?= $usuario['Nombre'] ?>" readonly>

            <label>Nombre de usuario:</label>
            <input type="text" value="<?= $usuario['Nombre_usuario'] ?>" readonly>

            <label>Email:</label>
            <input type="text" value="<?= $usuario['Email'] ?>" readonly>

            <label>Puntos disponibles:</label>
            <input type="text" value="<?= $usuario['Puntos'] ?>" readonly>

            <label>Codigo Recompensa</label>
            <input type="text" value="<?= $recompensa['codigo'] ?>" readonly>
        </form>

        <form action="" method="POST">
            <input type="hidden" name="stock" value="<?= $recompensa['id'] ?>">
            <input type="hidden" name="stock2" value="<?= $recompensa['entregadas'] ?>">
            <input type="hidden" name="puntosRe" value="<?= $recompensa['puntos'] ?>">
            <button type="submit">Reclamar</button>
        </form>
    </div>

</body>

</html>