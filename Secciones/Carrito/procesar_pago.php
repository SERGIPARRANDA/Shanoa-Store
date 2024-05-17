<?php
// procesar_pago.php

// Verificar si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION['usuario'])) {
    // Redirigir a la página de inicio de sesión si el usuario no ha iniciado sesión
    header("Location: iniciar_sesion.php");
    exit;
}


// Verificar si se recibió una solicitud de checkout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    // Recuperar datos del carrito de la sesión
    $carrito = $_SESSION['carrito'] ?? [];
    // Recuperar datos del cliente desde la sesión
    $nombreCliente = $_SESSION['nombre'] ?? '';
    $direccionCliente = $_SESSION['direccion'] ?? '';
    $telefonoCliente = $_SESSION['telefono'] ?? '';
    // Calcular el total del carrito
    $total = 0;
    $productosSeleccionados = [];

    foreach ($carrito as $item) {
        $nombreProducto = $item['nombre'];
        $cantidadProducto = $item['cantidad'];
        $precioProducto = $item['precio'];

        // Calcular subtotal por producto
        $subtotal = $precioProducto * $cantidadProducto;
        $total += $subtotal;

        // Construir línea del producto con nombre, cantidad y subtotal
        $productoDescripcion = "$nombreProducto (Cantidad: $cantidadProducto) - Subtotal: $$subtotal";

        // Agregar la línea del producto al array de productos seleccionados
        $productosSeleccionados[] = $productoDescripcion;
    }

    // Número de teléfono del vendedor
    $numeroVendedor = '+573228948299'; // Reemplaza con el número de teléfono del vendedor (formato internacional)

    // Construir el mensaje para WhatsApp con los detalles del cliente y productos
    $mensaje = "Hola, quiero comprar los siguientes productos:%0A" . implode("%0A", $productosSeleccionados) . "%0A%0ADetalles del Cliente:%0A" .
        "Nombre: " . $nombreCliente . "%0ADirección: " . $direccionCliente . "%0ATeléfono: " . $telefonoCliente . "%0A%0AMi total a pagar es: $" . $total;

    // Construir el enlace de WhatsApp
    $enlaceWhatsApp = "https://wa.me/{$numeroVendedor}?text={$mensaje}";

    // Redirigir al enlace de WhatsApp
    header("Location: " . $enlaceWhatsApp);
    exit;
} else {
    // Manejo de error (si es necesario)
    echo "Error al procesar el pago.";
}
?>