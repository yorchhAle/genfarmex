<?php
// Incluir el controlador de proveedores
require_once '../controllers/controladorProveedor.php';

// Verificar si se ha enviado el formulario con el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del proveedor desde los datos enviados por el formulario
    $idproveedores = $_POST['idproveedores'];

    // Crear una instancia del controlador de proveedores
    $ProveedorController = new ProveedorController();

    // Llamar al método para eliminar el proveedor con el ID recibido
    if ($ProveedorController->eliminarProveedor($idproveedores)) {
        // Si la eliminación fue exitosa, mostrar un mensaje de éxito y redirigir a la lista de proveedores
        echo "<script>alert('Proveedor eliminado exitosamente.'); window.location.href='listarProveedores.php';</script>";
    } else {
        // Si hubo un error al eliminar el proveedor, mostrar un mensaje de error y redirigir a la lista de proveedores
        echo "<script>alert('Error al eliminar el proveedor. Inténtalo nuevamente.'); window.location.href='listarProveedores.php';</script>";
    }
}
?>
