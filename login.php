<?php


session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario está actualmente autenticado
if (isset($_SESSION['usuario_autenticado'])) {
    header('Location: usuario.php');  
    exit;
}

// Inicializar la variable de mensaje
$mensaje = '';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si las claves existen en $_POST
    if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Escapar los datos para evitar inyecciones SQL
        $usuario = $conn->real_escape_string($usuario);
        $contrasena = $conn->real_escape_string($contrasena);

        // Consultar la base de datos para verificar las credenciales
        $sql = "SELECT * FROM Usuario WHERE usuario = '$usuario'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Usuario encontrado, verificar la contraseña
            $usuarioData = $result->fetch_assoc();
            if (password_verify($contrasena, $usuarioData['contrasena'])) {
                // Las credenciales son válidas, iniciar sesión y redirigir al panel de administración
                $_SESSION['usuario_autenticado'] = true;
                $_SESSION['usuario'] = $usuario;
                header('Location: usuario.php');  // Cambiado de login.php a usuario.php
                exit;
            } else {
                // Contraseña incorrecta
                $mensaje = 'Contraseña incorrecta, intente de nuevo por favor.';
            }
        } else {
            // Usuario no encontrado
            $mensaje = 'Usuario no encontrado';
        }
    } else {
        $mensaje = 'Faltan campos en la solicitud.';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <nav class="navegation_principal">
        <ul>
            <li><i class="bi bi-list"></i></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <!-- Mostrar mensaje flotante si existe -->
    <?php
    if (!empty($mensaje)) {
        echo '<div id="mensaje-flotante" class="mensaje-flotante mensaje-error">' . htmlspecialchars($mensaje) . '</div>';
    }
    ?>

    <article class="container_1">
        <div class="citas">
            <div class="imagen_citas">
                <img class="imagen_citas" src="mision3.jpg" alt="foto de login">
                <p id="texto_citas"> <strong> INICIO DE SESION </strong></p>
            </div>
        </div>
    </article> 
     
    <article class="login">
        <div class="login-container"><br>
            <div class="formulario">
                <h2><b> INICIO  DE SESION</b></h2><br>
                <form action="login.php" method="post">
                    <label for="usuario"><i class="bi bi-person-fill"></i><b> Usuario</label></b>
                    <input type="text" id="username" name="usuario" required>
                    <br><br>
                    <label for="contrasena"><i class="bi bi-shield-lock-fill"></i><b> Contraseña</label></b>
                    <input type="password" id="password" name="contrasena" required>
                    <br><br>
                    <button type="submit" class="boton">Iniciar Sesión</button>
                    <br><br>
                    <p><a href="registro.php"><b>Regístrate</a></b></p>
                </form>
            </div>
        </div>
    </article>
    
    <script>
        // Mostrar el mensaje flotante
        document.addEventListener('DOMContentLoaded', function () {
            var mensaje = document.getElementById('mensaje-flotante');
            if (mensaje) {
                mensaje.style.display = 'block';
                // Ocultar el mensaje después de 5 segundos
                setTimeout(function () {
                    mensaje.style.display = 'none';
                }, 5000);
            }
        });
    </script>

</body>
</html>
