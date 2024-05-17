<?php include ("../Templates/header.php");
if (!isset($_SESSION['usuario']) || $_SESSION['rol_id'] !== '1') {
  // Si el usuario no está autenticado o no tiene el rol de administrador, redirigir a otra página
  header("Location: /Shanoa%20Store/index.php"); // Cambia la ruta a la página a la que deseas redirigir
  exit();
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Sidebars · Bootstrap v5.3</title>
   

<?php include ("../Templates/barraizq.php"); ?>
</body>
</html>



<?php include ("../Templates/footer.php"); ?>