<?php
// Incluir la conexión a la base de datos y cualquier archivo necesario
include ("../../PHPCONEXION/conexion.php");
?>
<?php
// Incluir la conexión a la base de datos y cualquier archivo necesario


// Definir una variable para almacenar el nombre de la subcategoría (por defecto)
$subcategoria_nombre = "Subcategoría";

// Verificar si se recibió un ID de subcategoría válido en la URL
if (isset($_GET['idSubcategoria']) && is_numeric($_GET['idSubcategoria'])) {
    $subcategoria_id = $_GET['idSubcategoria'];

    // Consulta para obtener el nombre de la subcategoría
    $sql_nombre_subcategoria = "SELECT nombreSub FROM subcategorias WHERE idSubcategorias = ?";
    $stmt_nombre_subcategoria = $conn->prepare($sql_nombre_subcategoria);
    $stmt_nombre_subcategoria->bind_param("i", $subcategoria_id);
    $stmt_nombre_subcategoria->execute();
    $result_nombre_subcategoria = $stmt_nombre_subcategoria->get_result();

    // Verificar si se encontró la subcategoría y obtener su nombre
    if ($result_nombre_subcategoria->num_rows > 0) {
        $row_nombre_subcategoria = $result_nombre_subcategoria->fetch_assoc();
        $subcategoria_nombre = $row_nombre_subcategoria['nombreSub'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include ("../../Templates/header.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artículos de Subcategoría</title>
    <!-- Incluir Bootstrap CSS (asegúrate de tener acceso al archivo bootstrap.min.css) -->
</head>

<body>

    <div class="container">
        <h1 class="my-5 text-center"><?php echo htmlspecialchars($subcategoria_nombre); ?></h1>

        <div class="row">
            <?php
            // Verificar si se recibió un ID de subcategoría válido en la URL
            if (isset($_GET['idSubcategoria']) && is_numeric($_GET['idSubcategoria'])) {
                $subcategoria_id = $_GET['idSubcategoria'];

                // Consulta para obtener todos los productos de la subcategoría seleccionada
                $sql_productos = "SELECT idProductos, nombreP, precioP, detallesP
                                  FROM productos
                                  WHERE Subcategorias_idSubcategorias = ?";
                $stmt_productos = $conn->prepare($sql_productos);
                $stmt_productos->bind_param("i", $subcategoria_id);
                $stmt_productos->execute();
                $result_productos = $stmt_productos->get_result();

                // Mostrar los productos encontrados
                echo '<div class="row">';
                while ($row_producto = $result_productos->fetch_assoc()) {
                    $id_producto = $row_producto['idProductos'];
                    $nombre_producto = $row_producto['nombreP'];
                    $precio_producto = $row_producto['precioP'];
                    $descripcion_producto = $row_producto['detallesP'];

                    // Consulta para obtener las imágenes asociadas al producto
                    $stmt_imagenes = $conn->prepare("SELECT rutaImagen FROM imagenesproductos WHERE id_producto = ?");
                    $stmt_imagenes->bind_param("i", $id_producto);
                    $stmt_imagenes->execute();
                    $result_imagenes = $stmt_imagenes->get_result();

                    // Estructura de la tarjeta del producto
                    echo '<div class="col-lg-4 col-md-6 mb-4">';
                    echo '<div class="card h-100">';

                    // Mostrar el carrusel si hay más de una imagen asociada al producto
                    if ($result_imagenes->num_rows > 1) {
                        echo '<div id="carouselExampleControls_' . $id_producto . '" class="carousel slide" data-bs-ride="carousel">';
                        echo '<div class="carousel-inner">';

                        $firstImage = true;

                        while ($row_imagen = $result_imagenes->fetch_assoc()) {
                            $ruta_Imagen = $row_imagen['rutaImagen'];
                            $activeClass = $firstImage ? 'active' : '';

                            echo '<div class="carousel-item ' . $activeClass . '" style="height:350px;">';
                            echo '<img src="' . $ruta_Imagen . '" class="d-block w-100" style="height: 400px; object-fit: cover;" ">';
                            echo '</div>';

                            $firstImage = false;
                        }

                        echo '</div>';
                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_' . $id_producto . '" data-bs-slide="prev">';
                        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Previous</span>';
                        echo '</button>';
                        echo '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_' . $id_producto . '" data-bs-slide="next">';
                        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                        echo '<span class="visually-hidden">Next</span>';
                        echo '</button>';
                        echo '</div>'; // Cerrar carrusel
            


                    } else {
                        // Si hay una sola imagen, mostrarla directamente
                        if ($row_imagen = $result_imagenes->fetch_assoc()) {
                            $ruta_Imagen = $row_imagen['rutaImagen'];
                            echo '<img src="' . $ruta_Imagen . '" style="height: 400px; width: 100%; object-fit: cover;" class="card-img-top" alt="Imagen">';
                        }
                    }

                    // Continuar con la información del producto y el cuerpo de la tarjeta
                    echo '<div class="card-body">';
                    echo '<h4 class="card-title">' . htmlspecialchars($nombre_producto) . '</h4>';
                    echo '<h5>$' . htmlspecialchars($precio_producto) . '</h5>';
                    echo '<p class="card-text">' . htmlspecialchars($descripcion_producto) . '</p>';
                    echo '</div>';
                    echo '<div class="card-footer">';
                    if (!isset($_SESSION['usuario'])) {
                        // Si el usuario no está autenticado, mostrar un enlace para redirigir al registro
                        echo '<a href="../../crearCuenta.php" class="btn btn-primary">Registrarse para Comprar</a>';
                    } else {
                        // Si el usuario está autenticado, mostrar el formulario para agregar al carrito
                        echo '<form method="POST" action="../Carrito/agregar_carrito.php">';
                        echo '<input type="hidden" name="id_producto" value="' . $id_producto . '">';
                        echo '<input type="hidden" name="id_persona" value="' . $_SESSION['idUsuarios'] . '">';
                        echo '<div class="form-group">';
                        echo '<label for="cantidad_' . $id_producto . '">Cantidad:</label>';
                        echo '<input type="number" class="form-control" name="cantidad" id="cantidad_' . $id_producto . '" value="1" min="1">';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-primary">Agregar al Carrito</button>';
                        echo '</form>';
                    }
                    echo '</div>';
                    echo '</div>'; // Cerrar tarjeta
                    echo '</div>'; // Cerrar columna
                }
                echo '</div>'; // Cerrar fila de productos
            }
            ?>
        </div>
    </div>

    <style>
        .carousel-item img {
            height: 100%;
            /* Ajustar la altura al tamaño del carrusel */
            width: 100%;
            /* Ajustar el ancho al tamaño del carrusel */
            object-fit: cover;
            /* Escalar la imagen para llenar el espacio sin deformarla */
        }

        .carousel-item img {
            display: none;
        }

        .carousel-item.active img {
            display: block;
        }
    </style>
    <script>
        $('.carousel-item img').on('load', function () {
            $(this).show();
        });
    </script>
    </main>
    <?php include ("../../Templates/footer.php"); ?>
</body>

</html>