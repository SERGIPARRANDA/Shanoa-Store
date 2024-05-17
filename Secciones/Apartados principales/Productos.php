<?php ?>
<?php include ("../../PHPCONEXION/conexion.php");

// Consultar las categorías de la base de datos
$query = "SELECT nombreCat FROM categorias";
$result = $conn->query($query);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .position-relative {
        /* Establece la imagen de fondo para el banner de promociones */
        background-image: url('../../imagenes/bannerP.gif');
        background-size: cover;
        background-position: center;
        opacity: 0.9;
        height: 400px;
        /* Ajusta la opacidad del fondo si es necesario */
    }
    .display-3{
        color: white;
    }
    .display-7{
        color: white;
    }
</style>

<body>
    <?php include ("../../Templates/header.php"); ?>
    <main>
        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
            <div class="col-md-6 p-lg-5 mx-auto my-5">
                <h1 class="display-3 fw-bold">Información</h1>
                <h3 class="display-7 fw-normal  mb-3">Explora nuestras categorías y subcategorías</h3>
                <div class="d-flex gap-3 justify-content-center lead fw-normal">
                    <?php
                    // Consulta para obtener todas las categorías disponibles
                    $sql_categorias = "SELECT idCategorias, nombreCat FROM categorias";
                    $result_categorias = $conn->query($sql_categorias);

                    if ($result_categorias->num_rows > 0) {
                        while ($row_categoria = $result_categorias->fetch_assoc()) {
                            $categoria_id = $row_categoria['idCategorias'];
                            $nombre_categoria = $row_categoria['nombreCat'];
                            ?>


                            <form action="subcategorias.php" method="GET">
                                <input type="hidden" name="idCategoria" value="<?php echo $categoria_id; ?>">
                                <button type="submit" class="btn btn-success">
                                    <?php echo $nombre_categoria; ?>
                                </button>
                            </form> <?php
                        }
                    } else {
                        echo "No se encontraron categorías";
                    }
                    ?>
                </div>
            </div>
            <div class="product-device shadow-sm d-none d-md-block">
                <img src="../../imagenes/bannerP" alt="">
            </div>
            <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
        </div>




        <div style="display: flex; justify-content: space-between;">
            <!-- Columna izquierda para el apartado -->
            <div class="col-lg-4">
                <br><br><br>
                <div class="" style="width: 100%;">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Filtrar precio.</h5>
                            <form>
                                <div class="form-group">
                                    <label for="priceRange">Precio:</label>
                                    <input type="range" class="custom-range" id="priceRange" min="0" max="100"
                                        value="50">
                                    <div id="priceValue"></div>
                                </div>
                                <button type="submit" class="btn btn-warning d-block mx-auto"
                                    style="border: none; width: 25%;">Filtrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container marketing">
                <div class="row">
                    <!-- Columna derecha para los productos -->
                    <div class="container">
                        <?php
                        $sql_Produc_Subcat = "SELECT nombreSub FROM subcategorias WHERE idSubcategorias = 11;";
                        $result = $conn->query($sql_Produc_Subcat);

                        if ($result->num_rows > 0) {
                            // Extraer el nombre de la subcategoría si hay resultados
                            $row = $result->fetch_assoc();
                            $nombreSub = $row["nombreSub"];

                            // Mostrar el nombre de la subcategoría en el título <h1>
                            echo '<h1 style="text-align: center;">' . htmlspecialchars($nombreSub) . '</h1>';
                        } else {
                            // En caso de que no se encuentre ninguna subcategoría con idSucategorias = 11
                            echo '<h1 style="text-align: center;">Subcategoría no encontrada</h1>';
                        }
                        ?>
                        <hr>
                        <td style="text-align: center;"></td>
                        <div class="row">
                            <?php
                            $sql = "SELECT p.*
                            FROM productos p
                            JOIN subcategorias s ON p.Subcategorias_idSubcategorias = s.idSubcategorias
                            WHERE s.idSubcategorias = 11;";
                            $result = $conn->query($sql, );
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $id_producto = $row["idProductos"];
                                    $nombre = $row["nombreP"];
                                    $precio = $row["precioP"];
                                    $descripcion = $row["detallesP"];

                                    // Obtener las imágenes asociadas al producto
                                    $stmt_imagenes = $conn->prepare("SELECT rutaImagen FROM imagenesproductos WHERE id_producto = ?");
                                    $stmt_imagenes->bind_param("i", $id_producto);
                                    $stmt_imagenes->execute();
                                    $result_imagenes = $stmt_imagenes->get_result();

                                    // Comenzar la estructura de la tarjeta del producto
                                    echo '<div class="col-lg-4 col-md-6 mb-4">';
                                    echo '<div class="card h-100">';

                                    // Mostrar el carrusel si hay más de una imagen
                                    if ($result_imagenes->num_rows > 1) {
                                        echo '<div id="carouselExampleControls_' . $id_producto . '" class="carousel slide" data-bs-ride="carousel">';
                                        echo '<div class="carousel-inner">';

                                        $firstImage = true;

                                        while ($row_imagen = $result_imagenes->fetch_assoc()) {
                                            $ruta_Imagen = $row_imagen['rutaImagen'];
                                            $activeClass = $firstImage ? 'active' : '';

                                            echo '<div class="carousel-item ' . $activeClass . '" style="height:350px;">';
                                            echo '<img src="' . $ruta_Imagen . '" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Imagen">';
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
                                    echo '<h4 class="card-title">' . $nombre . '</h4>';
                                    echo '<h5>$' . $precio . '</h5>';
                                    echo '<p class="card-text">' . $descripcion . '</p>';
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
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>






    <?php include ("../../Templates/footer.php"); ?>

    <!-- Scripts -->
    <script>
        var priceRange = document.getElementById('priceRange');
        var priceValue = document.getElementById('priceValue');

        priceRange.addEventListener('input', function () {
            // Convierte el valor del rango de dólares a pesos colombianos (COP)
            var copValue = priceRange.value * 4000; // Tasa de cambio estimada
            priceValue.textContent = 'Precio: COP ' + copValue.toLocaleString();
        });

        // Establece el valor inicial del precio
        var initialCOPValue = priceRange.value * 4000; // Tasa de cambio estimada
        priceValue.textContent = 'Precio: COP ' + initialCOPValue.toLocaleString();
    </script>


</body>

</html>