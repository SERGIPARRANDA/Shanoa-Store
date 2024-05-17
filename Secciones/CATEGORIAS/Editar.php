<?php ?>
<?php include ("../../PHPCONEXION/conexion.php"); ?>
<?php
$idCategorias = isset($_GET["id"]) ? $_GET["id"] : "";
if ($_POST) {
    $nombreCat = isset($_POST["nombreCat"]) ? $_POST["nombreCat"] : "";
    $descripcionCat = isset($_POST["descripcionCat"]) ? $_POST["descripcionCat"] : "";

    // Preparar la consulta SQL para actualizar la categoría
    $sentencia = $conn->prepare("UPDATE categorias SET nombreCat = ?, descripcionCat = ? WHERE idCategorias = ?");

    if (!$sentencia) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular parámetros y ejecutar la consulta
    $sentencia->bind_param("ssi", $nombreCat, $descripcionCat, $idCategorias); // 'ssi' indica que los parámetros son string, string e integer

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
            <h1>Editar Categoria</h1>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombreCat" class="form-label">Nombre Categoria</label>
                    <input type="text" class="form-control" name="nombreCat" id="nombreCat" aria-describedby="helpId"
                        placeholder="Dale un nombre a la Categoria" required>
                </div>
                <div class="mb-3">
                    <label for="DescripcionCat" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" name="descripcionCat" id="descripcionCat"
                        aria-describedby="helpId" placeholder="Añade una descripcion para la Categoria" required>
                </div>
                <br>
                <button type="submit" class="btn btn-success">Editar Categoria</button>
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