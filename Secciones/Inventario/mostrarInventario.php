<?php
    include 'conexion.php';

    // Consulta SQL para obtener todos los productos
    $sql = "SELECT id, nombre, descripcion, precio, stock FROM productos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Inventario de Productos Shanoa Luxury</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>";

        // Mostrar cada fila de datos
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nombre"] . "</td>
                    <td>" . $row["descripcion"] . "</td>
                    <td>$" . $row["precio"] . "</td>
                    <td>" . $row["stock"] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron productos.";
    }

    // Cerrar la conexión
    $conn->close();

?>
