<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="usuario.css">
    <title>Usuario</title>
</head>

<body>
    <article class="bloque_1">
        <div class="agendamiento1">
            <div class="imagen_agendamiento">
                <img class="imagen_agendamiento" src="mision3.jpg" alt="Foto">
                <p id="texto_agendamiento"><strong>Bienvenido</strong></p>
            </div>
        </div>
    </article>

    <article class="bloque_2">
        <div class="tarjeta2">
            <div class="acciones">
                <p id="citas_agendadas"><strong>Gracias por ingresar</strong></p>
            </div>
        </div>
    </article>
</body>
</html>
