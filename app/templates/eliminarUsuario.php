<?php
require_once '../controllers/controladorUs.php'; // Incluir el archivo del controlador de usuario

// Verificar si la solicitud es GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener el ID del usuario a eliminar desde la URL (parámetro GET)
    $idusuarios = $_GET['id'];
    
    // Crear una instancia del controlador de usuario
    $UsuController = new UsController();

    // Llamar al método eliminarUsuario para intentar eliminar el usuario
    if ($UsuController->eliminarUsuario($idusuarios)) {
        // Si la eliminación es exitosa, mostrar un mensaje de éxito y redirigir a 'gestionesPanel.php'
        echo "<script>alert('Eliminado exitosamente.'); window.location.href='gestionesPanel.php';</script>";
    } else {
        // Si hay un error al eliminar, mostrar un mensaje de error y redirigir a 'listarClientes.php'
        echo "<script>alert('Error al eliminar el Cliente.'); window.location.href='listarClientes.php';</script>";
    }
}
?>
