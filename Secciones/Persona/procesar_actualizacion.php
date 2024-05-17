<?php
// Incluir archivo de conexión a la base de datos
include ("../../PHPCONEXION/conexion.php");

// Verificar sesión y permisos
session_start();
if (!isset($_SESSION['usuario'])) {
    // Redirigir o mostrar un mensaje de error si el usuario no tiene permisos
    echo "No tienes permisos para acceder a esta página.";
    exit;
}

// Recibir datos del formulario y validar su existencia
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';


// Preparar la consulta SQL con marcadores de posición (?)
$sql = "UPDATE persona SET 
        Nombre = ?,
        Apellido = ?,
        Direccion = ?,
        Telefono = ?,
        Correo = ?";

// Agregar condición WHERE para actualizar solo el usuario actual
$sql .= " WHERE idUsuarios = ?";

// Preparar la declaración SQL
$stmt = $conn->prepare($sql);

// Vincular los parámetros a la declaración SQL
$stmt->bind_param("sssssi", $nombre, $apellido, $direccion, $telefono, $correo, $_SESSION['idUsuarios']);

// Ejecutar la consulta y verificar errores
if ($stmt->execute()) {
    header("Location: /Shanoa%20Store/index.php");
} else {
    echo "Error al actualizar los datos: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>