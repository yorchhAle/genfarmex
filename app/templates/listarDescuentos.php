<?php
require_once '../controllers/controladorDescuentos.php';
$descuentoController = new DescuentoController();
$descuentos = $descuentoController->obtenerDescuentos();
?>

<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Descuentos - Genfarmex</title>
    <link rel="stylesheet" href="../static/css/read.css">
</head>
<body>
<?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    <div class="container">
        <h1>Lista de Descuentos</h1>

        <?php if (!empty($descuentos) && is_array($descuentos)): ?>
            <table class="tabla-descuentos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Porcentaje</th>
                        <th>Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($descuentos as $descuento): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($descuento['idDecuentos']); ?></td>
                            <td><?php echo htmlspecialchars($descuento['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($descuento['porcentaje']); ?>%</td>
                            <td><?php echo htmlspecialchars($descuento['FechaCreacion']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button class="back-button" onclick="history.back()">Regresar</button>
        <?php else: ?>
            <p>No hay descuentos disponibles.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
