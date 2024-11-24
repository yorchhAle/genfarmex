<?php
require_once '../../config/db.php'; // Archivo de conexión a la base de datos
$conn = getConnection();
require_once '../models/modeloPed.php';
require_once '../models/modeloDetPed.php';
$modeloPedido = new ModeloPed();
$modeloDetPed = new ModeloDetPed();

?>

<?php 
session_start();
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

?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/css/pedidos.css">
    <title>Mis pedidos - Genfarmex</title>
</head>
<header> 
    <?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
</header>
<body>
<?php include '../includes/menuCliente.php'; ?> <!-- Incluir el menú -->
    <?php 
        $pedidos = $modeloPedido->obtenerTodosPedClie($idCliente);
    ?>
    
    <div class="pedidos">
    <h2>Mis Pedidos</h2>
    <?php 
    if (empty($pedidos)) {
        echo "<p>No tienes pedidos registrados.</p>";
    } else {
        foreach ($pedidos as $pedido) {
            $idClie = $pedido['idcliente'];


            echo "<div class='pedido'>";
            echo "<h3 class='pedido-id'>Pedido ID: {$pedido['idpedido']}</h3>";
            echo "<p class='fecha-pedido'>Fecha del Pedido: {$pedido['fechaPedido']}</p>";
            echo "<p class='estado'>Estado: {$pedido['estado']}</p>";
            echo "<p class='descuento'>ID Descuento: {$pedido['idDecuentos']}</p>";

            // Obtener detalles del pedido
            $detalles = $modeloDetPed->obtenerDetPed($pedido['idpedido']);

            echo "<h4>Detalles del Pedido:</h4>";
            echo "<table class='detalles-pedido'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID Producto</th>";
            echo "<th>Cantidad</th>";
            echo "<th>Precio Unitario</th>";
            echo "<th>Total</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $CTot = 0;
            foreach ($detalles as $detalle) {
                $total = $detalle['cantidad'] * $detalle['precioUnitario'];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($detalle['id']) . "</td>";
                echo "<td>" . htmlspecialchars($detalle['cantidad']) . "</td>";
                echo "<td>" . number_format($detalle['precioUnitario'], 2) . "</td>";
                echo "<td>" . number_format($total, 2) . "</td>";
                $CTot = number_format($total,2)+$CTot;
                echo "</tr>";
            }
            echo 'Total del pedido: $'.$CTot;

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        }
    }
    ?>
</div>
</body>
</html>
