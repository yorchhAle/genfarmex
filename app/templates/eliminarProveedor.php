<?php
require_once '../controllers/controladorProveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idproveedores = $_POST['idproveedores'];

    $ProveedorController = new ProveedorController();
    if ($ProveedorController->eliminarProveedor($idproveedores)) {
        echo "<script>alert('Proveedor eliminado exitosamente.'); window.location.href='listarProveedores.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el proveedor. Inténtalo nuevamente.'); window.location.href='listarProveedores.php';</script>";
    }
}
?>