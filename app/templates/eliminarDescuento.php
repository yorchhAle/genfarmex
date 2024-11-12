<?php
require_once '../controllers/controladorDescuentos.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idDescuento = $_GET['id'];
    $descuentoController = new DescuentoController();

    if ($descuentoController->eliminarDescuento($idDescuento)) {
        echo "<script>alert('Descuento eliminado exitosamente.'); window.location.href='eliminarActDes.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el descuento.'); window.location.href='eliminarActDes.php';</script>";
    }
}
?>
