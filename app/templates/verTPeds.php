<?php
require_once '../../config/db.php'; 
$conn = getConnection();
require_once '../models/modeloPed.php';
require_once '../models/modeloUs.php';
require_once '../models/modeloDetPed.php';
$modeloPedido = new ModeloPed();
$modeloUs = new ModeloUs();
$modeloDetPed = new ModeloDetPed();

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : "";
?>

<?php 
session_start();
if (!isset($_SESSION['tipoUsuario']) || ($_SESSION['tipoUsuario'] !== 'empleado' && $_SESSION['tipoUsuario'] !== 'admin')) {
    header("Location: ../views/inicioSesion.html");
    exit;
}
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/css/pedidos.css">  
    <title>Pedidos clientes - Genfarmex</title>
</head>
<header> 
    <?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->
</header>
<body>
<?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    <?php 
        $pedidos = $modeloPedido->obtenerTodosPed($filtro);
    ?>
    <div class="search-bar">
            <form method="get" action="">
                <input class="input-search" type="text" name="filtro" placeholder="Buscar Cliente..." value="<?php echo htmlspecialchars($filtro); ?>">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </form>
            <form method="get" action="">
                <button class="btn btn-secondary" type="submit">Mostrar todos</button>
            </form>
        </div>
    <div class="pedidos-container">
    <h2>Todos los Pedidos</h2>
    <?php 
    if (empty($pedidos)) {
        echo "<p>No tienes pedidos registrados.</p>";
    } else {
        foreach ($pedidos as $pedido) {
            $idClie = $pedido['idcliente'];

            // Obtener idUsuario del cliente
            $idUs = $modeloUs->idClieAUs($idClie);
            $nom = $modeloUs->nombreCliente($idUs);

            echo "<div class='pedido'>";
            echo "<h3 class='pedido-id'>Pedido ID: {$pedido['idpedido']}</h3>";
            echo "<p class='cliente'>Cliente: <strong>$nom</strong></p>";
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
                $CTot = number_format($total, 2) + $CTot;
                echo "</tr>";
            }
            echo 'Total del pedido: $' . $CTot;

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        }
    }
    ?>
</div>


</body>
</html>
