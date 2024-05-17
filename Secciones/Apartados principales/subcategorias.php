<?php include ("../../PHPCONEXION/conexion.php"); ?>

<body>
    <?php include ("../../Templates/header.php"); ?>

    <style>

    </style>

    <main>

        <style>
            .bg-promociones {
                /* Establece la imagen de fondo para el banner de promociones */
                background-image: url('../../imagenes/BannerPromo.gif');
                background-size: cover;
                background-position: center;
                opacity: 0.9;
                height: 700px;
                /* Ajusta la opacidad del fondo si es necesario */
            }
        </style>

        <?php
        // Verificar si se proporcionó un ID de categoría en la URL
        if (isset($_GET['idCategoria']) && is_numeric($_GET['idCategoria'])) {
            $categoria_id = $_GET['idCategoria'];

            // Consulta para obtener el nombre de la categoría seleccionada
            $sql_categoria = "SELECT nombreCat FROM categorias WHERE idCategorias = ?";
            $stmt = $conn->prepare($sql_categoria);
            $stmt->bind_param("i", $categoria_id);
            $stmt->execute();
            $result_categoria = $stmt->get_result();

            if ($result_categoria->num_rows > 0) {
                $row_categoria = $result_categoria->fetch_assoc();
                $nombre_categoria = $row_categoria['nombreCat'];

                // Definir una clase CSS adicional basada en la categoría
                $div_clase_css = '';
                if ($nombre_categoria === "Promociones") {
                    $div_clase_css = 'bg-promociones';

                }

                // Mostrar el contenido de la página con el banner condicional
                echo '<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3  text-center bg-body-tertiary ' . $div_clase_css . '">';
                echo '<div class="col-md-6 p-lg-5 mx-auto my-5">';

                // Mostrar el nombre de la categoría en el título <h1>
                echo '<div class="d-flex gap-3 justify-content-center lead fw-normal">';

                // Consulta para obtener las subcategorías asociadas a la categoría seleccionada
                $sql_subcategorias = "SELECT idSubcategorias, nombreSub FROM subcategorias WHERE Categorias_idCategorias = ?";
                $stmt = $conn->prepare($sql_subcategorias);
                $stmt->bind_param("i", $categoria_id);
                $stmt->execute();
                $result_subcategorias = $stmt->get_result();

                if ($result_subcategorias->num_rows > 0) {
                    while ($row_subcategoria = $result_subcategorias->fetch_assoc()) {
                        $subcategoria_id = $row_subcategoria['idSubcategorias'];
                        $nombre_subcategoria = $row_subcategoria['nombreSub'];
                        ?>

                        <?php
                    }
                    echo '</div>';
                } else {
                    echo "No se encontraron subcategorías para esta categoría";
                }

                echo '</div>'; // Cerrar col-md-6
                echo '</div>'; // Cerrar div principal (position-relative)
        
            } else {
                echo "No se encontró la categoría especificada";
            }
        } else {
            echo "ID de categoría no válido";
        }
        ?>

        <div class="container">
            <?php
            // Verificar si se proporcionó un ID de categoría válido en la URL
            if (isset($_GET['idCategoria']) && is_numeric($_GET['idCategoria'])) {
                $categoria_id = $_GET['idCategoria'];

                // Consulta para obtener los nombres de todas las subcategorías de la categoría seleccionada
                $sql_subcategorias = "SELECT idSubcategorias, nombreSub FROM subcategorias WHERE Categorias_idCategorias = ?";
                $stmt_subcategorias = $conn->prepare($sql_subcategorias);
                $stmt_subcategorias->bind_param("i", $categoria_id);
                $stmt_subcategorias->execute();
                $result_subcategorias = $stmt_subcategorias->get_result();

                // Verificar si se encontraron subcategorías para la categoría seleccionada
                if ($result_subcategorias->num_rows > 0) {
                    echo '<div class="container">';
                    // Mostrar los nombres de las subcategorías en un bucle while
                    while ($row_subcategoria = $result_subcategorias->fetch_assoc()) {
                        $subcategoria_id = $row_subcategoria['idSubcategorias'];
                        $nombre_subcategoria = $row_subcategoria['nombreSub'];

                        // Mostrar el nombre de la subcategoría en un elemento <h2> con estilo centrado
                        echo '<h2 style="text-align: center;">' . htmlspecialchars($nombre_subcategoria) . '</h2>';

                        // Consulta para obtener hasta 3 productos de esta subcategoría
                        $sql_productos = "SELECT idProductos, nombreP, precioP, detallesP
                              FROM productos
                              WHERE Subcategorias_idSubcategorias = ?
                              LIMIT 3";
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
            
                        // Botón para ver todos los productos de esta subcategoría
                        echo '<div style="text-align: center; margin-top: 20px;">';
                        echo '<a href="Articulos.php?idSubcategoria=' . $subcategoria_id . '" class="btn btn-success">Ver todos los productos</a>';
                        echo '</div>';
                    }

                    echo '</div>'; // Cerrar contenedor
                } else {
                    echo '<h1 style="text-align: center;">No se encontraron subcategorías para esta categoría</h1>';
                }
            } else {
                echo '<h1 style="text-align: center;">ID de categoría no válido</h1>';
            }
            ?>



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


</body>
<?php include ("../../Templates/footer.php"); ?>