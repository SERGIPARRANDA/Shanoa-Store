<?php 

?>

<?php
session_start();
include("PHPCONEXION/conexion.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar valores del formulario
    $correo = $_POST['Correo'];
    $contraseña = $_POST['Contraseña'];

    // Consulta SQL para verificar las credenciales y obtener información del usuario
    $sql = "SELECT * FROM persona WHERE Correo = '$correo' AND Contraseña = '$contraseña'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Iniciar sesión (si no está ya iniciada)
        session_start();

        // Obtener datos del usuario de la fila obtenida por la consulta
        $row = $result->fetch_assoc();

        // Almacenar información del usuario en la sesión
        $_SESSION['usuario'] = $correo;
        $_SESSION['idUsuarios'] = $row['idUsuarios']; // Almacena el ID del usuario en la sesión
        $_SESSION['nombre'] = $row['Nombre'];
        $_SESSION['apellido'] = $row['Apellido'];
        $_SESSION['direccion'] = $row['Direccion'];
        $_SESSION['telefono'] = $row['Telefono'];
        $_SESSION['correo'] = $row['Correo'];
        $_SESSION['rol_id'] = $row['Rol_idRol'];

        // Recordar credenciales si se seleccionó la opción
        if (isset($_POST['recordar'])) {
            setcookie('correo', $correo, time() + (86400 * 30), "/"); // Cookie válida por 30 días
            setcookie('contraseña', $contraseña, time() + (86400 * 30), "/"); // Cookie válida por 30 días
        } else {
            // Eliminar cookies de recordar credenciales si no se seleccionó la opción
            setcookie('correo', '', time() - 3600, "/");
            setcookie('contraseña', '', time() - 3600, "/");
        }

        // Redirigir a la página principal después del inicio de sesión exitoso
        header("Location: index.php");
        exit();
    } else {
        // Mensaje de error si las credenciales son incorrectas
        $error = "Correo o contraseña incorrectos. Intenta de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form In HTML And CSS</title>
    <link rel="stylesheet" href="/Shanoa%20Store/Styles/InicioSesion.css">
</head>
<body>
    <style>
        .wrapper .remember-forgot {
    display: flex;
    justify-content: space-between;
    font-size: 14.5px;
    margin: 15px 0 15px;
}
    </style>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h1>Login</h1>
            <?php if (isset($error)) { ?>
                <div class="error">
                    <?php echo $error; ?>
                </div>
            <?php } ?>
            <div class="input-box">
                <label for="Correo">Correo</label>
                <input type="email" id="Correo" name="Correo" placeholder="Correo" value="<?php echo isset($_COOKIE['correo']) ? $_COOKIE['correo'] : ''; ?>" required>
            </div>
            <div class="input-box">
                <label for="Contraseña">Contraseña</label>
                <input type="password" id="Contraseña" name="Contraseña" placeholder="Contraseña" value="<?php echo isset($_COOKIE['contraseña']) ? $_COOKIE['contraseña'] : ''; ?>" required>
            </div>
            <div class="remember-forgot">
                <label for="recordar"><input type="checkbox"  id="recordar"> Remeber me </label>
                <a href="recuperarContraseña.php">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        
    </div>
</body>
</html>
