<?php ?>
<?php include ("../../PHPCONEXION/conexion.php"); ?>

<?php
if ($_POST) {
    $nombreCat = isset($_POST["nombreCat"]) ? $_POST["nombreCat"] : "";
    $DescripcionCate = isset($_POST["descripcionCat"]) ? $_POST["descripcionCat"] : "";

    // Preparar la consulta SQL con marcadores de posición ?
    $sentencia = $conn->prepare("INSERT INTO categorias (nombreCat, descripcionCat) VALUES (?, ?)");

    if (!$sentencia) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    // Vincular parámetros y ejecutar la consulta
    $sentencia->bind_param("ss", $nombreCat, $DescripcionCate); // 'ss' indica que ambos parámetros son strings

    if (!$sentencia->execute()) {
        die("Error al ejecutar la consulta: " . $sentencia->error);
    }

    // Redirigir después de la ejecución exitosa
    $mensaje = "Registro agregado";
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
    <?php include ("../../Templates/header.php"); ?>
    <div class="card">
        <div class="card-header">
            <h1>Nueva Categoria</h1>
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
                <button type="submit" class="btn btn-success">Agregar Categoria</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
        <div class="card-footer text-muted">
        </div>
    </div>

















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <?php include ("../../Templates/footer.php"); ?>
</body>

</html>