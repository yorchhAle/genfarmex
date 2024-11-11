<?php
require_once '../controllers/controladorProducto.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];  
    $controller = new ProductoController();

    if ($controller->eliminarProducto($id)) {
        echo "<script>alert('Producto eliminado exitosamente.'); window.location.href='listarProducto.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el descuento.'); window.location.href='listarProducto.php';</script>";
    }
} else {
    echo "ID de producto no válido.";
}
