<?php
include("../../PHPCONEXION/conexion.php");
// Verificar si se ha iniciado sesión
session_start();

// Verificar si se recibió un id_producto válido en la URL
if (isset($_GET['id_producto']) && is_numeric($_GET['id_producto'])) {
    $idProducto = $_GET['id_producto'];

    // Verificar si existe un carrito en la sesión y si hay productos en él
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        // Buscar el índice del producto en el carrito basado en el id_producto recibido
        $indiceProducto = -1;
        foreach ($_SESSION['carrito'] as $indice => $item) {
            if ($item['id_producto'] == $idProducto) {
                $indiceProducto = $indice;
                break;
            }
        }

        // Si se encontró el producto en el carrito, eliminarlo
        if ($indiceProducto !== -1) {
            unset($_SESSION['carrito'][$indiceProducto]); // Eliminar el elemento del carrito
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el array del carrito
        }

        // Redirigir de vuelta al carrito con un mensaje
        header("Location: carrito.php?mensaje=Producto eliminado del carrito");
        exit();
    }
}

// Si no se encontró el id_producto o el carrito está vacío, redirigir al carrito
header("Location: carrito.php");
exit();
?>