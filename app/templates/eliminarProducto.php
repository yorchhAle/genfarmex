<?php
require_once '../controllers/controladorProducto.php'; // Incluir el controlador de productos

// Verificar si el parámetro 'id' está presente en la URL (mediante el método GET)
if (isset($_GET['id'])) {
    // Obtener el 'id' de la URL y convertirlo a un entero para seguridad
    $id = (int)$_GET['id'];  
    
    // Crear una instancia del controlador de productos
    $controller = new ProductoController();

    // Intentar eliminar el producto usando el controlador
    if ($controller->eliminarProducto($id)) {
        // Si la eliminación es exitosa, mostrar un mensaje y redirigir a la página 'listarProducto.php'
        echo "<script>alert('Producto eliminado exitosamente.'); window.location.href='listarProducto.php';</script>";
    } else {
        // Si hay un error al eliminar el producto, mostrar un mensaje de error y redirigir
        echo "<script>alert('Error al eliminar el descuento.'); window.location.href='listarProducto.php';</script>";
    }
} else {
    // Si no se pasa un 'id' válido, mostrar un mensaje de error
    echo "ID de producto no válido.";
}
?>
