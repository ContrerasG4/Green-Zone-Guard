<?php

require_once __DIR__ . "/../../controllers/admincontrollers/AdminController.php"

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administrador</title>
    <link rel="stylesheet" type="text/css" href="../../../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/global.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/entrar-styles.css">
    <link rel="stylesheet" type="text/css" href="../../../styles/panel-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <link rel="icon" href="../../../public/images/iconos/planta.ico">
    <link rel="shortcut icon" href="../../../public/images/iconos/planta.ico" type="image/x-icon">

</head>

<body>

    <?php include __DIR__ . '/../adminview/layouts/header.php'; ?>

    <main>

        <!-- <h1 class="titulo__principal">"PROTEGE Y CUIDA NUESTRAS ZONAS VERDES"</h1> -->
        <form action="../../controllers/admincontrollers/AdminController.php" method="POST">
            <h2>Iniciar Sesión Administrador</h2>
            <?php if (isset($error)) : ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <label for="Documento">Documento:</label>
            <input type="number" id="Documento_Administrador" name="Documento_Administrador">

            <label for="Contraseña">Contraseña:</label>
            <input type="password" id="Contraseña" name="Contraseña">

            <button type="submit">Iniciar Sesión</button>
        </form>

    </main>

    <?php include __DIR__ . '/../adminview/layouts/footer.php'; ?>

</body>

</html>