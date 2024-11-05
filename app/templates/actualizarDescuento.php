<?php
require_once '../controllers/controladorDescuentos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idDescuento = $_POST['idDecuentos'];
    $nombre = $_POST['nombre'];
    $porcentaje = $_POST['porcentaje'];
    $fechaCreacion = $_POST['fechaCreacion'];

    $descuentoController = new DescuentoController();
    if ($descuentoController->actualizarDescuento($idDescuento, $nombre, $porcentaje, $fechaCreacion)) {
        echo "<script>alert('Descuento actualizado exitosamente.'); window.location.href='listarDescuentos.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el descuento.'); window.location.href='listarDescuentos.php';</script>";
    }
} else {
    // Obtener el descuento actual y mostrar el formulario
    $idDescuento = $_GET['id'];
    $descuentoController = new DescuentoController();
    $descuentos = $descuentoController->obtenerDescuentos();
    $descuentoActual = array_filter($descuentos, fn($d) => $d['idDecuentos'] == $idDescuento);
    
    if ($descuentoActual) {
        $descuentoActual = reset($descuentoActual);
        // Mostrar el formulario con los datos actuales
        echo "
        <form action='actualizarDescuento.php' method='POST'>
            <input type='hidden' name='id' value='{$descuentoActual['idDecuentos']}'>
            <input type='text' name='nombre' value='{$descuentoActual['nombre']}' required>
            <input type='number' step='0.01' name='porcentaje' value='{$descuentoActual['porcentaje']}' required>
            <input type='date' name='fechaCreacion' value='{$descuentoActual['FechaCreacion']}' required>
            <button type='submit'>Actualizar Descuento</button>
        </form>";
    }
}
?>

