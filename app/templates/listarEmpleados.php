<?php
require_once '../controllers/controladorUs.php';

$controller = new UsController();
$empleados = $controller->listarEmpleados();
?>
<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados</title>
    <link rel="stylesheet" href="../static/css/read.css">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

    <div class="container main-content">
        <h1>Listado de Empleados</h1>
        <table class="tabla-descuentos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Sueldo</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($empleados)): ?>
                    <?php foreach ($empleados as $empleado): ?>
                        <tr>
                            <td><?= htmlspecialchars($empleado['idusuario']) ?></td>
                            <td><?= htmlspecialchars($empleado['nombre']) ?></td>
                            <td><?= htmlspecialchars($empleado['apellido']) ?></td>
                            <td><?= htmlspecialchars($empleado['usuario']) ?></td>
                            <td><?= htmlspecialchars($empleado['correo']) ?></td>
                            <td><?= htmlspecialchars($empleado['telefono']) ?></td>
                            <td><?= htmlspecialchars($empleado['direccion']) ?></td>
                            <td><?= htmlspecialchars($empleado['sueldo']) ?></td>
                            <td>
                                <a href="actualizarEmpleado.php?id=<?= $empleado['idusuario'] ?>" class="btn actualizar">Actualizar</a>
                            </td>
                            <td>
                                <a href="eliminarEmpleado.php?id=<?= $empleado['idusuario'] ?>" class="btn eliminar" onclick="return confirm('¿Estás seguro de eliminar este empleado?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" style="text-align: center;">No hay empleados registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
        <button class="back-button" onclick="window.history.back();">Volver</button>
    </div>
</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->