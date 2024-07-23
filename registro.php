<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $sexo = $_POST['sexo'];
    $usuario = $_POST['usuario'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $tipo_usuario = $_POST['tipo_usuario'];

    $sql = "INSERT INTO usuario (nombre, correo, cedula, telefono, sexo, usuario, contrasena, tipo_usuario)
            VALUES ('$nombre', '$correo', '$cedula', '$telefono', '$sexo', '$usuario', '$contrasena', '$tipo_usuario')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registro.css">
    <title>Registro</title>
</head>
<body>
    <nav class="navegation_principal">
        <ul>
            <li><a href="login.php">INICIO DE SESION</a></li>
        </ul>
    </nav>

    <article class="container_1">
        <div class="registro">
            <div class="imagen_tarjeta">
                <img class="imagen_tarjeta" src="mision3.jpg" alt=" Foto de nosotros">
                <p id="texto_tarjeta"> <strong> REGISTRO USUARIO </strong></p>
            </div>
        </div>
    </article>

    <article class="formulario_registro">
    <div class="formulario_usuariol">
        <form action="registro.php" method="post">
            <label for="nombre"><i class="bi bi-person-fill"></i><b> Nombre</label></b>
            <input type="text" id="nombre" name="nombre" required>
            <br><br>
            <label for="correo"><i class="bi bi-shield-lock-fill"></i><b> Correo</label></b>
            <input type="correo" id="correo" name="correo" required>
            <br><br>
            <label for="cedula"><i class="bi bi-shield-lock-fill"></i><b> Cédula</label></b>
            <input type="text" id="cedula" name="cedula" required>
            <br><br>
            <label for="telefono"><i class="bi bi-shield-lock-fill"></i><b> Telefono</label></b>
            <input type="text" id="telefono" name="telefono" required>
            <br><br>
            <label for="sexo"><i class="sexo"></i><b> Sexo</label></b>
            <select id="sexo" name="sexo" required>
                    <option value="femenino">Femenino </option>
                    <option value="Masculino">Masculino </option>
                    <option value="Otro">Otro </option>
                </select>
            </label>
            <br><br>
            <label for="usuario"><i class="bi bi-shield-lock-fill"></i><b> Usuario</label></b>
            <input type="text" id="usuario" name="usuario" required>
            <br><br>
            <label for="contrasena"><i class="bi bi-shield-lock-fill"></i><b> Contraseña</label></b>
            <input type="password" id="contrasena" name="contrasena" required>
            <br><br>
            <label for="tipo_usuario"><i class="bi bi-shield-lock-fill"></i><b> Tipo de Usuario</label></b>
            <input type="text" id="tipo_usuario" name="tipo_usuario" value="Cliente" readonly>
            <br><br>
            <button type="submit" class="boton_registro"><b>Registrarme</b></button>
            <br><br><br>
            <button type="submit" class="boton_agendar" onclick="window.location.href='login.php';">Iniciar Sesión</button>
        </form>
    </div>
</article>
<article>
       
    </article>
</body>
</html>