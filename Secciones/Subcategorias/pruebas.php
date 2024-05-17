<?php include("../../Templates/header.php"); ?>

<main>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
        <div class="col-md-6 p-lg-5 mx-auto my-5">
            <h1 class="display-3 fw-bold">Información</h1>
            <h3 class="fw-normal text-muted mb-3">Los mejores accesorios</h3>
            <div class="d-flex gap-3 justify-content-center lead fw-normal">
                <?php
                // Consulta para obtener todas las subcategorías disponibles
                $sql_subcategorias = "SELECT idSubcategorias, nombreSub FROM subcategorias";
                $result_subcategorias = $conn->query($sql_subcategorias);

                if ($result_subcategorias->num_rows > 0) {
                    while ($row_subcategoria = $result_subcategorias->fetch_assoc()) {
                        $subcategoria_id = $row_subcategoria['idSubcategorias'];
                        $nombre_subcategoria = $row_subcategoria['nombreSub'];
                        ?>
                        <a class="btn btn-success;"
                           href="Secciones/CATEGORIAS/categoria.php?id=<?php echo $subcategoria_id; ?>">
                            <?php echo $nombre_subcategoria; ?>
                        </a>
                        <?php
                    }
                } else {
                    echo "No se encontraron subcategorías";
                }
                ?>
            </div>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <!-- Columna izquierda para el apartado -->
        <div class="col-lg-4" style="width: 400px;">
            <br><br><br>
            <div class="col-lg-4" style="width: 100%;">
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
        <!-- Columna derecha para los productos -->
        <div class="container">
            <?php
            // Consulta para obtener los productos de la subcategoría seleccionada
            $sql = "SELECT p.*
                    FROM productos p
                    JOIN subcategorias s ON p.Subcategorias_idSubcategorias = s.idSubcategorias
                    WHERE s.idSubcategorias = ?"; // Consulta parametrizada para subcategoría dinámica
            $stmt = $conn->prepare($sql);
            
            // ID de la subcategoría seleccionada (por ejemplo, 11)
            $subcategoria_id = 11; // Aquí puedes cambiar el ID de la subcategoría dinámicamente

            $stmt->bind_param("i", $subcategoria_id);
            $stmt->execute();
            $result_productos = $stmt->get_result();

            if ($result_productos->num_rows > 0) {
                while ($row_producto = $result_productos->fetch_assoc()) {
                    $id_producto = $row_producto["idProductos"];
                    $nombre = $row_producto["nombreP"];
                    $precio = $row_producto["precioP"];
                    $descripcion = $row_producto["detallesP"];

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
                    echo '<a href="#" class="btn btn-primary">Ver más</a>';
                    echo '</div>';
                    echo '</div>'; // Cerrar tarjeta
                    echo '</div>'; // Cerrar columna
                }
            } else {
                echo "No se encontraron productos en esta subcategoría";
            }
            ?>
        </div>
    </div>
</main>

<?php include("../../Templates/footer.php"); ?>