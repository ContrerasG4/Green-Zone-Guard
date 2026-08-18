<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contrasena</title>
    <link rel="icon" href="/iconos/planta.ico">
    <link rel="stylesheet" type="text/css" href="../../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../../styles/global.css">
    <link rel="stylesheet" type="text/css" href="../../styles/contacto-styles.css">
    <link rel="stylesheet" type="text/css" href="../../styles/registrarse-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="/public/images/iconos/planta.ico">
    <link rel="shortcut icon" href="/public/images/iconos/planta.ico" type="image/x-icon">
</head>

<body>
    <header>
        <?php
        require_once "../view/adminview/layouts/header.php"
        ?>
    </header>
    <main>

        <div class="formulario">
            <form class="form" action="../controllers/controllercontrasena.php?accion=actualizarPassword" method="POST" name="contact-form">
                <div class="form-header">
                    Restablecer contraseña
                </div>
                <div class="form-body">
                    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" class="input-text">
                    <input type="text" name="codigo" required placeholder="Código recibido" class="input-text">
                    <input type="password" name="nueva" required placeholder="Nueva contraseña" class="input-text">
                    <button type="submit" class="button">Actualizar contraseña</button>
                </div>
            </form>

            </form>
        </div>
        </div>


    </main>
    <?php
    require_once "../view/adminview/layouts/footer.php";
    ?>
</body>

</html>