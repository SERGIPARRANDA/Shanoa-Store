
<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Cambia esto por la dirección del servidor de tu base de datos
$username = "root"; // Cambia esto por tu nombre de usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$database = "Shanoa_Store"; // Cambia esto por el nombre de tu base de datos

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa"; // Esto es opcional, solo para verificar que la conexión se realizó correctamente
}
?>