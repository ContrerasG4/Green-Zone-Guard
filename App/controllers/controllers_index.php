<?php
require_once __DIR__ . '/../models/conexion.php';
require_once __DIR__ . '/../models/index_models.php';

$informacion = InformacionModel::obtenerInformacion();

$conn = Database::getConnection();

$consulta = "SELECT * FROM informacion";
$resultado = $conn->query($consulta);

$Titulo = "";
$Mensaje = "";

if ($resultado && $resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $Titulo = $row['Titulo'];
    $Mensaje = $row['Mensaje'];
}
?>
