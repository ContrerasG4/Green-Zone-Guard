<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../models/contrasena_models.php';
require_once __DIR__ . '/../libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../libs/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../libs/PHPMailer/src/Exception.php';

class Controller {
    public function enviarCodigo() {
        $email = $_POST['email'];
        $usuarioModel = new UsuarioModel();

        if (!$usuarioModel->existeEmail($email)) {
            echo "<script>alert('Este correo no existe, Por favor ingresar uno correcto.');
            window.location.href='../view/contrasenaview.php';</script>";

            return;
        }

        $codigo = rand(100000, 999999);
        $usuarioModel->guardarcodigo($email, $codigo);
        // Envío de correo
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'greenzoneguard@gmail.com';
            $mail->Password = 'xlbu jdxs smgd njqq';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('greenzoneguard@gmail.com', 'Green Zone Guard');
            $mail->addAddress($email);
            $mail->isHTML(true); 

            $mail->Subject = 'Recuperacion de contrasena - Green Zone Guard';
            $mail->Body = '
                <div style="font-family: Arial, sans-serif; background-color: #f3f3f3; padding: 20px;">
                    <div style="max-width: 600px; margin: auto; background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <h2 style="color: #2f855a;">Green Zone Guard</h2>
                        <p>Hola,</p>
                        <p>Hemos recibido una solicitud para restablecer tu contraseña.</p>
                        <p><strong>Tu código de recuperación es:</strong></p>
                        <div style="font-size: 24px; font-weight: bold; color: #e53e3e; background-color: #fef2f2; padding: 10px 20px; display: inline-block; border-radius: 5px;">
                            ' . $codigo . '
                        </div>
                        <p style="margin-top: 20px;">Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
                        <p>Gracias,<br>Equipo Green Zone Guard</p>
                    </div>
                </div>';
            $mail->send();
            echo "<script>window.location.href='../view/restablecer_view.php?email=$email';</script>";

            exit;

        } catch (Exception $e) {
            echo 'Error al enviar correo: ' . $mail->ErrorInfo;
        }
    }

    public function actualizarPassword()
    {
        $email = $_POST['email'];
        $codigo = $_POST['codigo'];
        $nueva = $_POST['nueva'];

        $usuarioModel = new UsuarioModel();

        // Verificar que el código coincida con el email
        if (!$usuarioModel->verificarCodigo($email, $codigo)) {
            echo "<script>alert('El código es incorrecto o ha expirado.');
            window.location.href='../view/restablecer_view.php?email=$email';</script>";
            return;
        }

        // Actualizar contraseña
        if ($usuarioModel->actualizarPassword($email, $nueva)) {
            echo "<script>alert('Contraseña actualizada correctamente.');
            window.location.href='../view/login.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar la contraseña.');
            window.location.href='../view/restablecer_view.php?email=$email';</script>";
        }
    }
    
}

$controller = new Controller();

if ($_GET['accion'] == 'enviarCodigo') {
    $controller->enviarCodigo();
} elseif ($_GET['accion'] == 'actualizarPassword') {
    $controller->actualizarPassword();
}


?>