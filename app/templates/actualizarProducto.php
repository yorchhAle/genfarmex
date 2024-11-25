<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
<?php
require_once '../controllers/controladorProducto.php'; // Incluir el controlador de productos

// Verificar si la solicitud es de tipo POST (actualización del producto)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $clave = $_POST['clave'];
    $desc = $_POST['descripcion'];
    $exis = $_POST['existencias'];
    $pre = $_POST['precio'];

    // Crear una instancia del controlador de productos
    $productoController = new ProductoController();
    // Llamar al método para actualizar el producto
    if ($productoController->actualizarProducto($id, $clave, $desc, $exis, $pre)) {
        // Si la actualización es exitosa, mostrar un mensaje y redirigir
        echo "<script>alert('Producto actualizado exitosamente.'); window.location.href='listarProducto.php';</script>";
    } else {
        // Si hay un error, mostrar un mensaje y redirigir
        echo "<script>alert('Error al actualizar el producto.'); window.location.href='listarProducto.php';</script>";
    }
} else { 
    // Si no es una solicitud POST, es una solicitud GET para mostrar el formulario de actualización
    
    // Obtener el ID del producto desde la URL
    $id = $_GET['id']; 
    $productoController = new ProductoController();
    // Obtener los detalles del producto usando su ID
    $productoActual = $productoController->obtenerProductoPorId($id);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizar Producto - Genfarmex</title>
        <link rel="stylesheet" href="../static/css/update.css"> <!-- Incluir el CSS para el formulario -->
    </head>
    <body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú de navegación -->
    
    <?php
    // Verificar si se encontró el producto en la base de datos
    if ($productoActual) {?>
    <h2 align="center">Actualizar Producto</h2>
        <div class="form-container">
        
    <form action='actualizarProducto.php' method='POST'> <!-- Formulario para actualizar el producto -->
            <input type='hidden' name='id' value="<?php echo htmlspecialchars( $productoActual['id'])?>"> <!-- Campo oculto para el ID del producto -->
            <label for="clave">Clave</label>
            <input type='text' name='clave' value="<?php echo htmlspecialchars( $productoActual['clave'])?>" required> <!-- Campo para la clave del producto -->
            <label for="descripcion">Descripción:</label>
            <input type='text' name='descripcion' value="<?php echo htmlspecialchars( $productoActual['descripcion'])?>" required> <!-- Campo para la descripción -->
            <label for="existencias">Existencias:</label>
            <input type='number' name='existencias' min="0" value="<?php echo htmlspecialchars( $productoActual['existencias'])?>" required> <!-- Campo para las existencias -->
            <label for="precio">Precio:</label>
            <input type='number' name='precio' min="0" value="<?php echo htmlspecialchars( $productoActual['precioUnitario'])?>" required> <!-- Campo para el precio -->
            <button type='submit' class="btn-submit">Actualizar Producto</button> <!-- Botón para enviar el formulario -->
        </form>
    </div>
        
    <?php } else {
        // Si no se encontró el producto, mostrar un mensaje y redirigir
        echo "<script>alert('Producto no encontrado.'); window.location.href='listarProducto.php';</script>";
    }
}?>

    </body>
</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
