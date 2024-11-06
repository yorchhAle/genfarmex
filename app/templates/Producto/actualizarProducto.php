<?php
require_once '../../controllers/controladorProducto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $clave = $_POST['clave'];
    $desc = $_POST['descripcion'];
    $exis = $_POST['existencias'];
    $pre = $_POST['precio'];

    $productoController = new ProductoController();
    if ($productoController->actualizarProducto($id, $clave, $desc, $exis, $pre)) {
        echo "<script>alert('Producto actualizado exitosamente.'); window.location.href='listarProducto.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el producto.'); window.location.href='listarProducto.php';</script>";
    }
} else {
    // Obtener el producto actual por su ID
    $id = $_GET['id'];
    $productoController = new ProductoController();
    $productoActual = $productoController->obtenerProductoPorId($id);
    
    if ($productoActual) {
        // Mostrar el formulario con los datos actuales
        echo "
        <form action='actualizarProducto.php' method='POST'>
            <input type='hidden' name='id' value='{$productoActual['id']}'>
            <input type='text' name='clave' value='{$productoActual['clave']}' required>
            <input type='text' name='descripcion' value='{$productoActual['descripcion']}' required>
            <input type='text' name='existencias' value='{$productoActual['existencias']}' required>
            <input type='text' name='precio' value='{$productoActual['precioUnitario']}' required>
            <button type='submit'>Actualizar Producto</button>
        </form>";
    } else {
        echo "<script>alert('Producto no encontrado.'); window.location.href='listarProducto.php';</script>";
    }
}
?>