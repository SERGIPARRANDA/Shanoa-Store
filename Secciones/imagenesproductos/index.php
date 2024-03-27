<?php include ("../../Templates/header.php"); ?>
<?php
// Incluye el archivo de conexión
include ("../../PHPCONEXION/conexion.php");

// Consulta SQL para seleccionar todas las categorías
$sql = "SELECT * FROM imagenesproductos";
// Verificar si se recibió el parámetro idSubcategorias en la URL
if (isset($_GET["id"])) {
    // Obtener el id de la categoría de la URL
    $idimagenes = $_GET["id"];
    // Finalmente, eliminar la categoría
    $sentenciaEliminarimagenes = $conn->prepare("DELETE FROM imagenesproductos WHERE idimagenes = ?");
    $sentenciaEliminarimagenes->bind_param("i", $idimagenes);
    if (!$sentenciaEliminarimagenes->execute()) {
        die("Error al eliminar la imagen: " . $conn->error);
    }
    // Redirigir al índice después de la eliminación exitosa
    header("Location: index.php?mensaje=Categoría y subcategorías eliminadas exitosamente");
    exit(); // Salir del script después de redirigir
}
?>



<h1 class="text-center text-info text-dark">Imagenes</h1>
<br>

<div class="card-body">
    <a class="btn btn-success" href="agregar.php">Agregar Nueva imagen</a>
    <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
        <table class="table " id="tabla_id">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Ruta</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $resultado = $conn->query($sql);

                // Verifica si hay resultados
                if ($resultado->num_rows > 0) {
                    // Si hay resultados, muestra cada categoría en la tabla
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["idimagen"] . "</td>";
                        echo "<td>" . $row["id_producto"] . "</td>";
                        echo "<td>" . $row["rutaImagen"] . "</td>";
                        echo "<td> <a href='Editar.php?id=" . $row["idimagen"] . "' class='btn btn-primary btn-sm'>Editar</a></td>";
                        echo "<td> <a href='index.php?id=" . $row["idimagen"] . "' class='btn btn-danger btn-sm'>Eliminar</a> </td>";
                        echo "</tr>";
                    }
                } else {
                    // Si no hay resultados, muestra un mensaje indicando que no se encontraron categorías
                    echo "<tr><td colspan='4'>No se encontraron imagenes.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>
<div class="card-footer text-muted"></div>
<?php include ("../../Templates/footer.php"); ?>