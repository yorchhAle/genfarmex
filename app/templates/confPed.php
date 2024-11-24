<?php
require_once '../models/modeloPed.php'; // Modelo para manejar los pedidos

$modeloPedido = new ModeloPed(); // Instancia del modelo (corrige el constructor si es necesario)

$idPedido = $_GET['idPed'] ?? null; // Aseguramos que $idPedido exista antes de usarlo

if ($idPedido && $modeloPedido->confirmarPed($idPedido)) {
    // Pedido confirmado exitosamente
    echo "<script>
        alert('¡Pedido confirmado exitosamente!');
        window.location.href = 'catalogo.php'; // Redirige a otra página si es necesario
    </script>";
} else {
    // No se pudo confirmar el pedido
    echo "<script>
        alert('No se pudo confirmar el pedido. Inténtalo de nuevo.');
        window.location.href = 'catalogo.php'; // Redirige a otra página si es necesario
    </script>";
}
?>
