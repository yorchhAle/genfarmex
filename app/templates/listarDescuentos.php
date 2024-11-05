<?php
require_once '../controllers/controladorDescuentos.php';
$descuentoController = new DescuentoController();
$descuentos = $descuentoController->obtenerDescuentos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Descuentos - Genfarmex</title>
    <link rel="stylesheet" href="../static/css/inicio.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Descuentos</h1>

        <?php foreach ($descuentos as $descuento): ?>
            <div class="descuento">
                <h3>ID: <?php echo $descuento['idDecuentos']; ?></h3>
                <p><strong>Nombre:</strong> <?php echo $descuento['nombre']; ?></p>
                <p><strong>Porcentaje:</strong> <?php echo $descuento['porcentaje']; ?>%</p>
                <p><strong>Fecha de Creación:</strong> <?php echo $descuento['FechaCreacion']; ?></p>
                <p>
                    <a href='actualizarDescuento.php?id=<?php echo $descuento['idDecuentos']; ?>'>Actualizar</a> |
                    <a href='eliminarDescuento.php?id=<?php echo $descuento['idDecuentos']; ?>'>Eliminar</a>
                </p>
            </div>
            <hr>
        <?php endforeach; ?>

    </div>
</body>
</html>
