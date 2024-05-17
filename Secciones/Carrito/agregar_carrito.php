<?php
// Incluir archivo de conexión a la base de datos
include("../../PHPCONEXION/conexion.php");

// Iniciar o reanudar la sesión para usar $_SESSION
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario si no está autenticado
    header("Location: iniciar_sesion.php");
    exit();
}

// Verificar si el carrito no está inicializado
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = []; // Inicializa el carrito como un array vacío si no existe
}

// Verificar si se ha enviado un formulario para agregar al carrito por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
    // Obtener datos del formulario
    $idProducto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    // Consulta para obtener información del producto según el id recibido
    $sqlProducto = "SELECT * FROM productos WHERE idProductos = ?";
    $stmtProducto = $conn->prepare($sqlProducto);
    $stmtProducto->bind_param("i", $idProducto);
    $stmtProducto->execute();
    $resultadoProducto = $stmtProducto->get_result();

    // Verificar si se encontró el producto
    if ($resultadoProducto->num_rows > 0) {
        // Obtener detalles del producto
        $producto = $resultadoProducto->fetch_assoc();

        // Crear una estructura de datos para el nuevo ítem del carrito
        $itemCarrito = [
            'id_producto' => $producto['idProductos'],
            'nombre' => $producto['nombreP'],
            'precio' => $producto['precioP'],
            'cantidad' => $cantidad
        ];

        // Agregar el nuevo ítem al carrito
        $_SESSION['carrito'][] = $itemCarrito;

        // Redirigir de vuelta a la página del carrito
        header("Location: carrito.php");
        exit();
    } else {
        // Si no se encontró el producto, mostrar un mensaje de error
        echo "Error: Producto no encontrado.";
    }
} else {
    // Si no se envió el formulario correctamente, redirigir a la página de productos
    header("Location: Articulos.php");
    exit();
}
?>
