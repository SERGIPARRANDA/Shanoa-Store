<?php ?>
<?php include ("../../PHPCONEXION/conexion.php"); ?>

<?php
$sql_Productos = "SELECT idProductos, nombreP FROM productos";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ruta base del servidor web
    $ruta_base = $_SERVER['DOCUMENT_ROOT'];

    // Parte relativa de la ruta donde deseas almacenar las imágenes
    $ruta_imagen = "/Shanoa Store/imagenes/Productos/" . basename($_FILES["imagen"]["name"]);

    // Ruta completa de la imagen en el servidor
    $ruta_completa = $ruta_base . $ruta_imagen;

    $id_producto = $_POST["id_producto"];

    // Guardar la imagen en el servidor
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_completa)) {
        // Preparar la consulta SQL para insertar la información en la tabla imagenesproductos
        $stmt = $conn->prepare("INSERT INTO imagenesproductos (rutaImagen, id_producto) VALUES (?, ?)");

        if ($stmt) {
            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("si", $ruta_imagen, $id_producto);

            if ($stmt->execute()) {
                $mensaje = "Registro agregado correctamente.";
                header("Location: index.php?mensaje=" . $mensaje);
                exit();
            } else {
                $error = "Error al ejecutar la consulta: " . $stmt->error;
            }
        } else {
            $error = "Error al preparar la consulta: " . $conn->error;
        }
    } else {
        $error = "Error al subir la imagen.";
    }
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
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Nueva Imagen</h1>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Seleccionar Imagen</label>
                        <input type="file" class="form-control" name="imagen" id="imagen" required>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select class="form-select form-select-lg" name="categoria" id="categoria" required>
                            <option value="">Selecciona la Categoría</option>
                            <?php
                            $sql_categorias = "SELECT * FROM categorias";
                            $result_categorias = $conn->query($sql_categorias);
                            if ($result_categorias->num_rows > 0) {
                                while ($categoria = $result_categorias->fetch_assoc()) {
                                    echo "<option value='" . $categoria['idCategorias'] . "'>" . $categoria['nombreCat'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3" id="subcategoria_div">
                        <label for="subcategoria" class="form-label">Subcategoría</label>
                        <select class="form-select form-select-lg" name="subcategoria" id="subcategoria" required>
                            <option value="">Selecciona la Subcategoría</option>
                            <?php
                            $sql_subcategorias = "SELECT * FROM subcategorias";
                            $result_subcategorias = $conn->query($sql_subcategorias);
                            if ($result_subcategorias->num_rows > 0) {
                                while ($subcategoria = $result_subcategorias->fetch_assoc()) {
                                    echo "<option value='" . $subcategoria['idSubcategorias'] . "'>" . $subcategoria['nombreSub'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3" id="producto_div">
                        <label for="id_producto" class="form-label">Producto</label>
                        <select class="form-select form-select-lg" name="id_producto" id="productos" required>
                            <option value="">Selecciona el Producto</option>
                            <?php
                            $sql_productos = "SELECT * FROM productos";
                            $result_productos = $conn->query($sql_productos);
                            if ($result_productos->num_rows > 0) {
                                while ($productos = $result_productos->fetch_assoc()) {
                                    echo "<option value='" . $productos['idProductos'] . "'>" . $productos['nombreP'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            // Evento onchange para el selector de subcategoría
                            $('#subcategoria').change(function () {
                                var subcategoriaId = $(this).val();  // Obtener el ID de la subcategoría seleccionada
                                if (subcategoriaId !== '') {
                                    // Realizar una solicitud AJAX para obtener los productos
                                    $.ajax({
                                        type: 'POST',
                                        url: 'obtener_productos.php', // URL del script PHP para obtener productos
                                        data: { subcategoria_id: subcategoriaId },
                                        success: function (response) {
                                            $('#productos').html(response);  // Actualizar las opciones de productos
                                        }
                                    });
                                } else {
                                    $('#productos').html('<option value="">Selecciona el Producto</option>');
                                }
                            });
                        });
                        $('#categoria').change(function () {
                            var categoriaId = $(this).val();  // Obtener el ID de la categoría seleccionada
                            if (categoriaId !== '') {
                                // Realizar una solicitud AJAX para obtener las subcategorías
                                $.ajax({
                                    type: 'POST',
                                    url: 'obtener_subcategorias.php', // URL del script PHP para obtener subcategorías
                                    data: { categoria_id: categoriaId },
                                    success: function (response) {
                                        $('#subcategoria').html(response);  // Actualizar las opciones de subcategorías
                                        $('#producto').html('<option value="">Selecciona el Producto</option>'); // Reiniciar los productos
                                    }
                                });
                            } else {
                                $('#subcategoria').html('<option value="">Selecciona la Subcategoría</option>');
                                $('#producto').html('<option value="">Selecciona el Producto</option>');
                            }
                        });


                    </script>




                    <button type="submit" class="btn btn-success">Agregar Imagen</button>
                    <a href="index.php" class="btn btn-primary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>





    <?php include ("../../Templates/footer.php"); ?>
</body>

</html>

</html>