<?php

namespace App\Controller;

session_start();

require_once '../models/modelo_perfil.php';

// Configuración de la base de datos
$dbConfig = [
    'host' => 'localhost',
    'dbname' => 'greenzoneguard',
    'username' => 'root',
    'password' => ''
];

$usuarioModel = new \App\Model\Usuario($dbConfig);
$documento = $_SESSION['Documento'] ?? null;

if (!$documento) {
    echo "<script>window.location.href='/App/view/perfil.php';</script>";
    exit();
}

// Manejar diferentes acciones basadas en el parámetro 'action'
if (isset($_POST['action'])) {
    switch ($_POST['action']) {

        case 1:
            $uploadSuccess = false;
            $uploadError = '';

            // Procesar la subida de la foto
            if (isset($_POST['submit']) && isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $foto_tmp = $_FILES['foto']['tmp_name'];
                $foto_nombre = uniqid('perfil_', true) . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $tipo_archivo = mime_content_type($foto_tmp);
                $tipos_validos = ['image/jpeg', 'image/png', 'image/gif'];
                $tamano_maximo = 5 * 1024 * 1024;
                $ruta_destino = "../../Perfil_GZG/fotos_perfil/" . $foto_nombre; // Usando ruta absoluta

                if (!in_array($tipo_archivo, $tipos_validos)) {
                    $uploadError = 'Solo se permiten imágenes JPG, PNG o GIF';
                } elseif ($_FILES['foto']['size'] > $tamano_maximo) {
                    $uploadError = 'El archivo es demasiado grande, el tamaño máximo permitido es 5 MB';
                } else {
                    if (move_uploaded_file($foto_tmp, $ruta_destino)) {
                        if ($usuarioModel->actualizarFotoPerfil($documento, $ruta_destino)) {
                            $_SESSION['rutaFoto'] = $ruta_destino;
                            $uploadSuccess = true;
                        } else {
                            $uploadError = 'Error al guardar la ruta de la foto en la base de datos';
                        }
                    } else {
                        $errorDetails = error_get_last();
                        $uploadError = 'Error al mover el archivo: ' . (isset($errorDetails['message']) ? $errorDetails['message'] : 'Desconocido');
                    }
                }

                if ($uploadError) {
                    echo "<script>alert('" . htmlspecialchars($uploadError) . "');</script>";
                } elseif ($uploadSuccess) {
                    echo "<script>alert('Foto subida correctamente');</script>";
                }
            }

            // Procesar la actualización de los datos del usuario
            if (isset($_POST['submit']) && isset($_POST['new-username']) && isset($_POST['new-email'])) {
                $nuevoNombreUsuario = trim($_POST['new-username']);
                $nuevoEmail = trim($_POST['new-email']);

                $datosActualizados = $usuarioModel->actualizarDatosUsuario($documento, $nuevoNombreUsuario, $nuevoEmail);

                if ($datosActualizados) {
                    $_SESSION['nombreUsuario'] = $nuevoNombreUsuario; // Usando el nombre de columna correcto
                    $_SESSION['email'] = $nuevoEmail;           // Usando el nombre de columna correcto
                    echo "<script>alert('Datos actualizados correctamente');</script>";
                } else {
                    echo "<script>alert('Error al actualizar los datos');</script>";
                }
            }
            // Redirigir de vuelta al perfil después de la acción
            echo "<script>window.location.href='/App/view/perfil.php';</script>";
            break;
        default:
            // Si no hay acción específica, obtener los datos del usuario para la carga inicial
            $usuarioData = $usuarioModel->obtenerDatosUsuario($documento);
            if ($usuarioData) {
                $_SESSION['nombre'] = $usuarioData['Nombre'];
                $_SESSION['nombreUsuario'] = $usuarioData['Nombre_usuario'];
                $_SESSION['email'] = $usuarioData['Email'];
                $_SESSION['puntos'] = $usuarioData['Puntos'];
                // Obtener la ruta de la foto de la base de datos, si existe.
                $fotoPerfilDB = $usuarioModel->obtenerFotoPerfil($documento);
                $_SESSION['rutaFoto'] = $fotoPerfilDB ?? '/Perfil_GZG/fotos_perfil/default.jpg';

                $insignias = [];
                if ($_SESSION['puntos'] >= 100) $insignias[] = 'Bronce.jpg';
                if ($_SESSION['puntos'] >= 200) $insignias[] = 'Plata.jpg';
                if ($_SESSION['puntos'] >= 30000) $insignias[] = 'Oro.jpg';
                $_SESSION['insignias'] = $insignias;

                // Redirigir a la vista
                echo "<script>window.location.href='/App/view/perfil.php';</script>";
                exit();
            } else {
                echo "Error al obtener los datos del usuario.";
            }
            break;
    }
} else {
    // Si no hay parámetro 'action', obtener los datos del usuario para la carga inicial
    $usuarioData = $usuarioModel->obtenerDatosUsuario($documento);
    if ($usuarioData) {
        $_SESSION['nombre'] = $usuarioData['Nombre'];
        $_SESSION['nombreUsuario'] = $usuarioData['Nombre_usuario'];
        $_SESSION['email'] = $usuarioData['Email'];
        $_SESSION['puntos'] = $usuarioData['Puntos'];
        // Obtener la ruta de la foto de la base de datos, si existe.
        $fotoPerfilDB = $usuarioModel->obtenerFotoPerfil($documento);
        $_SESSION['rutaFoto'] = $fotoPerfilDB ?? '/Perfil_GZG/fotos_perfil/default.jpg';

        $insignias = [];
        if ($_SESSION['puntos'] >= 100) $insignias[] = 'Bronce.jpg';
        if ($_SESSION['puntos'] >= 200) $insignias[] = 'Plata.jpg';
        if ($_SESSION['puntos'] >= 30000) $insignias[] = 'Oro.jpg';
        $_SESSION['insignias'] = $insignias;

        // Redirigir a la vista
        echo "<script>window.location.href='/App/view/perfil.php';</script>";
        exit();
    } else {
        echo "Error al obtener los datos del usuario.";
    }
}
