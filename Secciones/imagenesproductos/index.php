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
$sql = "SELECT ip.idimagenes, ip.id_producto, ip.rutaImagen, p.nombreP FROM
 imagenesproductos ip JOIN productos p ON ip.id_producto = p.idProductos";

if (isset($_GET["id"])) {

    $idimagenes = $_GET["id"];

    $sentenciaEliminarimagenes = $conn->prepare("DELETE FROM imagenesproductos WHERE idimagenes = ?");
    $sentenciaEliminarimagenes->bind_param("i", $idimagenes);
    if (!$sentenciaEliminarimagenes->execute()) {

    }
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
        <h1 class="text-center text-info text-dark">Imagenes</h1>
        <br>
        <a class="btn btn-success mb-3" href="agregar.php">Agregar Nueva imagen</a>
        <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
            <table class="table " id="tabla_id">
                <thead>
                    <tr>
                        <th style="height: ;" scope="col">ID</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Ruta</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $resultado = $conn->query($sql);

                    // Verifica si hay resultados
                    if ($resultado->num_rows > 0) {
                        // Si hay resultados, muestra cada categoría en la tabla
                        while ($row = $resultado->fetch_assoc()) {
                            $ruta_imagen = $row["rutaImagen"];
                            $id_producto = $row["id_producto"];
                            echo "<tr>";
                            echo "<td>" . $row["idimagenes"] . "</td>";
                            echo "<td>" . $row["nombreP"] . "</td>";
                            echo "<td>" . $row["rutaImagen"] . "</td>";
                            echo "<td><img src='$ruta_imagen' style='height:60px; width:60px;' alt='Imagen del producto'> </td>";
                            echo "<td><a href='javascript:void(0);' onclick='borrar(" . $row["idimagenes"] . ")' class='btn btn-danger btn-sm'>Eliminar</a></td>";
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
</div>

</main>
<?php include ("../../Templates/footer.php"); ?>