<?php ?>
<?php include ("PHPCONEXION/conexion.php");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/Shanoa%20Store/Styles/Productos.css">
</head>

<body>
    <?php include ("Templates/header.php"); ?>
    <main>
        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
            <div class="col-md-6 p-lg-5 mx-auto my-5">
                <h1 class="display-3 fw-bold">Informacion</h1>
                <h3 class="fw-normal text-muted mb-3">Los mejores accesorios</h3>
                <div class="d-flex gap-3 justify-content-center lead fw-normal">
                    <?php if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Obtener el nombre de la categoría
                            $nombre_categoria = $row['nombreCat'];
                            ?>
                            <a class="btn btn-warning" style="border: none;"
                                href="Secciones/CATEGORIAS/categoria.php?id=<?php echo $categoria_id; ?>">
                                <?php echo $nombre_categoria; ?>
                            </a>
                            <?php
                        }
                    } else {
                        echo "No se encontraron categorías";
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

                    <h2>Categorías</h2>
                    <div class="d-flex flex-wrap justify-content-between">
                        <button type="button" class="btn btn-outline-secondary rounded-circle m-1">Categoría 1</button>
                        <button type="button" class="btn btn-outline-secondary rounded-circle m-1">Categoría 2</button>
                        <button type="button" class="btn btn-outline-secondary rounded-circle m-1">Categoría 3</button>
                        <!-- Agrega más botones para más categorías -->
                    </div>
                </div>
            </div>
            <div class="container marketing">
                <div class="row">
                    <!-- Columna derecha para los productos -->
                    <div class="container">
                        <h1 style="text-align: center;">LOS MAS VENDIDOS!!</h1>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img src="imagenes/AcceRelo.jpg" class="woopack-product-featured-image img-fluid"
                                        alt="" style="max-height: 400px; width: auto;">
                                    <div class="card-body">
                                        <h4 class="card-title">Producto 1</h4>
                                        <h5>$24.99</h5>
                                        <p class="card-text">Descripción corta del producto 1.</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-primary">Ver más</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="imagen-producto-1.jpg" alt="Producto 1">
                                    <div class="card-body">
                                        <h4 class="card-title">Producto 1</h4>
                                        <h5>$24.99</h5>
                                        <p class="card-text">Descripción corta del producto 1.</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-primary">Ver más</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="imagen-producto-1.jpg" alt="Producto 1">
                                    <div class="card-body">
                                        <h4 class="card-title">Producto 1</h4>
                                        <h5>$24.99</h5>
                                        <p class="card-text">Descripción corta del producto 1.</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-primary">Ver más</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="imagen-producto-1.jpg" alt="Producto 1">
                                    <div class="card-body">
                                        <h4 class="card-title">Producto 1</h4>
                                        <h5>$24.99</h5>
                                        <p class="card-text">Descripción corta del producto 1.</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-primary">Ver más</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Puedes repetir este bloque para cada producto -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>






    <?php include ("Templates/footer.php"); ?>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>