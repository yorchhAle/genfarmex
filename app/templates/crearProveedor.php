<?php
// Incluir el controlador de proveedores
require_once '../controllers/controladorProveedor.php';

// Verificar si la solicitud HTTP es de tipo POST (envío del formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario enviados por el método POST
    $nombre = $_POST['nombre'];        // Nombre del proveedor
    $contacto = $_POST['contacto'];    // Nombre del contacto
    $telefono = $_POST['numeroT'];     // Número de teléfono
    $email = $_POST['email'];          // Correo electrónico
    $direccion = $_POST['direccion'];  // Dirección del proveedor

    // Crear una instancia del controlador de proveedores
    $proveedorController = new ProveedorController();

    // Intentar crear el proveedor usando el método del controlador
    if ($proveedorController->crearProveedor($nombre, $contacto, $telefono, $email, $direccion)) {
        // Si el proveedor se crea exitosamente, mostrar un mensaje de éxito
        // y redirigir al usuario a la página cProveedores.php
        echo "<script>alert('Proveedor creado exitosamente.'); window.location.href='../views/cProveedores.php';</script>";
    } else {
        // Si hubo un error al crear el proveedor, mostrar un mensaje de error
        // y redirigir al usuario a la misma página cProveedores.php
        echo "<script>alert('Error al crear el proveedor.'); window.location.href='../views/cProveedores.php';</script>";
    }
}
?>
