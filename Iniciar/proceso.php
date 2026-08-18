<?php
$conn = new mysqli('localhost', 'root', '', 'greenzoneguard');
if ($conn->connect_error) {
    die('Error: ' . $conn->connect_error);
}
$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $consulta = "SELECT * FROM usuario WHERE Email = '$email'";
    $result = $conn->query($consulta);

    if ($result->num_rows > 0) {
        $token = uniqid();

        $actualizar = "UPDATE usuario SET token = '$token' WHERE Email = '$email'";
        $conn->query($actualizar);

        $url = "http://localhost:3000/Iniciar/restablecer_contraseña.php?token=$token";

        echo "<div class='success-message'>
                <p>Haz clic en este enlace para restablecer tu contraseña:</p>
                <a href='$url' class='reset-link'>$url</a>
              </div>";
    } else {
        echo "<script>
                alert('El correo no está registrado.');
                window.location.href = '../Iniciar/recuperar_contraseña.php';
              </script>";
        exit; 
    }
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        padding: 20px;
        text-align: center;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url('../images/Imagen principal.jpg');
    }

    .success-message {
        background-color: #e0ffe0;
        border: 1px solid #28a745;
        border-radius: 5px;
        padding: 20px;
        display: inline-block;
        margin-top: 20px;
        position: relative;
        top: 30%;
    }

    .reset-link {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .reset-link:hover {
        text-decoration: underline;
    }

    p {
        font-size: 16px;
        margin: 10px 0;
    }
</style>


