<?php include ("../../Templates/header.php");
if (!isset($_SESSION['usuario']) || $_SESSION['rol_id'] !== '1') {
  // Si el usuario no está autenticado o no tiene el rol de administrador, redirigir a otra página
  header("Location: /Shanoa%20Store/index.php"); // Cambia la ruta a la página a la que deseas redirigir
  exit();
}
?>
<?php
// Incluye el archivo de conexión
include ("../../PHPCONEXION/conexion.php");


$sql = "SELECT * From productos";

// Verificar si se recibió el parámetro idCategorias en la URL
if (isset($_GET["id"])) {
  // Obtener el idCategorias de la URL
  $idProductos = $_GET["id"];

  // Preparar la consulta SQL para eliminar la categoría
  $sentencia = $conn->prepare("DELETE FROM productos WHERE idProductos = ?");

  $sentencia->bind_param("i", $idProductos); // 'i' indica que el parámetro es un entero
  $sentencia->execute();
}
?>

<?php include ("../../Templates/barraizq.php"); ?>


<body>

  <br>
  <div class="container">
    <div class="card-body">
      <h1 class="text-center text-info text-dark">Productos</h1>
      <a class="btn btn-success mb-3" href="agregar.php">Agregar Nuevo Producto</a>
      <div class="table-responsive-sm container-sm" style="max-width: 100%; overflow-x: auto;">
        <table class="table " id="tabla_id">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Detalles</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Precio</th>
              <th scope="col">Subcategoria</th>
              <th scope="col">Categoria</th>
              <th scope="col">Acciones</th>

            </tr>
          </thead>
          <tbody>
            <?php $resultado = $conn->query($sql);

            // Verifica si hay resultados
            if ($resultado->num_rows > 0) {
              // Si hay resultados, muestra cada categoría en la tabla
              while ($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["idProductos"] . "</td>";
                echo "<td>" . $row["nombreP"] . "</td>";
                echo "<td>" . $row["detallesP"] . "</td>";
                echo "<td>" . $row["cantidadP"] . "</td>";
                echo "<td>" . $row["precioP"] . "</td>";
                echo "<td>" . $row["Subcategorias_idSubcategorias"] . "</td>";
                echo "<td>" . $row["Subcategorias_Categorias_idCategorias"] . "</td>";
                echo "<td> <a href='Editar.php?id=" . $row["idProductos"] . "' class='btn btn-primary btn-sm'>Editar</a>
              <a href='javascript:void(0);' onclick='borrar(" . $row["idProductos"] . ")' class='btn btn-danger btn-sm'>Eliminar</a></td>";
                echo "</tr>";
              }
            } else {
              // Si no hay resultados, muestra un mensaje indicando que no se encontraron categorías
              echo "<tr><td colspan='4'>No se encontraron Productos.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card-footer text-muted"></div>
  <script>
    function confirmarEliminacion(nombreSubcategoria) {
      if (confirm("¿Estás seguro de eliminar la subcategoría '" + nombreSubcategoria + "'?")) {
        // Aquí puedes agregar la lógica para la eliminación si se confirma
        // window.location.href = "index.php?id=" + idSubcategoria;
      }
    }
  </script>
</body>
</main>
<?php include ("../../Templates/footer.php"); ?>