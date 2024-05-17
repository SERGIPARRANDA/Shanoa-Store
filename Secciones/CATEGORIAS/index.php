<?php include ("../../Templates/header.php");
if (!isset($_SESSION['usuario']) || $_SESSION['rol_id'] !== '1') {
    // Si el usuario no está autenticado o no tiene el rol de administrador, redirigir a otra página
    header("Location: /Shanoa%20Store/index.php"); // Cambia la ruta a la página a la que deseas redirigir
    exit();
}
?>
<?php
// Incluye el archivo de conexión
include ("../../PHPCONEXION/conexion.php");

// Consulta SQL para seleccionar todas las categorías
$sql = "SELECT * FROM categorias";
// Verificar si se recibió el parámetro idSubcategorias en la URL
if (isset($_GET["id"])) {
    // Obtener el id de la categoría de la URL
    $idCategoria = $_GET["id"];
    // Eliminar los productos relacionados con las subcategorías de la categoría
    $sentenciaEliminarProductos = $conn->prepare("DELETE FROM productos WHERE Subcategorias_idSubcategorias IN (SELECT idSubcategorias FROM subcategorias WHERE Categorias_idCategorias = ?)");
    $sentenciaEliminarProductos->bind_param("i", $idCategoria);
    if (!$sentenciaEliminarProductos->execute()) {
        die("Error al eliminar los productos relacionados: " . $conn->error);
    }
    // Eliminar las subcategorías de la categoría
    $sentenciaEliminarSubcategorias = $conn->prepare("DELETE FROM subcategorias WHERE Categorias_idCategorias = ?");
    $sentenciaEliminarSubcategorias->bind_param("i", $idCategoria);
    if (!$sentenciaEliminarSubcategorias->execute()) {
        die("Error al eliminar las subcategorías: " . $conn->error);
    }
    // Finalmente, eliminar la categoría
    $sentenciaEliminarCategoria = $conn->prepare("DELETE FROM categorias WHERE idCategorias = ?");
    $sentenciaEliminarCategoria->bind_param("i", $idCategoria);
    if (!$sentenciaEliminarCategoria->execute()) {
        die("Error al eliminar la categoría: " . $conn->error);
    }
    // Redirigir al índice después de la eliminación exitosa
    // Salir del script después de redirigir
}
?>

<?php include ("../../Templates/barraizq.php"); ?>
<style>
    .btn-success {
        background-color: pink;
        border: none;
    }

    .btn-success:hover {
        background-color: #FBAED2;
        border: none;
    }
</style>



<div class="container">
    <div class="card-body">
        <h1 class="text-center text-info text-dark">Categorias</h1>
        <br>
        <a class="btn btn-success mb-3" href="agregar.php">Agregar Nueva Categoría</a>
        <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Acciones</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $resultado = $conn->query($sql);

                    // Verifica si hay resultados
                    if ($resultado->num_rows > 0) {
                        // Si hay resultados, muestra cada categoría en la tabla
                        while ($row = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["idCategorias"] . "</td>";
                            echo "<td>" . $row["nombreCat"] . "</td>";
                            echo "<td>" . $row["descripcionCat"] . "</td>";
                            echo "<td> <a href='Editar.php?id=" . $row["idCategorias"] . "' class='btn btn-primary btn-sm'>Editar</a></td>";
                            echo "<td><a href='javascript:void(0);' onclick='borrar(" . $row["idCategorias"] . ")' class='btn btn-danger btn-sm'>Eliminar</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        // Si no hay resultados, muestra un mensaje indicando que no se encontraron categorías
                        echo "<tr><td colspan='4'>No se encontraron categorías.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>
</main>


<script>
    function confirmarEliminacion(idSubcategoria) {
        if (confirm("¿Estás seguro de eliminar esta subcategoría?")) {
            window.location.href = "index.php?id=" + idSubcategoria;
        }
    }
</script>


<?php include ("../../Templates/footer.php"); ?>