<?php
session_start();  // Iniciar la sesión

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();
// Redirigir al usuario a la página de inicio o cualquier otra página
echo "<script> alert('Hasta una proxima oportunidad Administrador')
window.location.href='/App/view/index.php' </script>";

exit();
?>
