<?php
require_once '../controllers/controladorDescuentos.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idDescuento = $_GET['id'];  // Obtener el ID del descuento

    // Instanciar el controlador de descuentos
    $descuentoController = new DescuentoController();

    // Intentar eliminar el descuento
    if ($descuentoController->eliminarDescuento($idDescuento)) {
        // Si la eliminación es exitosa, redirigir con mensaje
        echo "<script>
                alert('Descuento eliminado exitosamente.');
                window.location.href='listarDescuentos.php';
              </script>";
    } else {
        // Si ocurre un error al eliminar el descuento, redirigir con mensaje
        echo "<script>
                alert('Error al eliminar el descuento. Inténtalo nuevamente.');
                window.location.href='listarDescuentos.php';
              </script>";
    }
} else {
    // Si el ID no está presente en la URL o la solicitud no es GET, redirigir al listado de descuentos
    echo "<script>
            alert('ID de descuento inválido o solicitud incorrecta.');
            window.location.href='listarDescuentos.php';
          </script>";
}
?>
