<?php include ("../../PHPCONEXION/conexion.php"); ?>
<?php
// obtener_productos.php

// Incluir la conexión a la base de datos ($conn)
include 'conexion.php';

// Obtener el ID de la subcategoría enviado por POST
$subcategoriaId = $_POST['subcategoria_id'];

// Consulta para obtener productos de la subcategoría seleccionada
$sql = "SELECT * FROM productos WHERE Subcategorias_idSubcategorias = $subcategoriaId";
$result = $conn->query($sql);

// Generar opciones de productos
$options = '<option value="">Selecciona el Producto</option>';
if ($result->num_rows > 0) {
    while ($producto = $result->fetch_assoc()) {
        $options .= "<option value='" . $producto['idProductos'] . "'>" . $producto['nombreP'] . "</option>";
    }
}

// Devolver las opciones como respuesta a la solicitud AJAX
echo $options;
?>