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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../static/css/read.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include '../includes/menu.php'; ?> <!-- Incluir el menú -->

    <div class="container">
        <h1>Lista de Proveedores</h1>
        <table class="tabla-descuentos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td><?php echo $proveedor['idproveedores']; ?></td>
                        <td><?php echo $proveedor['nombreP']; ?></td>
                        <td><?php echo $proveedor['contactoP']; ?></td>
                        <td><?php echo $proveedor['telefonoP']; ?></td>
                        <td><?php echo $proveedor['correoP']; ?></td>
                        <td><?php echo $proveedor['direccionP']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button class="back-button" onclick="history.back()">Regresar</button>
    </div>
</body>

</html>
<?php include '../includes/footer.php'; ?> <!-- Incluir el pie de página -->