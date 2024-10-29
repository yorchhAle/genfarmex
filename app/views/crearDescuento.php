<?php
require_once '../controllers/controladorDescuentos.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $porcentaje = $_POST['porcentaje'];
    $fechaCreacion = $_POST['fechaCreacion'];

    $descuentoController = new DescuentoController();
    if ($descuentoController->crearDescuento($nombre, $porcentaje, $fechaCreacion)) {
        echo "<script>alert('Descuento creado exitosamente.'); window.location.href='listarDescuentos.php';</script>";
    } else {
        echo "<script>alert('Error al crear el descuento.'); window.location.href='cDescuentos.html';</script>";
    }
}
?>
