<?php ?>
<?php include ("PHPCONEXION/conexion.php"); ?>

<?php
if ($_POST) {
    // Recuperar los valores del formulario y establecer valores predeterminados si están vacíos
    $nombre = isset($_POST["Nombre"]) ? $_POST["Nombre"] : "";
    $apellido = isset($_POST["Apellido"]) ? $_POST["Apellido"] : "";
    $direccion = isset($_POST["Direccion"]) ? $_POST["Direccion"] : "";
    $telefono = isset($_POST["Telefono"]) ? $_POST["Telefono"] : "";
    $correo = isset($_POST["Correo"]) ? $_POST["Correo"] : "";
    $contraseña = isset($_POST["Contraseña"]) ? $_POST["Contraseña"] : "";

    // Encriptar la contraseña utilizando password_hash()
    $hash_clave = password_hash($contraseña, PASSWORD_DEFAULT);

    // Establecer el ID de rol (en este caso, el rol predeterminado es 2)
    $Rol_idRol = 2;

    // Preparar la consulta SQL utilizando marcadores de posición (?)
    $sentencia = $conn->prepare("INSERT INTO persona (Nombre, Apellido, Direccion, Telefono, Correo, Contraseña, Rol_idRol) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$sentencia) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular parámetros y ejecutar la consulta preparada
    $sentencia->bind_param("ssssssi", $nombre, $apellido, $direccion, $telefono, $correo, $contraseña, $Rol_idRol);

    if (!$sentencia->execute()) {
        die("Error al ejecutar la consulta: " . $sentencia->error);
    }

    // Redirigir después de la ejecución exitosa
    $mensaje = "Registro agregado";
    header("Location: index.php?mensaje=" . urlencode($mensaje));
    exit(); // Importante: asegúrate de salir del script después de redirigir
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UFT-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,0d">
    <title>Login Form In HTML And CSS </title>
    <link rel="stylesheet" href="http://localhost/Shanoa%20Store/Styles/InicioSesion.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <form action="" method="post">
            <h1>SingUp</h1>
            <div class="input-box">
                <input name="Nombre" id="Nombre" type="text" placeholder="Nombre" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input name="Apellido" id="Apellido" type="text" placeholder="Apellido" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input name="Direccion" id="Direccion" type="text" placeholder="Direccion" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input name="Telefono" id="Telefono" type="text" placeholder="Telefono" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input name="Correo" id="Correo" type="text" placeholder="Correo" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
                <input name="Contraseña" id="Contraseña" type="password" placeholder="Contraseña" required>
                <i class='bx bxs-user'></i>
            </div>
            <button type="submit" class="btn">Crear Cuenta</button>
            <div class="register-link">
                <p>Ya Tienes Cuenta? <a href="#">Login</a></p>
            </div>

        </form>
    </div>
</body>