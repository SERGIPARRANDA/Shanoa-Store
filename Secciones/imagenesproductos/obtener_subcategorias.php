<?php include ("../../PHPCONEXION/conexion.php"); ?>
<?php


if (isset($_POST['categoria_id'])) {
    $categoriaId = $_POST['categoria_id'];
    
    // Consulta SQL para obtener subcategorías asociadas a la categoría seleccionada
    $sql_subcategorias = "SELECT * FROM subcategorias WHERE Categorias_idCategorias = $categoriaId";
    $result_subcategorias = $conn->query($sql_subcategorias);

    // Generar opciones de subcategorías
    $options = '<option value="">Selecciona la Subcategoría</option>';
    if ($result_subcategorias->num_rows > 0) {
        while ($subcategoria = $result_subcategorias->fetch_assoc()) {
            $options .= "<option value='" . $subcategoria['idSubcategorias'] . "'>" . $subcategoria['nombreSub'] . "</option>";
        }
    }
    
    echo $options;
}
?>