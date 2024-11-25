<?php
require_once '../controllers/controladorDescuentos.php'; // Incluir el controlador de descuentos

// Verificar si la solicitud es un POST (cuando se envía el formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre']; // Nombre del descuento
    $porcentaje = $_POST['porcentaje']; // Porcentaje del descuento
    $fechaCreacion = $_POST['fechaCreacion']; // Fecha de creación del descuento

    // Crear una instancia del controlador de descuentos
    $descuentoController = new DescuentoController();

    // Intentar crear el descuento
    if ($descuentoController->crearDescuento($nombre, $porcentaje, $fechaCreacion)) {
        // Si la creación es exitosa, mostrar un mensaje de éxito y redirigir a la vista de descuentos
        echo "<script>alert('Descuento creado exitosamente.'); window.location.href='../views/cDescuentos.php';</script>";
    } else {
        // Si ya existe un descuento con el mismo nombre, mostrar un mensaje de error y redirigir
        echo "<script>alert('Error: Ya existe un descuento con este nombre.'); window.location.href='../views/cDescuentos.php';</script>";
    }
}
?>
