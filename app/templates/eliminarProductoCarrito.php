<?php
session_start();
require_once '../models/modeloDetPed.php'; // Modelo de detalle de pedido
require_once '../../config/db.php'; // Conexión a la base de datos

$modeloDetallePedido = new ModeloDetPed();

// Validar sesión y parámetros
if (!isset($_SESSION['tipoUsuario']) || ($_SESSION['tipoUsuario'] !== 'cliente' && $_SESSION['tipoUsuario'] !== 'admin')) {
    header("Location: ../views/inicioSesion.html");
    exit;
}

if (isset($_POST['idProducto'], $_POST['idPedido'], $_POST['cantidad'])) {
    $idProducto = (int)$_POST['idProducto'];
    $idPedido = (int)$_POST['idPedido'];
    $cantidad = (int)$_POST['cantidad'];

    // Verificar que la cantidad sea válida
    if ($cantidad > 0) {
        // Obtener el detalle del pedido
        $detalle = $modeloDetallePedido->obtenerPed($idPedido);

        if ($detalle) {
            // Si la cantidad a eliminar es igual o mayor que la actual, elimina el producto
            if ($cantidad >= $detalle['cantidad']) {
                $resultado = $modeloDetallePedido->eliminarDetPed($idPedido, $idProducto);
            } else {
                // Si no, solo reduce la cantidad
                $resultado = $modeloDetallePedido->actualizarDetPed($idPedido, $detalle['cantidad'] - $cantidad);
            }

            if ($resultado) {
                // Incrementar las existencias del producto
                $conn = getConnection();
                $query = $conn->prepare("UPDATE producto SET existencias = existencias + ? WHERE id = ?");
                $query->bind_param("ii", $cantidad, $idProducto);
                $query->execute();
                $query->close();

                echo "Producto actualizado correctamente.";
            } else {
                echo "Error al actualizar el producto.";
            }
        } else {
            echo "Producto no encontrado en el pedido.";
        }
    } else {
        echo "Cantidad no válida.";
    }
} else {
    echo "Parámetros incompletos.";
}
?>
