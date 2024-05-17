<?php ?>
<?php include ("../../PHPCONEXION/conexion.php"); ?>
<?php


$sql_Subcategorias = "SELECT idSubcategorias, nombreSub FROM subcategorias";
$sql_categorias = "SELECT idCategorias, nombreCat FROM categorias";

$idProducto = isset($_GET["id"]) ? $_GET["id"] : (isset($_POST["idProductos"]) ? $_POST["idProductos"] : "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario de manera segura
    $nombreP = isset($_POST["nombreP"]) ? $_POST["nombreP"] : "";
    $detallesP = isset($_POST["detallesP"]) ? $_POST["detallesP"] : "";
    $cantidadP = isset($_POST["cantidadP"]) ? $_POST["cantidadP"] : "";
    $precioP = isset($_POST["precioP"]) ? $_POST["precioP"] : "";
    $Persona_idUsuarios = isset($_POST["Persona_idUsuarios"]) ? $_POST["Persona_idUsuarios"] : "";
    $Persona_Rol_idRol = isset($_POST["Persona_Rol_idRol"]) ? $_POST["Persona_Rol_idRol"] : "";
    $Subcategorias_idSubcategorias = isset($_POST["Subcategorias_idSubcategorias"]) ? $_POST["Subcategorias_idSubcategorias"] : "";
    $Subcategorias_Categorias_idCategorias = isset($_POST["Subcategorias_Categorias_idCategorias"]) ? $_POST["Subcategorias_Categorias_idCategorias"] : "";

    // Preparar la consulta SQL para actualizar el registro
    $sentencia = $conn->prepare("UPDATE productos SET nombreP=?, detallesP=?, cantidadP=?, precioP=?, Persona_idUsuarios=?, Persona_Rol_idRol=?, Subcategorias_idSubcategorias=?, Subcategorias_Categorias_idCategorias=? WHERE idProductos=?");

    if (!$sentencia) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular parámetros a la consulta preparada
    $sentencia->bind_param("ssssiiiii", $nombreP, $detallesP, $cantidadP, $precioP, $Persona_idUsuarios, $Persona_Rol_idRol, $Subcategorias_idSubcategorias, $Subcategorias_Categorias_idCategorias, $idProducto);

    // Ejecutar la consulta
    if (!$sentencia->execute()) {
        die("Error al ejecutar la consulta: " . $sentencia->error);
    }

    // Redirigir después de la actualización exitosa (evitar enviar contenido antes de los encabezados)
    header("Location: index.php");
    exit; // Asegura que el script se detenga después de la redirección
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include ("../../Templates/header.php");
    if (!isset($_SESSION['usuario']) || $_SESSION['rol_id'] !== '1') {
        // Si el usuario no está autenticado o no tiene el rol de administrador, redirigir a otra página
        header("Location: /Shanoa%20Store/index.php"); // Cambia la ruta a la página a la que deseas redirigir
        exit();
    }
    ?>
    <div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Editar Producto</h1>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idProductos" value="<?php echo $idProducto; ?>">
                <div class="mb-3">
                    <label for="nombreP" class="form-label">Nombre Producto</label>
                    <input type="text" class="form-control" name="nombreP" id="nombreP" aria-describedby="helpId"
                        placeholder="Dale un nombre al Producto" required>
                </div>
                <div class="mb-3">
                    <label for="detallesP" class="form-label">Detalles</label>
                    <input type="text" class="form-control" name="detallesP" id="detallesP" aria-describedby="helpId"
                        placeholder="Añade una descripcion para el Producto" required>
                </div>
                <div class="mb-3">
                    <label for="cantidadP" class="form-label">Cantidad</label>
                    <input type="text" class="form-control" name="cantidadP" id="cantidadP" aria-describedby="helpId"
                        placeholder="Añade una cantidad para el producto" required>
                </div>
                <div class="mb-3">
                    <label for="precioP" class="form-label">Precio</label>
                    <input type="text" class="form-control" name="precioP" id="precioP" aria-describedby="helpId"
                        placeholder="Añade el precio del producto" required>
                </div>
                <!-- Campo Persona (oculto) con opción de admin seleccionada -->
                <input type="hidden" name="Persona_idUsuarios" value="1"> <!-- Supongamos que el ID del admin es 1 -->

                <!-- Campo Rol (oculto) con opción de admin seleccionada -->
                <input type="hidden" name="Persona_Rol_idRol" value="1">
                <!-- Supongamos que el ID del rol de admin es 1 -->


                <div class="mb-3">
                    <label for="Subcategorias_Categorias_idCategorias" class="form-label">CATEGORIA</label>
                    <select class="form-select form-select-lg" name="Subcategorias_Categorias_idCategorias"
                        id="Subcategorias_Categorias_idCategorias">
                        <option value="">Selecciona una categoría</option>
                        <?php
                        // Ejecutar la consulta para obtener todas las categorías
                        
                        $result_categorias = $conn->query($sql_categorias);
                        // Verificar si hay resultados
                        if ($result_categorias->num_rows > 0) {
                            // Iterar sobre los resultados y mostrar las opciones
                            while ($categoria = $result_categorias->fetch_assoc()) {
                                echo "<option value='" . $categoria['idCategorias'] . "'>" . $categoria['nombreCat'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Subcategorias_idSubcategorias" class="form-label">Subcategoria</label>
                    <select class="form-select form-select-lg" name="Subcategorias_idSubcategorias"
                        id="Subcategorias_idSubcategorias">
                        <option value="">Selecciona una Subcategoría</option>
                        <?php
                        // Ejecutar la consulta para obtener todas las subcategorías
                        
                        $result_Subcategorias = $conn->query($sql_Subcategorias);
                        // Verificar si hay resultados
                        if ($result_Subcategorias->num_rows > 0) {
                            // Iterar sobre los resultados y mostrar las opciones
                            while ($Subcategoria = $result_Subcategorias->fetch_assoc()) {
                                echo "<option value='" . $Subcategoria['idSubcategorias'] . "'>" . $Subcategoria['nombreSub'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <br>
                <br>
                <button type="submit" class="btn btn-success">Editar Producto</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
        <div class="card-footer text-muted">
        </div>
    </div>
    </div>
    <?php include ("../../Templates/footer.php"); ?>
    
    <script>
        $(document).ready(function () {
            $("#Subcategorias_Categorias_idCategorias").change(function () {
                var categoriaSeleccionada = $(this).val();

                $.ajax({
                    url: "obtener_subcategorias.php",
                    type: "GET",
                    data: { idCategoria: categoriaSeleccionada },
                    success: function (data) {
                        $("#Subcategorias_idSubcategorias").html(data);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error al obtener subcategorías:", error);
                    }
                });
            });
        });
    </script>
</body>

</html>