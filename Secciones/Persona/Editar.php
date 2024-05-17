<?php include ("../../PHPCONEXION/conexion.php"); ?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Credenciales</title>
</head>

<body>
    <?php include ("../../Templates/header.php"); ?>

    <style>
        .btn-success {
            background-color: pink;
            border: none;
        }

        .btn-success:hover {
            background-color: #FBAED2;
            border: none;
        }

        .btn-success:active {
            background-color: rgb(252, 30, 67);
            border: none;
        }
    </style>

    <div class="container">
        
            <h2>Editar Credenciales</h2>

            <form action="procesar_actualizacion.php" method="POST" class="needs-validation" novalidate>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $_SESSION['nombre']; ?>"
                            required>
                        <div class="invalid-feedback">
                            Por favor ingresa un nombre válido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" name="apellido" class="form-control"
                            value="<?php echo $_SESSION['apellido']; ?>" required>
                        <div class="invalid-feedback">
                            Por favor ingresa un apellido válido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" name="direccion" class="form-control"
                            value="<?php echo $_SESSION['direccion']; ?>" required>
                        <div class="invalid-feedback">
                            Por favor ingresa una dirección válida.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" name="telefono" class="form-control"
                            value="<?php echo $_SESSION['telefono']; ?>" required>
                        <div class="invalid-feedback">
                            Por favor ingresa un número de teléfono válido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="email" name="correo" class="form-control"
                            value="<?php echo $_SESSION['correo']; ?>" required>
                        <div class="invalid-feedback">
                            Por favor ingresa un correo electrónico válido.
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Actualizar</button>
                    </div>
                </div>

                </div>
            </form>
        </div>
    
    <?php include ("../../Templates/footer.php") ?>
</body>

</html>