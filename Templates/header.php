<?php
$base_url = '/Shanoa Store';
?>
<?php
session_start(); // Iniciar la sesión si no está iniciada

// Limpiar el carrito al iniciar una nueva sesión
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Incluir jQuery -->


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="/SHANOA STORE/Styles/index.css">
    <link rel="stylesheet" href="/SHANOA STORE/Styles/Buscador.css">
    <link rel="stylesheet" href="/SHANOA STORE/Styles/botones.css">
</head>
<style>
    .btn-success {

        background-color: pink;
        border: none;
    }

    .btn-success:active {
        background-color: rgb(252, 122, 143);
        border: none;
    }

    .btn-success:hover {
        background-color: #FBAED2;
        border: none;
    }

    .btn-danger {
        background-color: purple;
        border: none;
    }

    .btn-danger:hover {
        background-color: #FBAED2;
        border: none;
    }

    .btn-warning {
        background-color: pink;
        border: none;
    }

    .btn-primary {
        background-color: pink;
        border: none;

    }

    :hover .btn-success {
        background-color: #FBAED2;
    }

    header {
        background-color: rgba(255, 183, 195, 0.541);
    }
</style>

<body>


    <header class="p-3">



        <div class="container  w-3" s>
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start  ">
                <a href="" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="" alt="" style="height: 60px;">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="/Shanoa%20Store/Index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary"
                            href="/Shanoa%20Store/Secciones/Apartados principales/Productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary"
                            href="/Shanoa%20Store/Secciones/Apartados%20principales/subcategorias.php?idCategoria=21">Promociones</a>
                    </li>
                </ul>

                <div id="ctn-icon-search">
                    <i class="fas fa-search" id="icon-search"></i>
                </div>

                <?php
                // Verificar si el usuario está autenticado
                if (isset($_SESSION['usuario'])) {

                    $nombreUsuario = $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; // Concatenar nombre y apellido
                    echo '<a type="button" class="btn btn-danger mx-2" style=" background-color: transparent; border-color: Pink; " href="/Shanoa%20Store/Secciones/Persona/Editar.php"> <svg style="color: FBAED2;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-file-person-fill" viewBox="0 0 16 16">
                <path
                    d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2m-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11" />
            </svg> </a>';


                    // Verificar si el usuario tiene el rol de administrador (suponiendo que 'admin' es el ID de rol de administrador)
                    if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] === '1') {
                        // Mostrar el botón "Admin" solo si el usuario tiene el rol de administrador
                
                        echo '<a class="btn btn-success me-2" href="/Shanoa%20Store/Secciones/index.php">Admin</a>';
                    }

                    // Mostrar el botón "Cerrar Sesión"
                    echo '<a type="button" class="btn btn-success mx-2" style="border: none;" href="/Shanoa%20Store/CerrarSesion.php">Cerrar Sesión</a>';

                } else {
                    // Mostrar otros botones o enlaces si el usuario no está autenticado
                
                    echo '<a class="btn btn-success me-2" href="/Shanoa%20Store/InicioSesion.php">Login</a>';
                    echo '<a type="button" class="btn btn-success" href="/Shanoa%20Store/crearCuenta.php">Sign-up</a>';
                }


                if (!isset($_SESSION['usuario'])) {
                    // Si el usuario no está autenticado, mostrar un enlace para redirigir al registro
                
                } else {
                    // Si el usuario está autenticado, mostrar el formulario para agregar al carrito
                    echo '<div>';
                    echo '<a style="width: 20px;" href="/Shanoa%20Store/Secciones/Carrito/carrito.php">';
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="carrito mx-2 d-flex justify-content-end" viewBox="0 0 16 16" style="color: pink;">
                    <path
                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                </svg>';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            
        </div>
        </div>
    </header>




    <script>
        function borrar(id) {
            Swal.fire({
                title: "¿Desea eliminar el registro?",
                showCancelButton: true,
                confirmButtonText: "Sí, Borrar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir a index.php con el parámetro txtID=id para eliminar el registro
                    window.location.href = "index.php?id=" + id;
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>