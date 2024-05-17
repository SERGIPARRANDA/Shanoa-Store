<?php include ("../../Templates/header.php");

?>

<?php 


// Verificar si existe carrito en la sesión
if (isset($_SESSION['usuario']) && isset($_SESSION['carrito'])) {
    // Encabezado de la página del carrito
    echo '<h1 class="text-center text-info text-dark">Carrito</h1>';
    echo '<br>';

    echo '<section class="h-100 h-custom" style="background-color: #eee;">';
    echo '<div class="container py-5 h-100">';
    echo '<div class="row d-flex justify-content-center align-items-center h-100">';
    echo '<div class="col">';
    echo '<div class="card">';
    echo '<div class="card-body p-4">';

    echo '<div class="row">';

    // Columna para mostrar los productos en el carrito
    echo '<div class="col-lg-7">';
    echo '<h5 class="mb-3"><a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continua Comprando</a></h5>';
    echo '<hr>';

    // Mostrar cada producto en el carrito y calcular subtotal
    $subtotal = 0;
    $productosSeleccionados = array();

    foreach ($_SESSION['carrito'] as $item) {
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<div class="d-flex justify-content-between">';
        echo '<div class="d-flex flex-row align-items-center">';
        echo '<div>';
        echo '<img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp" class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">';
        echo '</div>';
        echo '<div class="ms-3">';
        echo '<h5>' . htmlspecialchars($item['nombre']) . '</h5>'; // Nombre del producto
        echo '<p class="small mb-0">Precio: $' . htmlspecialchars($item['precio']) . '</p>'; // Precio del producto
        echo '<p class="small mb-0">Cantidad: ' . htmlspecialchars($item['cantidad']) . '</p>'; // Cantidad del producto
        echo '<a href="eliminar_del_carrito.php?id_producto=' . $item['id_producto'] . '" class="btn-danger btn"  style="color: #cecece;"><i class="fas fa-trash-alt"></i> Eliminar</a>'; // Enlace para eliminar producto del carrito
        echo '</div>';
        echo '</div>';
        echo '<div class="d-flex flex-row align-items-center">';
        echo '<div style="width: 50px;">';
        echo '<h5 class="fw-normal mb-0">' . htmlspecialchars($item['cantidad']) . '</h5>';
        echo '</div>';
        echo '<div style="width: 80px;">';
        echo '<h5 class="mb-0">' . htmlspecialchars($item['precio']) . '</h5>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Calcular subtotal del producto (precio * cantidad)
        $subtotal += $item['precio'] * $item['cantidad'];
        $productosSeleccionados[] = $item['nombre']; // Guardar nombre del producto seleccionado
    }

    // Mostrar mensaje si no hay productos en el carrito
    if (empty($_SESSION['carrito'])) {
        echo "<p>No hay productos en el carrito.</p>";
    }

    echo '</div>'; // Cerrar columna

    // Columna para mostrar detalles del carrito (subtotal, envío, total)
    echo '<div class="col-lg-5">';
    echo '<div style="background-color: rgb(243, 150, 166) !important;" class="card text-white rounded-3">';
    echo '<div class="card-body">';
    echo '<div class="d-flex justify-content-between align-items-center mb-4">';
    echo '<h5 class="mb-0">Detalles</h5>';
    echo '</div>';

    // Mostrar subtotal calculado
    echo '<div class="d-flex justify-content-between">';
    echo '<p class="mb-2">Subtotal</p>';
    echo '<p class="mb-2">$' . number_format($subtotal) . '</p>'; // Subtotal calculado
    echo '</div>';

    // Calcular y mostrar total (subtotal + envío)
    $total = $subtotal;
    echo '<div class="d-flex justify-content-between mb-4">';
    echo '</div>';

    // Botón de checkout con enlace dinámico de WhatsApp
    echo '<form method="post" action="procesar_pago.php">'; // Formulario para procesar el pago
    echo '<input type="hidden" name="total" value="' . $total . '">'; // Campo oculto para el total a pagar
    echo '<input type="hidden" name="productos_seleccionados" value="' . implode(", ", $productosSeleccionados) . '">'; // Campo oculto para los productos seleccionados

    echo '<button type="submit" name="checkout" class="btn btn-success btn-block btn-lg">';
    echo '<div class="d-flex justify-content-between">';
    echo '<span>$' . number_format($total ) . '</span>'; // Total a pagar
    echo '<span> -Pagar <i class="fas fa-long-arrow-alt-right ms-2"></i></span>';
    echo '</div>';
    echo '</button>';

    echo '</form>'; // Cerrar formulario

    echo '</div>'; // Cerrar card-body
    echo '</div>'; // Cerrar card
    echo '</div>'; // Cerrar columna

    echo '</div>'; // Cerrar row
    echo '</div>'; // Cerrar card-body
    echo '</div>'; // Cerrar card
    echo '</div>'; // Cerrar col
    echo '</div>'; // Cerrar row
    echo '</div>'; // Cerrar container
    echo '</section>'; // Cerrar sección
} else {
    // Si no hay productos en el carrito, mostrar mensaje
    echo "<p>No hay productos en el carrito.</p>";
}


?>
<?php include("../../Templates/footer.php"); ?>

