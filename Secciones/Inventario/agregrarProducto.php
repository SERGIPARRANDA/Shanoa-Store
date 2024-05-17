<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];

    // Consulta SQL para insertar un nuevo producto
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock)
            VALUES ('$nombre', '$descripcion', $precio, $stock)";

    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error al agregar el producto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Nuevo Producto</title>
</head>
<body>
    <h2>Agregar Nuevo Producto</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Nombre: <input type="text" name="nombre" required><br><br>
        Descripción: <textarea name="descripcion"></textarea><br><br>
        Precio: <input type="number" name="precio" step="0.01" min="0" required><br><br>
        Stock: <input type="number" name="stock" min="0" required><br><br>
        <input type="submit" value="Agregar Producto">
    </form>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>