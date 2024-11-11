<?php
require_once '../controllers/controladorProveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idproveedores = $_GET['id'];
    $ProveedorController = new ProveedorController();

    if ($ProveedorController->eliminarProveedor($idproveedores)) {
        echo "<script>alert('Proveedor eliminado exitosamente.'); window.location.href='eliminarActProve.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el descuento.'); window.location.href='eliminarActProve.php';</script>";
    }
}
?>
