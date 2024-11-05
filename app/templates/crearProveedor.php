<?php
require_once '../controllers/controladorProveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $conta = $_POST['contacto'];
    $telefono = $_POST['numeroT'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $proveedor = new ProveedorController();
        if ($proveedor->crearProveedor($nombre, $conta, $telefono, $email, $direccion)) {
            echo "<script>alert('Proveedor creado exitosamente.'); window.location.href='listarProveedores.php';</script>";
        } else {
            echo "<script>alert('Error al crear el proveedor.'); window.location.href='cProveedor.html';</script>";
        }
    } else {
        echo "<script>alert('Los datos introducidos son incorrectos.'); window.location.href='cProveedor.html';</script>";
    }
?>
