<?php include ("../../Templates/header.php"); ?>
<?php
// Incluye el archivo de conexión
include ("../../PHPCONEXION/conexion.php");

// Consulta SQL para seleccionar todas las categorías
$sql = "SELECT sub.idSubcategorias, sub.nombreSub, sub.descripcionSub, cat.nombreCat
FROM subcategorias AS sub
JOIN categorias AS cat ON sub.Categorias_idCategorias = cat.idCategorias";

// Verificar si se recibió el parámetro idCategorias en la URL
if (isset ($_GET["id"])) {
    // Obtener el idCategorias de la URL
    $idSubcategorias = $_GET["id"];

    // Preparar la consulta SQL para eliminar la categoría
    $sentencia = $conn->prepare("DELETE FROM Subcategorias WHERE idSubcategorias = ?");

    // Vincular el parámetro idCategorias y ejecutar la consulta
    $sentencia->bind_param("i", $idSubcategorias); // 'i' indica que el parámetro es un entero
    $sentencia->execute();
}
?>


<h1 class="text-center text-info text-dark">Subcategorias</h1>
<br>

<div class="card-body">
    <a class="btn btn-success" href="agregar.php">Agregar Nueva Subcategoría</a>
    <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
        <table class="table " id="tabla_id">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Categoria</th>
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
                        echo "<td>" . $row["idSubcategorias"] . "</td>";
                        echo "<td>" . $row["nombreSub"] . "</td>";
                        echo "<td>" . $row["descripcionSub"] . "</td>";
                        echo "<td>" . $row["nombreCat"] . "</td>";
                        echo "<td> <a href='Editar.php?id=" . $row["idSubcategorias"] . "' class='btn btn-primary btn-sm'>Editar</a>
                        <a href='index.php?id=" . $row["idSubcategorias"] . "'style='margin-left: 5px;' class='btn btn-danger btn-sm'>Eliminar</a></td>";
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
<script>
    function confirmarEliminacion(nombreSubcategoria) {
        if (confirm("¿Estás seguro de eliminar la subcategoría '" + nombreSubcategoria + "'?")) {
            // Aquí puedes agregar la lógica para la eliminación si se confirma
            // window.location.href = "index.php?id=" + idSubcategoria;
        }
    }
</script>
<?php include ("../../Templates/footer.php"); ?>
