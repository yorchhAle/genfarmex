<?php
require_once '../../config/db.php'; // Archivo de conexión a la base de datos
$conn = getConnection();
session_start();
// Validar sesión
if (!isset($_SESSION['tipoUsuario']) || ($_SESSION['tipoUsuario'] !== 'cliente' && $_SESSION['tipoUsuario'] !== 'admin')) {
    header("Location: ../views/inicioSesion.html");
    exit;
}
$nomCliente = $_SESSION['usuario'];

    $query = "SELECT clientes.idcliente 
              FROM usuarios 
              INNER JOIN clientes ON clientes.idusuario = usuarios.idusuario 
              WHERE usuarios.usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nomCliente);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $idCliente = $row['idcliente']; // Obtener el ID del cliente
    $stmt->close();

require_once '../models/modeloPed.php'; // Modelo para manejar los pedidos
require_once '../models/modeloDetPed.php'; // Modelo para manejar detalles del pedido
require_once '../models/modeloProductos.php'; // Modelo para manejar productos

$modeloPed = new ModeloPed();
$modeloDetallePedido = new ModeloDetPed();
$modeloProducto = new ModeloProductos();


$pedidoActivo = $modeloPed->obtenerPedidoActivoPorCliente($idCliente);
if(!$pedidoActivo){
    $pedidoActivo= $modeloPed->crearPed($idCliente);
    header("Location:carrito.php");
}

$idPedido = $pedidoActivo['idpedido'];
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
    <?php include '../includes/menuCliente.php'; ?> <!-- Incluir el menú -->
    <h2>Detalles del Pedido</h2>

    <?php if (empty($detallesCarrito)):?>
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
                    <th>Eliminar</th>
                    <th>Actualizar</th>
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
                        <?php $idEnvio = $detalle['id']; ?>
                        <td><?php echo $detalle['id']; ?></td>
                        <td><?php echo $nombreProducto; ?></td>
                        <td><?php echo $detalle['cantidad']; ?></td>
                        <td>$<?php echo number_format($detalle['precioUnitario'], 2); ?></td>
                        <td>$<?php echo number_format($total, 2); ?></td>
                        <td><a class="anadir" href="elimDet.php?id=<?php echo $detalle['iddetallePedido']?>&idProd=<?php echo $detalle['id']?>">Eliminar detalle</a></td>
                        <td><a class="anadir" href="modDet.php?id=<?php echo $detalle['iddetallePedido']?>&idProd=<?php echo $detalle['id']?>">Actualizar detalle</a></td> 
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <br>
    <a class="anadir" href="catalogo.php">Continuar ordenando</a><br>
    <a class="anadir" href="confPed.php?idPed=<?php echo $idPedido; ?>">Confirmar pedido</a>

    <br>
    <a></a>
</body>
</html>
