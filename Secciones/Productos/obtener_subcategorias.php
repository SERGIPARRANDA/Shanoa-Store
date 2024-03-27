<?php
include("../../PHPCONEXION/conexion.php");

if (isset($_GET['idCategoria'])) {
    $idCategoria = $_GET['idCategoria'];

    // Consulta SQL para obtener las subcategorías de la categoría seleccionada
    $sql = "SELECT idSubcategorias, nombreSub FROM subcategorias WHERE Categorias_idCategorias = $idCategoria";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Construir las opciones de subcategorías
        $options = "<option value=''>Selecciona una Subcategoría</option>";
        while ($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row['idSubcategorias'] . "'>" . $row['nombreSub'] . "</option>";
        }
        echo $options;
    } else {
        echo "<option value=''>No hay subcategorías disponibles</option>";
    }
} else {
    echo "<option value=''>Selecciona una categoría primero</option>";
}
?>
