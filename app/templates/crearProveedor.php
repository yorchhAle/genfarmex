<?php
require_once '../controllers/controladorProveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['numeroT'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $proveedorController = new ProveedorController();
    if ($proveedorController->crearProveedor($nombre, $contacto, $telefono, $email, $direccion)) {
        echo "<script>alert('Proveedor creado exitosamente.'); window.location.href='../views/cProveedores.php';</script>";
    } else {
        echo "<script>alert('Error al crear el proveedor.'); window.location.href='../views/cProveedores.php';</script>";
    }
}
?>