<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma De Eventos</title>
    <link rel="stylesheet" type="text/css" href="/styles/reset.css">
    <link rel="stylesheet" type="text/css" href="/styles/global.css">
    <link rel="stylesheet" type="text/css" href="/styles/panel-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <link rel="icon" href="../../../public/images/iconos/planta.ico">
    <link rel="shortcut icon" href="../../../public/images/iconos/planta.ico" type="image/x-icon">

    <style>
        .container {
            position: relative;
            top: 10rem;
            display: flex;
            justify-content: center;
            align-items: center;
            /*height: 100vh;*/
        }

        .btn-llamativo {
            position: relative;
            top: 10rem;
            left: 45%;
            display: block;
            background: linear-gradient(90deg, #ff6a00, #ee0979);
            color: white;
            font-size: 1.2rem;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 5px 15px rgba(238, 9, 121, 0.4);
            animation: bounce 1.5s infinite;
            transition: all 0.3s ease-in-out;
        }

        .btn-llamativo:hover {
            transform: scale(1.1);
            background: linear-gradient(90deg, #ee0979, #ff6a00);
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(238, 9, 121, 0.6);
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>

</head>

<body>

    <main>
        <!--<h1 class="titulo__principal">"PROTEGE Y CUIDA NUESTRAS ZONAS VERDES"</h1>-->
        <br>
        <div class="container">


            <!-- Sección principal -->
            <div class="main-content">
                <h2>Gestión de Eventos</h2>

                <!-- Tabla de eventos -->
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Ubicación</th>
                            <th>Hora</th>
                            <th>Puntos</th> <!-- Nueva columna para los puntos -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mostrar eventos desde la base de datos -->
                        <?php
                        $conn = new mysqli('localhost', 'root', '', 'greenzoneguard');
                        $result = $conn->query("SELECT * FROM eventos");
                        while ($evento = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $evento['Nombre_Evento'] . "</td>";
                            echo "<td>" . $evento['Descripcion_Evento'] . "</td>";
                            echo "<td>" . $evento['Fecha_Evento'] . "</td>";
                            echo "<td>" . $evento['Ubicacion_Evento'] . "</td>";
                            echo "<td>" . $evento['Hora_Evento'] . "</td>";
                            echo "<td>" . $evento['Puntos'] . "</td>";  // Mostrar los puntos
                            echo "</tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>

        </div>
        </div>

        <!-- Botón -->
        <button class="btn-llamativo" id="BotonNew">Unirme a Evento</button>

        <!-- Script JavaScript -->
        <script>
            // Seleccionar el botón
            const boton = document.getElementById('BotonNew');

            // Agregar un evento para redirigir
            boton.addEventListener('click', function() {
                // Cambiar la URL a la página deseada
                window.location.href = '/App/view/unete.php';
            });
        </script>
    </main>
    
</body>

</html>