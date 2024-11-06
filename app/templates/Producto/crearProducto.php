<?php
require_once '../../controllers/controladorProducto.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clave = $_POST['clave'];
    $desc = $_POST['desc'];
    $exis = $_POST['exis'];
    $pre = $_POST['pre'];

    $productoController = new ProductoController();
    if ($productoController->crearProducto($clave, $desc, $exis, $pre)) {
        echo "<script>alert('Producto creado exitosamente.'); window.location.href='listarProducto.php';</script>";
    } else {
        echo "<script>alert('Error: La clave ya existe.'); window.location.href='cProducto.html';</script>";
    }
}
?>
