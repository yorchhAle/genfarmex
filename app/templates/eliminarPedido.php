<?php
session_start();
require_once '../models/modeloDetPed.php'; // Modelo de detalle de pedido
require_once '../models/modeloPed.php'; // Modelo de pedidos
require_once '../../config/db.php'; // Conexión a la base de datos

$modeloDetallePedido = new ModeloDetPed();
$modeloPedido = new ModeloPed();

// Validar sesión
if (!isset($_SESSION['tipoUsuario']) || ($_SESSION['tipoUsuario'] !== 'cliente' && $_SESSION['tipoUsuario'] !== 'admin')) {
    header("Location: ../views/inicioSesion.html");
    exit;
}

if (isset($_POST['idPedido'])) {
    $idPedido = (int)$_POST['idPedido'];

    // Eliminar los detalles del pedido
    $detalles = $modeloDetallePedido->obtenerDetPed($idPedido);
    foreach ($detalles as $detalle) {
        $modeloDetallePedido->eliminarDetPed($idPedido, $detalle['id']);

        // Incrementar las existencias de los productos
        $conn = getConnection();
        $query = $conn->prepare("UPDATE producto SET existencias = existencias + ? WHERE id = ?");
        $query->bind_param("ii", $detalle['cantidad'], $detalle['id']);
        $query->execute();
        $query->close();
    }

    // Eliminar el pedido
    $resultado = $modeloPedido->eliminarDetPed($idPedido);

    if ($resultado) {
        echo "Pedido eliminado correctamente.";
    } else {
        echo "Error al eliminar el pedido.";
    }
} else {
    echo "Parámetro idPedido no proporcionado.";
}
?>
