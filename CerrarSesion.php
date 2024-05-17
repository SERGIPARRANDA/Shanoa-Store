<?php
session_start(); // Iniciar la sesión si no está iniciada

// Destruir todas las variables de sesión
session_destroy();

// Redirigir al usuario a index.php después de cerrar sesión
header("Location:/Shanoa%20Store/Index.php");
exit();
?>