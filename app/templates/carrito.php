<?php
session_start();

require_once '../models/modeloDetPed.php'; // Modelo para manejar detalles del pedido
require_once '../models/modeloProductos.php'; // Modelo para manejar productos

$modeloDetallePedido = new ModeloDetPed();
$modeloProducto = new ModeloProductos();

// Validar que se haya recibido el ID del pedido
if (!isset($_GET['idPedido']) || !is_numeric($_GET['idPedido'])) {
    die("ID de pedido no válido.");
}

$idPedido = (int)$_GET['idPedido'];
$detallesCarrito = $modeloDetallePedido->obtenerDetPed($idPedido);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/inicio2.css">
    <title>Detalles del Pedido - Genfarmex</title>
    <link rel="stylesheet" href="styles.css">
</head>
<header>
    <?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
</header>
<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    <h2>Detalles del Pedido</h2>

    <?php if (empty($detallesCarrito)): ?>
        <p>No hay productos en el carrito.</p>
    <?php else: ?>
        <table class="tabla-pedido" border="1">
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detallesCarrito as $detalle): ?>
                    <?php
                        // Obtener el nombre del producto
                        $producto = $modeloProducto->obtenerProductoPorId($detalle['id']);
                        $nombreProducto = $producto ? $producto['descripcion'] : 'Producto no encontrado';
                        $total = $detalle['cantidad'] * $detalle['precioUnitario'];
                    ?>
                    <tr>
                        <td><?php echo $detalle['id']; ?></td>
                        <td><?php echo $nombreProducto; ?></td>
                        <td><?php echo $detalle['cantidad']; ?></td>
                        <td>$<?php echo number_format($detalle['precioUnitario'], 2); ?></td>
                        <td>$<?php echo number_format($total, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <br>
    <a class="anadir" href="catalogo.php">Continuar ordenando</a>
</body>
</html>
