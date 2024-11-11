<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
<?php
require_once '../controllers/controladorProducto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $clave = $_POST['clave'];
    $desc = $_POST['descripcion'];
    $exis = $_POST['existencias'];
    $pre = $_POST['precio'];

    $productoController = new ProductoController();
    if ($productoController->actualizarProducto($id, $clave, $desc, $exis, $pre)) {
        echo "<script>alert('Producto actualizado exitosamente.'); window.location.href='listarProducto.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el producto.'); window.location.href='listarProducto.php';</script>";
    }
} else { 

    // Obtener el producto actual por su ID
    $id = $_GET['id']; 
    $productoController = new ProductoController();
    $productoActual = $productoController->obtenerProductoPorId($id);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizar Descuento</title>
        <link rel="stylesheet" href="../static/css/update.css"> 
    </head>
    <body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->   
    
    <?php
    if ($productoActual) {?>
        <div class="form-container">
        <h2>Actualizar Producto</h2>
    <form action='actualizarProducto.php' method='POST'>
            <input type='hidden' name='id' value="<?php echo htmlspecialchars( $productoActual['id'])?>">
            <label for="clave">Clave</label>
            <input type='text' name='clave' value="<?php echo htmlspecialchars( $productoActual['clave'])?>" required>
            <label for="descripcion">Descripción:</label>
            <input type='text' name='descripcion' value="<?php echo htmlspecialchars( $productoActual['descripcion'])?>" required>
            <label for="existencias">Existencias:</label>
            <input type='text' name='existencias' value="<?php echo htmlspecialchars( $productoActual['existencias'])?>" required>
            <label for="precio">Precio:</label>
            <input type='text' name='precio'      value="<?php echo htmlspecialchars( $productoActual['precioUnitario'])?>" required>
            <button type='submit' class="btn-submit">Actualizar Producto</button>
        </form>
    </div>
        
    <?php } else {
        echo "<script>alert('Producto no encontrado.'); window.location.href='listarProducto.php';</script>";
    }
}?>

    </body>
</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->


