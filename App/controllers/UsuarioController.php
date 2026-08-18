<?php
// Importa el archivo de conexión a la base de datos
require_once __DIR__ . "/../models/conexion.php";

// Importa el modelo Usuario que contiene la lógica para interactuar con la base de datos
require_once __DIR__ . "/../models/Usuario.php";

// Define la clase controlador que manejará las operaciones relacionadas con el usuario
class UsuarioController
{
    // Variable privada para usar el modelo Usuario
    private $usuarioModel;

    // Constructor: recibe la conexión a la base de datos ($db) y crea una instancia del modelo Usuario
    public function __construct($db)
    {
        $this->usuarioModel = new Usuario($db);
    }

    // Método para registrar un nuevo usuario
    public function registrar()
    {
        // Verifica si la petición fue hecha por el método POST (es decir, se envió un formulario)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Verifica que todos los campos requeridos estén presentes en el formulario
            if (!isset($_POST['Documento'], $_POST['Nombre'], $_POST['Apellidos'], $_POST['Edad'], $_POST['Usuario'], $_POST['Email'], $_POST['Contraseña'], $_POST['ConfirmarContraseña'])) {
                return "Por favor, completa todos los campos.";
            }

            // Verifica si la contraseña y la confirmación de contraseña coinciden
            if ($_POST['Contraseña'] !== $_POST['ConfirmarContraseña']) {
                return "Las contraseñas no coinciden.";
            }

            // Llama al método del modelo para registrar al usuario, pasándole todos los datos del formulario
            $resultado = $this->usuarioModel->registrarUsuario($_POST);

            // Si el registro fue exitoso, muestra un mensaje y redirige al login
            if ($resultado === "Registrado exitosamente") {
                echo "<script>alert('$resultado'); window.location.href='/App/view/login.php';</script>";
                exit;
            } else {
                // Si ocurrió un error, devuelve el mensaje de error
                return $resultado;
            }
        }

        // Si no es una solicitud POST, simplemente no hace nada (o podría retornar un formulario en otro contexto)
        return null;
    }
}

// Instancia del controlador, se le pasa la conexión a la base de datos ($conn)
$usuarioController = new UsuarioController($conn);

// Se ejecuta el método registrar() y se almacena el posible mensaje de error o éxito en $mensaje
$mensaje = $usuarioController->registrar();
