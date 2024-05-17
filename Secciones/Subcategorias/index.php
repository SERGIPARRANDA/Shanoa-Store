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
$sql = "SELECT sub.idSubcategorias, sub.nombreSub, sub.descripcionSub, cat.nombreCat
FROM subcategorias AS sub
JOIN categorias AS cat ON sub.Categorias_idCategorias = cat.idCategorias";

// Verificar si se recibió el parámetro idCategorias en la URL
if (isset($_GET["id"])) {
    // Obtener el idCategorias de la URL
    $idSubcategorias = $_GET["id"];

    // Preparar la consulta SQL para eliminar la categoría
    $sentencia = $conn->prepare("DELETE FROM Subcategorias WHERE idSubcategorias = ?");

    // Vincular el parámetro idCategorias y ejecutar la consulta
    $sentencia->bind_param("i", $idSubcategorias); // 'i' indica que el parámetro es un entero
    $sentencia->execute();
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Sidebars · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">



    <!-- Codigo De Barra Completa -->



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
            <h1 class="text-center text-info text-dark">Subcategorias</h1>
            <a class="btn btn-success mb-3" href="agregar.php">Agregar Nueva Subcategoría</a>
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
                                <a href='javascript:void(0);' onclick='borrar(" . $row["idSubcategorias"] . ")' class='btn btn-danger btn-sm'>Eliminar</a></td>";
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
    </div>

    <div class="card-footer text-muted"></div>
    </main>
    <script>
        function confirmarEliminacion(nombreSubcategoria) {
            if (confirm("¿Estás seguro de eliminar la subcategoría '" + nombreSubcategoria + "'?")) {
                // Aquí puedes agregar la lógica para la eliminación si se confirma
                // window.location.href = "index.php?id=" + idSubcategoria;
            }
        }
    </script>
    </main>
    <?php include ("../../Templates/footer.php"); ?>