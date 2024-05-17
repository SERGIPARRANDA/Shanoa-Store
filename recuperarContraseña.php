<?php
// Incluir archivo de conexión a la base de datos si es necesario
// include("PHPCONEXION/conexion.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar el correo electrónico del formulario
    $correo = $_POST['correo'];

    // Generar un token único para el usuario (puedes usar una función como uniqid() para generar el token)
    $token = uniqid();

    // Guardar el token en la base de datos junto con el correo electrónico del usuario
    // Aquí deberías tener una tabla para almacenar tokens de restablecimiento de contraseña

    // Ejemplo de inserción en la base de datos (descomenta y ajusta según tu estructura de base de datos)
    /*
    $sql = "INSERT INTO reset_tokens (correo, token) VALUES ('$correo', '$token')";
    $result = $conn->query($sql);
    */

    // Aquí deberías enviar un correo electrónico al usuario con un enlace que incluya el token
    // Por ejemplo, puedes enviar un correo con un enlace como: 
    // http://tu-sitio.com/restablecer_contraseña.php?token=xxxxxxxxxxxx

    // Redirigir a una página de confirmación después de enviar el correo
    header("Location: confirmacion_recuperacion.php");
    exit();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="http://localhost/Shanoa%20Store/Styles/InicioSesion.css">
</head>
<body>
    <div class="wrapper">
        <form action="procesar_recuperacion.php" method="POST">
            <h1>Recuperar Contraseña</h1>
            <div class="input-box">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required>
            </div>
            <button type="submit" class="btn">Enviar</button>
        </form>
    </div>
</body>
</html>
