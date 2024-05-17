
<?php include ("PHPCONEXION/conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón Rosado con Tailwind CSS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 p-4">
<?php include ("Templates/header.php"); ?>
<?php include ("Templates/footer.php"); ?>
    <button class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded">
      Botón Rosado
    </button>

    <!-- Otro ejemplo de enlace -->
    <a href="#" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded">
      Enlace Rosado
    </a>





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
                            echo '<a href="#" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded">Ver más</a>';
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
            
</body>
</html>
