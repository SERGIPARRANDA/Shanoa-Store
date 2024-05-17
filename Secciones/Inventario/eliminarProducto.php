<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM productos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado correctamente.";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Producto</title>
</head>
<body>
    <h2>Eliminar Producto</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        ID del Producto a Eliminar: <input type="number" name="id" required><br><br>
        <input type="submit" value="Eliminar Producto">
    </form>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>