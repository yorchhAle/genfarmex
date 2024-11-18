<title>Carrito - Genfarmex</title>
<?php require_once '../controllers/controladorProducto.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clave = $_POST['id'];
            
        
            $productoController = new ProductoController();     
            if ($productoController->crearProducto($clave, $desc, $exis, $pre)) {
                echo "<script>alert('Producto creado exitosamente.'); window.location.href='listarProducto.php';</script>";
            } else {
                echo "<script>alert('Error: La clave ya existe.'); window.location.href='../views/cProducto.php';</script>";
            }
        }
        ?>
    ?>
</body>
</html>