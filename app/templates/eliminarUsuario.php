<?php
require_once '../controllers/controladorUs.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $idusuarios = $_GET['id'];
    $UsuController = new UsController();

    if ($UsuController->eliminarUsuario($idusuarios)) {
        echo "<script>alert('Eliminado exitosamente.'); window.location.href='gestionesPanel.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el Cliente.'); window.location.href='listarClientes.php';</script>";
    }
}
?>
