<?php
require_once '../controllers/controladorProducto.php'; // Incluir el controlador de productos

// Verificar si la solicitud es de tipo POST (cuando se envía el formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por el formulario
    $clave = $_POST['clave'];
    $desc = $_POST['desc'];
    $exis = $_POST['exis'];
    $pre = $_POST['pre'];

    // Crear una instancia del controlador de productos
    $productoController = new ProductoController();
    
    // Llamar al método para crear un nuevo producto
    if ($productoController->crearProducto($clave, $desc, $exis, $pre)) {
        // Si el producto se crea exitosamente, mostrar un mensaje y redirigir
        echo "<script>alert('Producto creado exitosamente.'); window.location.href='listarProducto.php';</script>";
    } else {
        // Si hay un error (clave duplicada), mostrar un mensaje y redirigir al formulario
        echo "<script>alert('Error: La clave ya existe.'); window.location.href='../views/cProducto.php';</script>";
    }
}
?>
