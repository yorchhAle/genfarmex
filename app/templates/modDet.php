<?php
    require_once '../models/modeloDetPed.php'; // Modelo para manejar detalles del pedido
    require_once '../models/modeloProductos.php'; // Modelo para manejar detalles del pedido
    
    $modeloDetallePedido = new ModeloDetPed();
    $modeloProducto = new ModeloProductos();

    $idDetPed = $_GET['id'];
    $idProducto = $_GET['idProd'];

    $detalle = $modeloDetallePedido->obtenerDetPedPorID($idDetPed);
    $producto = $modeloProducto->obtenerProductoPorId($idProducto);
?>
<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizar Detalle - Genfarmex</title>
        <link rel="stylesheet" href="../static/css/update.css"> 
    </head>
    <body>
    <?php include '../includes/menuCliente.php'; ?> <!-- Incluir el menú -->   
    
    <?php
if ($detalle && $producto) {
    
    // Validar el contenido antes de usarlo
    $idDetallePedido = isset($detalle['iddetallePedido']) ? htmlspecialchars($detalle['iddetallePedido']) : '';
    $cantidad = isset($detalle['cantidad']) ? htmlspecialchars($detalle['cantidad']) : '';
    $cantidadDisponible = htmlspecialchars($producto['existencias']);
    $cantidadDisponible = $cantidadDisponible + $cantidad;
    $idProd = htmlspecialchars($producto['id']);

    echo "el id del producto es: ".$idProd;
    
    ?>
    <h2 align="center">Actualizar Producto</h2>
    <div class="form-container">
        <form action="actualizarDetalle.php" method="POST">
            <label for="id">ID:</label>
            <input type="hidden" name="idProd" value="<?php echo $idProd?>">
            <input type="text" name="id" value="<?php echo $idDetallePedido; ?>" readonly>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" min="0" value="<?php echo $cantidad; ?>" max="<?php echo $cantidadDisponible ?>" required>

            <button type="submit" class="btn-submit">Actualizar Detalle</button>
        </form>
    </div>
    <?php
} else {
    echo "<h1>Hubo un error: Detalle no encontrado.</h1>";
}
?>


</body>
</html>

