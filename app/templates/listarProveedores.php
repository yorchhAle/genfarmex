<?php
require_once '../controllers/controladorProveedor.php';
$proveedorController = new ProveedorController();
$proveedores = $proveedorController->obtenerProveedores();
?>

<?php
session_start();
if (!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] !== 'admin') {
    header("Location: inicioSesion.html");
    exit;
}
?>

<?php include '../includes/header.php'; ?> <!-- Incluir el encabezado -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proveedores - Genfarmex</title>
    <link rel="stylesheet" href="../static/css/read.css">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->
    <div class="container">
        <h1>Lista de Proveedores</h1>

        <?php if (!empty($proveedores) && is_array($proveedores)): ?>
            <table class="tabla-descuentos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($proveedor['idProveedores']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['nombreP']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['contactoP']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['telefonoP']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['correoP']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['direccionP']); ?></td>
                            <td class="acciones">
                                <a href="actualizarProveedor.php?id=<?php echo $proveedor['idProveedores']; ?>" class="btn actualizar">Actualizar</a>
                            </td>
                            <td class="acciones">
                                <form action="../templates/eliminarProveedor.php" method="POST" onsubmit="return confirmarEliminacion();">
                                    <input type="hidden" name="idproveedores" value="<?php echo htmlspecialchars($proveedor['idProveedores']); ?>">
                                    <button type="submit" class="btn eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button class="back-button" onclick="history.back()">Regresar</button>
        <?php else: ?>
            <p>No hay proveedores disponibles.</p>
        <?php endif; ?>
    </div>

    <script src="../static/js/confirmaciones.js"></script>
</body>

</html>

<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->
