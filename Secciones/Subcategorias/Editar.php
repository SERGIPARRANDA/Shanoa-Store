<?php ?>
<?php include ("../../PHPCONEXION/conexion.php"); ?>
<?php


// Consulta SQL para seleccionar todas las categorías
$sql_categorias = "SELECT idCategorias, nombreCat FROM categorias";

$idSubcategorias = isset($_GET["id"]) ? $_GET["id"] : (isset($_POST["idSubcategorias"]) ? $_POST["idSubcategorias"] : "");

if ($_POST) {
    $nombreSub = isset($_POST["nombreSub"]) ? $_POST["nombreSub"] : "";
    $descripcionSub = isset($_POST["descripcionSub"]) ? $_POST["descripcionSub"] : "";
    $Categorias_idCategorias = isset($_POST["Categorias_idCategorias"]) ? $_POST["Categorias_idCategorias"] : "";
    // Preparar la consulta SQL para actualizar la categoría
    $sentencia = $conn->prepare("UPDATE subcategorias SET nombreSub = ?, descripcionSub = ?, Categorias_idCategorias = ? WHERE idSubcategorias = ?");
    if (!$sentencia) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    // Vincular parámetros y ejecutar la consulta
    $sentencia->bind_param("ssii", $nombreSub, $descripcionSub, $Categorias_idCategorias, $idSubcategorias); // 'ssii' indica que los parámetros son string, string, integer, integer
    if (!$sentencia->execute()) {
        die("Error al ejecutar la consulta: " . $sentencia->error);
    }

    // Redirigir después de la ejecución exitosa
    $mensaje = "Registro editado";
    header("Location: index.php?mensaje=" . $mensaje);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <h1>Editar Subcategoria</h1>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombreSub" class="form-label">Nombre Subcategoria</label>
                    <input type="text" class="form-control" name="nombreSub" id="nombreSub" aria-describedby="helpId"
                        placeholder="Dale un nombre a la subcategoria" required>
                </div>
                <div class="mb-3">
                    <label for="descripcionSub" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" name="descripcionSub" id="descripcionSub"
                        aria-describedby="helpId" placeholder="Añade una descripcion para la subcategoria" required>
                </div>
                <div class="mb-3">
                    <label for="Categorias_idCategorias" class="form-label">CATEGORIA</label>
                    <select class="form-select form-select-lg" name="Categorias_idCategorias"
                        id="Categorias_idCategorias">
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
                <br>
                <button type="submit" class="btn btn-success">Editar Subcategoria</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
        <div class="card-footer text-muted">
        </div>
    </div>
    </div>
    <?php include ("../../Templates/footer.php"); ?>
</body>

</html>