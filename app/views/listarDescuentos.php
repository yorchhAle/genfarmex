<?php
require_once '../controllers/controladorDescuentos.php';
$descuentoController = new DescuentoController();
$descuentos = $descuentoController->obtenerDescuentos();

foreach ($descuentos as $descuento) {
    echo "<div>";
    echo "ID: " . $descuento['idDecuentos'] . "<br>";
    echo "Nombre: " . $descuento['nombre'] . "<br>";
    echo "Porcentaje: " . $descuento['porcentaje'] . "<br>";
    echo "Fecha de Creación: " . $descuento['FechaCreacion'] . "<br>";
    echo "<a href='actualizarDescuento.php?id=" . $descuento['idDecuentos'] . "'>Actualizar</a> | ";
    echo "<a href='eliminarDescuento.php?id=" . $descuento['idDecuentos'] . "'>Eliminar</a>";
    echo "</div><hr>";
}
?>